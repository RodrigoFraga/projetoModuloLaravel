angular.module('app.controllers')
    .controller('ProjetoTaskNovoController',
        ['$scope', '$location', '$routeParams', 'appConfig', 'ProjetoTask', function ($scope, $location, $routeParams, appConfig, ProjetoTask) {

            $scope.projetoTask = new ProjetoTask();
            $scope.status = appConfig.projetoTask.status;

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.projetoTask.$save({id: $routeParams.id}).then(function () {
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