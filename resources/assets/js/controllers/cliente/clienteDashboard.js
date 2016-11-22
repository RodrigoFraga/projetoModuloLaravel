angular.module('app.controllers')
    .controller('ClienteDashboardController',
        ['$scope', '$location', '$routeParams', 'Cliente', function ($scope, $location, $routeParams, Cliente) {
            $scope.cliente = {};
            
            Cliente.query({
                orderBy: 'created_at',
                sortedBy: 'desc',
                limit: 6
            }, function (response) {
                $scope.clientes = response.data;
            });

            $scope.showCliente = function (cliente) {
                $scope.cliente = cliente;
            }
        }]);