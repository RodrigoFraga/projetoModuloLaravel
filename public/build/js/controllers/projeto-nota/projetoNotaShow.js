angular.module('app.controllers')
    .controller('ProjetoNotaShowController',
        ['$scope', 'Cliente', function ($scope, Cliente) {
            $scope.clientes = Cliente.query();
        }]);