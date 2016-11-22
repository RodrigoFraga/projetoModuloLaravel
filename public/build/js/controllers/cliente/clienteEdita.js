angular.module('app.controllers')
    .controller('ClienteEditaController',
        ['$scope', '$location', '$routeParams', 'Cliente',
            function ($scope, $location, $routeParams, Cliente) {

                $scope.cliente = Cliente.get({id: $routeParams.id});

                $scope.save = function () {
                    if ($scope.form.$valid) {
                        Cliente.update({id: $scope.cliente.id}, $scope.cliente, function () {
                            $location.path('/clientes');
                        });
                    }
                }
            }]);