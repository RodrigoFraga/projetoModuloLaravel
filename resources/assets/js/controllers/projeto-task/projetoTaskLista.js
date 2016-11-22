angular.module('app.controllers')
    .controller('ProjetoTaskListaController',
        ['$scope', '$routeParams', 'appConfig', 'ProjetoTask', function ($scope, $routeParams, appConfig, ProjetoTask) {
            $scope.projetoTask = new ProjetoTask();

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.projetoTask.status = appConfig.projetoTask.status[0].value;
                    $scope.projetoTask.$save({id: $routeParams.id}).then(function () {
                        $scope.projetoTask = new ProjetoTask();
                        $scope.loadTask();
                    });
                }
            }

            $scope.loadTask = function () {
                $scope.projetoTasks = ProjetoTask.query({
                    id: $routeParams.id,
                    orderBy: 'id',
                    sortedBy: 'desc'
                });
            }

            $scope.loadTask();
        }]);