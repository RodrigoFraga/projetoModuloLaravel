angular.module('app.controllers')
    .controller('ProjetoDashboardController',
        ['$scope', '$location', '$routeParams', 'Projeto', 'ProjetoTask', function ($scope, $location, $routeParams, Projeto, ProjetoTask) {
            $scope.projeto = {};

            Projeto.query({
                orderBy: 'created_at',
                sortedBy: 'desc',
                limit: 6
            }, function (response) {
                $scope.projetos = response.data;
            });

            $scope.showProjeto = function (projeto) {
                $scope.projeto = projeto;
            }

            $scope.checkTask = function (item) {
                ProjetoTask.update({
                    id: item.projeto_id,
                    taskId: item.id
                }, item);
            }
        }]);