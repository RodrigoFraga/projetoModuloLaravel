angular.module('app.controllers')
    .controller('ProjetoMenbroDashboardController',
        ['$scope', '$location', '$routeParams', 'Projeto', function ($scope, $location, $routeParams, Projeto) {
            $scope.projeto = {};

            Projeto.menbro({
                orderBy: 'created_at',
                sortedBy: 'desc',
                limit: 6
            }, function (response) {
                $scope.projetos = response.data;
            });

            $scope.showProjeto = function (projeto) {
                $scope.projeto = projeto;
            }
        }]);