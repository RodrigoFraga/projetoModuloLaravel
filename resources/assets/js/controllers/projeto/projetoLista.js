angular.module('app.controllers')
    .controller('ProjetoListaController',
        ['$scope', '$routeParams', 'Projeto', 'NgTableParams', function ($scope, $routeParams, Projeto, NgTableParams) {
            $scope.projetos = [];
            $scope.totalProjetos = 0;
            $scope.projetosPerPage = 10; // this should match however many results your API puts on one page
            getResultsPage(1);

            $scope.pagination = {
                current: 1
            };

            $scope.pageChanged = function (newPage) {
                getResultsPage(newPage);
            };

            function getResultsPage(pageNumber) {
                Projeto.query({
                    page: pageNumber,
                    limit: $scope.projetosPerPage
                }, function (data) {
                    $scope.projetos = data.data;
                    $scope.totalProjetos = data.meta.pagination.total

                });
            }
        }]);
