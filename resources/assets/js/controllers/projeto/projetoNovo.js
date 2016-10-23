angular.module('app.controllers')
    .controller('ProjetoNovoController',
        ['$scope', '$location', '$cookies', 'Projeto', 'Cliente', 'appConfig',
            function ($scope, $location, $cookies, Projeto, Cliente, appConfig) {

                $scope.projeto = new Projeto();
                $scope.status = appConfig.projeto.status;

                $scope.due_date = {
                    status: {
                        opened: false
                    }
                };

                $scope.open = function ($event) {
                    $scope.due_date.status.opened = true;
                };

                $scope.save = function () {
                    if ($scope.form.$valid) {
                        $scope.projeto.owner_id = $cookies.getObject('user').id;
                        $scope.projeto.$save().then(function () {
                            $location.path('/projetos');
                        });
                    }
                    ;
                };

                $scope.formatNome = function (model) {
                    if (model) {
                        return model.nome;
                    }
                    ;
                    return '';
                };

                $scope.getCliente = function (nome) {
                    return Cliente.query({
                        search: nome,
                        searchFields: 'nome:like'
                    }).$promise;
                };

                $scope.selectCliente = function (item) {
                    $scope.projeto.cliente_id = item.id;
                };

            }]);