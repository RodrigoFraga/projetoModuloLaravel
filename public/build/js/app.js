var app = angular.module('app', [
    'ngRoute', 'angular-oauth2', 'app.controllers', 'app.filters', 'app.directives', 'app.services',
    'http-auth-interceptor',
    "ui.bootstrap.typeahead",
    "ui.bootstrap.datepicker",
    'ui.bootstrap.modal',
    'ui.bootstrap.dropdown',
    'ui.bootstrap.tabs',
    "ui.bootstrap.tpls",
    'ngTable',
    'mgcrea.ngStrap.navbar',
    'ngSanitize',
    'ui.select',
    'ngFileUpload',
    'angularUtils.directives.dirPagination',
    'pusher-angular',
    'ui-notification',
    'angularMoment'
]);

angular.module('app.controllers', ['ngMessages', 'angular-oauth2']);
angular.module('app.filters', []);
angular.module('app.directives', []);
angular.module('app.services', ['ngResource']);

app.filter('propsFilter', function () {
    return function (items, props) {
        var out = [];

        if (angular.isArray(items)) {
            var keys = Object.keys(props);

            items.forEach(function (item) {
                var itemMatches = false;

                for (var i = 0; i < keys.length; i++) {
                    var prop = keys[i];
                    var text = props[prop].toLowerCase();
                    if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                    }
                }

                if (itemMatches) {
                    out.push(item);
                }
            });
        } else {
            // Let the output be the input untouched
            out = items;
        }

        return out;
    };
});

app.provider('appConfig', ['$httpParamSerializerProvider', function ($httpParamSerializerProvider) {
    var config = {
        baseUrl: 'http://localhost:8000',
        pusherKey: '492ae86d7626deb1b64e',
        projeto: {
            status: [
                {value: 1, label: 'não iniciado'},
                {value: 2, label: 'iniciado'},
                {value: 3, label: 'concluido'}
            ]
        },
        projetoTask: {
            status: [
                {value: 0, label: 'Incompleta'},
                {value: 1, label: 'Completa'},
            ]
        },
        urls: {
            projetoFile: 'projeto/{{id}}/file/{{idFile}}'
        },
        utils: {
            transformRequest: function (data) {
                if (angular.isObject(data)) {
                    return $httpParamSerializerProvider.$get()(data);
                }
                return data;
            },
            transformResponse: function (data, headers) {
                var headersGetter = headers();
                if (headersGetter['content-type'] == 'application/json') {
                    var dataJson = JSON.parse(data);
                    if (dataJson.hasOwnProperty('data') && Object.keys(dataJson).length == 1) {
                        dataJson = dataJson.data;
                    }
                    return dataJson;
                }
                return data;
            }
        }
    };

    return {
        config: config,
        $get: function () {
            return config;
        }
    }
}]);

app.config([
    '$routeProvider', 'OAuthProvider', '$httpProvider', 'OAuthTokenProvider', 'appConfigProvider',
    function ($routeProvider, OAuthProvider, $httpProvider, OAuthTokenProvider, appConfigProvider) {

        $httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded;charset=utf-8';
        $httpProvider.defaults.transformResponse = appConfigProvider.config.utils.transformResponse;

        $httpProvider.interceptors.splice(0, 1);
        $httpProvider.interceptors.splice(0, 1);
        $httpProvider.interceptors.push('oauthFixInterceptor');

        $routeProvider
            .when('/login', {
                templateUrl: 'build/views/login.html',
                controller: 'LoginController'
            })
            .when('/logout', {
                resolve: {
                    logout: ['$location', 'OAuthToken', function ($location, OAuthToken) {
                        OAuthToken.removeToken();
                        $location.path('/login');
                    }]
                }
            })
            .when('/home', {
                templateUrl: 'build/views/home.html',
                controller: 'HomeController'
            })
            .when('/clientes/dashboard', {
                templateUrl: 'build/views/cliente/dashboard.html',
                controller: 'ClienteDashboardController',
                title: 'Cliente',
            })
            .when('/clientes', {
                templateUrl: 'build/views/cliente/lista.html',
                controller: 'ClienteListaController',
                title: 'Cliente',
            })
            .when('/clientes/novo', {
                templateUrl: 'build/views/cliente/novo.html',
                controller: 'ClienteNovoController',
                title: 'Cliente',
            })
            .when('/clientes/:id/edita', {
                templateUrl: 'build/views/cliente/edita.html',
                controller: 'ClienteEditaController',
                title: 'Cliente',
            })
            .when('/clientes/:id/remove', {
                templateUrl: 'build/views/cliente/remove.html',
                controller: 'ClientRemoveController',
                title: 'Cliente',
            })
            .when('/projetos/dashboard', {
                templateUrl: 'build/views/projeto/dashboard.html',
                controller: 'ProjetoDashboardController',
                title: 'Projetos',
            })
            .when('/projetos', {
                templateUrl: 'build/views/projeto/lista.html',
                controller: 'ProjetoListaController',
                title: 'Projetos',
            })
            .when('/projetos/novo', {
                templateUrl: 'build/views/projeto/novo.html',
                controller: 'ProjetoNovoController',
                title: 'Novo Projeto',
            })
            .when('/projetos/:id/edita', {
                templateUrl: 'build/views/projeto/edita.html',
                controller: 'ProjetoEditaController',
                title: 'Edição do Projeto',
            })
            .when('/projetos/:id/remove', {
                templateUrl: 'build/views/projeto/remove.html',
                controller: 'ProjetoRemoveController',
                title: 'Remover Projeto',
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
            .when('/projeto/:id/file', {
                templateUrl: 'build/views/projeto-file/lista.html',
                controller: 'ProjetoFileListaController'
            })
            .when('/projeto/:id/file/novo', {
                templateUrl: 'build/views/projeto-file/novo.html',
                controller: 'ProjetoFileNovoController'
            })
            .when('/projeto/:id/file/:idFile/edita', {
                templateUrl: 'build/views/projeto-file/edita.html',
                controller: 'ProjetoFileEditaController'
            })
            .when('/projeto/:id/file/:idFile/remove', {
                templateUrl: 'build/views/projeto-file/remove.html',
                controller: 'ProjetoFileRemoveController'
            })
            .when('/projeto/:id/task', {
                templateUrl: 'build/views/projeto-task/lista.html',
                controller: 'ProjetoTaskListaController'
            })
            .when('/projeto/:id/task/novo', {
                templateUrl: 'build/views/projeto-task/novo.html',
                controller: 'ProjetoTaskNovoController'
            })
            .when('/projeto/:id/task/:taskId/edita', {
                templateUrl: 'build/views/projeto-task/edita.html',
                controller: 'ProjetoTaskEditaController'
            })
            .when('/projeto/:id/task/:taskId/remove', {
                templateUrl: 'build/views/projeto-task/remove.html',
                controller: 'ProjetoTaskRemoveController'
            })
            .when('/projeto/menbro/dashboard', {
                templateUrl: 'build/views/projeto-menbro/dashboard.html',
                controller: 'ProjetoMenbroDashboardController'
            })
            .when('/projeto/:id/menbro', {
                templateUrl: 'build/views/projeto-menbro/lista.html',
                controller: 'ProjetoMenbroListaController'
            })
            .when('/projeto/:id/menbro/:menbroId/remove', {
                templateUrl: 'build/views/projeto-menbro/remove.html',
                controller: 'ProjetoMenbroRemoveController'
            })
            .otherwise('/home')
        ;


        OAuthProvider.configure({
            baseUrl: appConfigProvider.config.baseUrl,
            clientId: 'appid01',
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

app.run(['$rootScope', '$location', '$filter', '$modal', '$cookies', '$pusher', 'httpBuffer', 'OAuth', 'appConfig', 'Notification', 'amMoment',
    function ($rootScope, $location, $filter, $modal, $cookies, $pusher, httpBuffer, OAuth, appConfig, Notification, amMoment) {
        amMoment.changeLocale('pt-br'); // Configuração para moment.js

        $rootScope.$on('pusher-build', function (event, data) {
            if (data.next.$$route.originalPath != '/login') {
                if (OAuth.isAuthenticated()) {
                    if (!window.client) {
                        window.client = new Pusher(appConfig.pusherKey);
                        var pusher = $pusher(window.client);
                        var channel = pusher.subscribe('user.' + $cookies.getObject('user').id);
                        channel.bind('projetoModuloLaravel\\Events\\TaskWasIncluded', function (data) {
                            var nome = data.task.nome,
                                projeto = data.projeto.nome,
                                date = $filter('date')(data.task.created_at, 'dd/MM/yyyy'),
                                title = 'Tarefa Adicionada';

                            Notification.success({
                                title: title,
                                message: '<ul class="list-unstyled">' +
                                '<li>' + nome + '</li>' +
                                '<li>Projeto - ' + projeto + '</li>' +
                                '<li>Atualizado em <span class="pull-right">' + date + '</span></li></ul>'
                            });
                        });
                        channel.bind('projetoModuloLaravel\\Events\\TaskWasUpdated', function (data) {
                            var nome = data.task.nome,
                                projeto = data.projeto.nome,
                                date = $filter('date')(data.task.updated_at, 'dd/MM/yyyy'),
                                title = 'Tarefa Alterada';

                            if (data.task.status == 1) {
                                title = 'Tarefa Concluida'
                            }
                            Notification.success({
                                title: title,
                                message: '<ul class="list-unstyled">' +
                                '<li>' + nome + '</li>' +
                                '<li>Projeto - ' + projeto + '</li>' +
                                '<li>Atualizado em <span class="pull-right">' + date + '</span></li></ul>'
                            });
                        });
                    }

                }
            }
        });

        $rootScope.$on('pusher-destroy', function (event, data) {
            if (data.next.$$route.originalPath == '/login') {
                if (window.client) {
                    window.client.disconnect();
                    window.client = null;
                }
            }
        });

        $rootScope.$on('$routeChangeStart', function (event, next, current) {
            if (next.$$route.originalPath != '/login') {
                // Verifica se o usuario está logado
                if (!OAuth.isAuthenticated()) {
                    $location.path('/login');
                }
            }
            $rootScope.$emit('pusher-build', {next: next});
            $rootScope.$emit('pusher-destroy', {next: next});
        });
        $rootScope.$on('$routeChangeSuccess', function (event, current, previous) {
            $rootScope.PageTitiulo = current.$$route.title;
        });

        $rootScope.$on('oauth:error', function (event, data) {
            // Ignore `invalid_grant` error - should be catched on `LoginController`.
            if ('invalid_grant' === data.rejection.data.error) {
                return;
            }

            // Refresh token when a `invalid_token` error occurs.
            if ('access_denied' === data.rejection.data.error) {
                httpBuffer.append(data.rejection.config, data.deferred);
                if (!$rootScope.loginModalOpened) {
                    var modalInstance = $modal.open({
                        templateUrl: 'build/views/templates/loginModal.html',
                        controller: 'LoginModalController'
                    });
                    $rootScope.loginModalOpened = true;
                }
                return;
            }

            // Redirect to `/login` with the `error_reason`.
            return $location.path('/login');
        });
    }]);