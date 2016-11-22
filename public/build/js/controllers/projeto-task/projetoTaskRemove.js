angular.module('app.controllers')
    .controller('ProjetoTaskRemoveController',
        ['$scope', '$location', '$routeParams', 'ProjetoTask',
            function ($scope, $location, $routeParams, ProjetoTask) {

                $scope.projetoTask = ProjetoTask.get({
                    id: $routeParams.id,
                    taskId: $routeParams.taskId
                });

                $scope.remove = function () {
                    $scope.projetoTask.$delete({
                        id: $routeParams.id,
                        taskId: $routeParams.taskId
                    }).then(function () {
                        $location.path('/projeto/' + $routeParams.id + '/task');
                    });
                }
            }]);