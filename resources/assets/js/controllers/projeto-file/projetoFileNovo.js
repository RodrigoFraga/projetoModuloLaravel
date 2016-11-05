angular.module('app.controllers')
    .controller('ProjetoFileNovoController',
        ['$scope', '$location', '$routeParams', 'appConfig', 'Url', 'Upload',
            function ($scope, $location, $routeParams, appConfig, Url, Upload) {

                $scope.save = function () {
                    var url = appConfig.baseUrl + '/' + Url.getUrlFromUrlSybol(appConfig.urls.projetoFile, {
                            id: $routeParams.id,
                            idFile: ''
                        });

                    if ($scope.form.$valid) {
                        Upload.upload({
                            url: url,
                            data: {
                                file: $scope.projetoFile.file,
                                'nome': $scope.projetoFile.nome,
                                'descricao': $scope.projetoFile.descricao,
                                'projeto_id': $routeParams.id
                            }
                        }).then(function (resp) {
                            $location.path('/projeto/' + $routeParams.id + '/file');
                        });
                    }
                }
            }]);