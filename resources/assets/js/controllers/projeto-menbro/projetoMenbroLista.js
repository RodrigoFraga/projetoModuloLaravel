angular.module('app.controllers')
    .controller('ProjetoMenbroListaController',
        ['$scope', '$routeParams', 'appConfig', 'ProjetoMenbro', 'User', function ($scope, $routeParams, appConfig, ProjetoMenbro, User) {
            $scope.projetoMenbro = new ProjetoMenbro();

            $scope.save = function () {
                if ($scope.form.$valid) {
                    $scope.projetoMenbro.$save({id: $routeParams.id}).then(function () {
                        $scope.projetoMenbro = new ProjetoMenbro();
                        $scope.loadMenbro();
                    });
                }
            }

            $scope.loadMenbro = function () {
                $scope.projetoMenbros = ProjetoMenbro.query({
                    id: $routeParams.id,
                    orderBy: 'id',
                    sortedBy: 'desc'
                });
            }


            $scope.formatNome = function (model) {
                if (model) {
                    return model.name;
                }
                ;
                return '';
            };

            $scope.getUser = function (name) {
                return User.query({
                    search: name,
                    searchFields: 'name:like'
                }).$promise;
            };

            $scope.selectUser = function (item) {
                $scope.projetoMenbro.menbro_id = item.id;
            };

            $scope.loadMenbro();
        }]);