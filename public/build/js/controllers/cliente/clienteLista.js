angular.module('app.controllers')
    .controller('ClienteListaController',
        ['$scope', 'Cliente', function ($scope, Cliente) {
            $scope.clientes = Cliente.query();
            $scope.clientes = [];
            $scope.totalClientes = 0;
            $scope.clientesPerPage = 10; // this should match however many results your API puts on one page
            getResultsPage(1);

            $scope.pagination = {
                current: 1
            };

            $scope.pageChanged = function (newPage) {
                getResultsPage(newPage);
            };

            function getResultsPage(pageNumber) {
                Cliente.query({
                    page: pageNumber,
                    limit: $scope.clientesPerPage
                }, function (data) {
                    $scope.clientes = data.data;
                    $scope.totalClientes = data.meta.pagination.total

                });
            }
        }]);