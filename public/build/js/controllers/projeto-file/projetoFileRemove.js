angular.module('app.controllers')
    .controller('ProjetoNotaRemoveController',
        ['$scope', '$location', '$routeParams', 'ProjetoNota',
            function ($scope, $location, $routeParams, ProjetoNota) {

                $scope.projetoNota = ProjetoNota.get({
                    id: $routeParams.id,
                    notaId: $routeParams.idNota
                });

                $scope.remove = function () {
                    $scope.projetoNota.$delete({
                        id: $routeParams.id,
                        notaId: $scope.projetoNota.id
                    }).then(function () {
                        $location.path('/projeto/' + $routeParams.id + '/nota');
                    });
                }
            }]);