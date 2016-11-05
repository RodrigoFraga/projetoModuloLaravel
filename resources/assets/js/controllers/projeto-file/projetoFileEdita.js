angular.module('app.controllers')
    .controller('ProjetoFileEditaController', ['$scope', '$location', '$routeParams', 'ProjetoFile',
        function ($scope, $location, $routeParams, ProjetoFile) {

            $scope.projetoFile = ProjetoFile.get({
                id: $routeParams.id,
                idFile: $routeParams.idFile
            });

            $scope.save = function () {
                if ($scope.form.$valid) {
                    ProjetoFile.update({
                        id: $routeParams.id,
                        idFile: $scope.projetoFile.id
                    }, $scope.projetoFile, function () {
                        $location.path('/projeto/' + $routeParams.id + '/file');
                    });
                }
            }
        }]);