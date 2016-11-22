angular.module('app.controllers')
    .controller('ProjetoTaskEditaController',
        ['$scope', '$location', '$routeParams', 'appConfig', 'ProjetoTask', function ($scope, $location, $routeParams, appConfig, ProjetoTask) {

            $scope.projetoTask = ProjetoTask.get({
                id: $routeParams.id,
                taskId: $routeParams.taskId
            });
            $scope.status = appConfig.projetoTask.status;

            $scope.save = function () {
                if ($scope.form.$valid) {
                    ProjetoTask.update({
                        id: $routeParams.id,
                        taskId: $routeParams.taskId,
                    }, $scope.projetoTask, function () {
                        $location.path('/projeto/' + $routeParams.id + '/task');
                    });
                }
            }

            $scope.start_date = {
                status: {
                    opened: false
                }
            };

            $scope.openStartDate = function ($event) {
                $scope.start_date.status.opened = true;
            };

            $scope.due_date = {
                status: {
                    opened: false
                }
            };

            $scope.openDueDate = function ($event) {
                $scope.due_date.status.opened = true;
            };
        }]);