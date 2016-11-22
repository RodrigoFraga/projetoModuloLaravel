angular.module('app.controllers')
    .controller('ProjetoMenbroRemoveController',
        ['$scope', '$location', '$routeParams', 'ProjetoMenbro',
            function ($scope, $location, $routeParams, ProjetoMenbro) {

                $scope.projetoMenbro = ProjetoMenbro.get({
                    id: $routeParams.id,
                    menbroId: $routeParams.menbroId
                });

                $scope.remove = function () {
                    $scope.projetoMenbro.$delete({
                        id: $routeParams.id,
                        menbroId: $routeParams.menbroId
                    }).then(function () {
                        $location.path('/projeto/' + $routeParams.id + '/menbro');
                    });
                }
            }]);