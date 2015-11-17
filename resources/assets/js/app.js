var app = angular.module('app',['ngRoute', 'angular-oauth2','app.controllers', 'app.services']);

angular.module('app.controllers',['ngMessages','angular-oauth2']);
angular.module('app.services',['ngResource']);

app.provider('appConfig', function(){
	var config = {
		baseUrl: 'http://localhost:8000'
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

 		$httpProvider.defaults.transformResponse = function(data, headers){
			var headersGetter = headers();
			if (headersGetter['content-type'] == 'application/json') {
				var dataJson = JSON.parse(data);
				if (dataJson.hasOwnProperty('data')) {
					dataJson = dataJson.data;
				};
				return dataJson;
			};
			return data;
		};

		$routeProvider
			.when('/login',{
				templateUrl: 'build/views/login.html',
				controller: 'LoginController'
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
			.when('projetos/novo', {
				templateUrl: 'build/views/projeto/novo.html',
				controller: 'ProjetoNovoController'
			})
			.when('/projetos/:id/edita', {
				templateUrl: 'build/views/projeto/edita.html',
				controller: 'ProjetoEditaController'
			})
			.when('/projeto/:id/remove', {
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
			.when('projeto/:id/nota/novo', {
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

			// projeto/:id/nota
			// projeto/:id/nota/:idNota
			// projeto/:id/nota/novo
			// projeto/:id/nota/:idNota/edita
			// projeto/:id/nota/:idNota/remove


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

app.run(['$rootScope', '$window', 'OAuth', function($rootScope, $window, OAuth) {
    $rootScope.$on('oauth:error', function(event, rejection) {
	      // Ignore `invalid_grant` error - should be catched on `LoginController`.
	      if ('invalid_grant' === rejection.data.error) {
	        return;
	      }

	      // Refresh token when a `invalid_token` error occurs.
	      if ('invalid_token' === rejection.data.error) {
	        return OAuth.getRefreshToken();
	      }

	      // Redirect to `/login` with the `error_reason`.
	      return $window.location.href = '/login?error_reason=' + rejection.data.error;
	    });
   }]);