angular.module('app.controllers')
    .controller('ProjetoFileRemoveController',
        ['$scope', '$location', '$routeParams', 'ProjetoFile',
            function ($scope, $location, $routeParams, ProjetoFile) {

                $scope.projetoFile = ProjetoFile.get({
                    id: $routeParams.id,
                    idFile: $routeParams.idFile
                });

                $scope.remove = function () {
                    $scope.projetoFile.$delete({
                        id: $routeParams.id,
                        idFile: $scope.projetoFile.id
                    }).then(function () {
                        $location.path('/projeto/' + $routeParams.id + '/file');
                    });
                }
            }]);