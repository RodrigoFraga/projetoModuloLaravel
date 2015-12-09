var app = angular.module('app',[
	'ngRoute', 'angular-oauth2','app.controllers', 'app.filters', 'app.services',
	"ui.bootstrap.typeahead", "ui.bootstrap.datepicker", "ui.bootstrap.tpls"
]);

angular.module('app.controllers',['ngMessages','angular-oauth2']);
angular.module('app.filters',[]);
angular.module('app.services',['ngResource']);

app.provider('appConfig', function(){
	var config = {
		baseUrl: 'http://localhost:8000',
		projeto:{
			status:[
				{value: 1, label: 'não iniciado'},
				{value: 2, label: 'iniciado'},
				{value: 3, label: 'concluido'}
			]
		},
		utils:{
			transformResponse: function (data, headers){
				var headersGetter = headers();
				if (headersGetter['content-type'] == 'application/json') {
					var dataJson = JSON.parse(data);
					if (dataJson.hasOwnProperty('data')) {
						dataJson = dataJson.data;
					};
					return dataJson;
				};
				return data;
			}
		}
	};

	return {
		config: config,
		$get: function(){
			return config;
		}
	}
});

app.config([
	'$routeProvider', 'OAuthProvider', '$httpProvider', 'OAuthTokenProvider', 'appConfigProvider',
 	function($routeProvider, OAuthProvider, $httpProvider, OAuthTokenProvider, appConfigProvider){
 		
 		$httpProvider.defaults.headers.post['content-type'] = 'application/x-www-form-urlencoded;charset=utf-8';
 		$httpProvider.defaults.headers.put['content-type'] = 'application/x-www-form-urlencoded;charset=utf-8';
 		$httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;

 		$httpProvider.interceptors.push('oauthFixInterceptor');

		$routeProvider
			.when('/login',{
				templateUrl: 'build/views/login.html',
				controller: 'LoginController'
			})
			.when('/logout',{
				resolve: {
					logout: ['$location','OAuthToken', function($location, OAuthToken){
						OAuthToken.removeToken();
						$location.path('/login');
					}]
				}
			})
			.when('/home',{
				templateUrl: 'build/views/home.html',
				controller: 'HomeController'
			})
			.when('/clientes', {
				templateUrl: 'build/views/cliente/lista.html',
				controller: 'ClienteListaController'
			})
			.when('/clientes/novo', {
				templateUrl: 'build/views/cliente/novo.html',
				controller: 'ClienteNovoController'
			})
			.when('/clientes/:id/edita', {
				templateUrl: 'build/views/cliente/edita.html',
				controller: 'ClienteEditaController'
			})
			.when('/clientes/:id/remove', {
				templateUrl: 'build/views/cliente/remove.html',
				controller: 'ClientRemoveController'
			})
			.when('/projetos', {
				templateUrl: 'build/views/projeto/lista.html',
				controller: 'ProjetoListaController'
			})
			.when('/projetos/novo', {
				templateUrl: 'build/views/projeto/novo.html',
				controller: 'ProjetoNovoController'
			})
			.when('/projetos/:id/edita', {
				templateUrl: 'build/views/projeto/edita.html',
				controller: 'ProjetoEditaController'
			})
			.when('/projetos/:id/remove', {
				templateUrl: 'build/views/projeto/remove.html',
				controller: 'ProjetoRemoveController'
			})
			.when('/projeto/:id/nota', {
				templateUrl: 'build/views/projeto-nota/lista.html',
				controller: 'ProjetoNotaListaController'
			})
			.when('/projeto/:id/nota/:idNota/show', {
				templateUrl: 'build/views/projeto-nota/show.html',
				controller: 'ProjetoNotaShowController'
			})
			.when('/projeto/:id/nota/novo', {
				templateUrl: 'build/views/projeto-nota/novo.html',
				controller: 'ProjetoNotaNovoController'
			})
			.when('/projeto/:id/nota/:idNota/edita', {
				templateUrl: 'build/views/projeto-nota/edita.html',
				controller: 'ProjetoNotaEditaController'
			})
			.when('/projeto/:id/nota/:idNota/remove', {
				templateUrl: 'build/views/projeto-nota/remove.html',
				controller: 'ProjetoNotaRemoveController'
			})
			;

			
		OAuthProvider.configure({
	    	baseUrl: appConfigProvider.config.baseUrl,
	    	clientId: 'appid1',
	    	clientSecret: 'secret',
	    	grantPath: 'oauth/access_token'
	    });

	    OAuthTokenProvider.configure({
	    	name: 'token',
	    	options: {
	    		secure: false
	    	}
	    });
}]);

app.run(['$rootScope', '$location', '$http', 'OAuth', function($rootScope, $location, $http, OAuth) {

	// event. É o evento atual 
	// next . É a proxima rota que o usuario quer acessar
	// next . É rota atual que o usuario está acessando  obs. ela pode vir undefined pois pode não haver rota anterioir
	$rootScope.$on('$routeChangeStart', function(event, next, current){
		if (next.$$route.originalPath != '/login'){
			// Verifica se o usuario está logado
			if (!OAuth.isAuthenticated()){
				$location.path('/login');
			};
		};
	});

    $rootScope.$on('oauth:error', function(event, data) {
	      // Ignore `invalid_grant` error - should be catched on `LoginController`.
	      if ('invalid_grant' === data.rejection.data.error) {
	        return;
	      }

	      // Refresh token when a `invalid_token` error occurs.
	      if ('access_denied' === data.rejection.data.error) {
	      		// posibilita que seja enviado uma nova requisição para gerear o token
	      		// o IF é usado pois em multiplas requisições quando a primeira atualizar o token as outras vão 
	      		// passar o token errado
	      	if (!$rootScope.isRefreshingToken) {
	      		$rootScope.isRefreshingToken = true;
				return OAuth.getRefreshToken().then(function(response){
	      				$rootScope.isRefreshingToken = false;
						return $http(data.rejection.config).then(function(response){
							return data.deferred.resolve(response);
						})
				});
			}else{
				return $http(data.rejection.config).then(function(response){
					return data.deferred.resolve(response);
				})
			}
	      }

	      // Redirect to `/login` with the `error_reason`.
	      return $location.path('/login');
	    });
   }]);