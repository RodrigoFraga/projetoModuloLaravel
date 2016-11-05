angular.module('app.controllers')
    .controller('ProjetoFileListaController',
        ['$scope', '$routeParams', 'ProjetoFile', function ($scope, $routeParams, ProjetoFile) {
            $scope.projetoFiles = ProjetoFile.query({id: $routeParams.id});
        }]);