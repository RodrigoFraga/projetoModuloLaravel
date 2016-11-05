angular.module('app.directives')
    .directive('projetoFileDownload', function ($timeout, appConfig, ProjetoFile) {
        return {
            restrict: 'E',
            templateUrl: 'build/views/templates/projetoFileDownload.html',
            link: function (scope, element, attr) {
                var anchor = element.children()[0];

                scope.$on('salvar-arquivo', function (event, data) {
                    $(anchor).removeClass('disabled');
                    $(anchor).text('Salvar arquivo');
                    $(anchor).attr({
                        href: 'data:application-octet-stream;base64,' + data.file,
                        download: data.name
                    });

                    $timeout(function () {
                        scope.downloadFile = function () {

                        }
                        $(anchor)[0].click();
                    });
                });

            },
            controller: ['$scope', '$element', '$attrs', '$timeout', function ($scope, $element, $attrs, $timeout) {
                $scope.downloadFile = function () {
                    var anchor = $element.children()[0]; // recuperar o primeiro elemento dentro da diretiva "<a></a>"
                    $(anchor).addClass('disabled');
                    $(anchor).text('Carregando...');

                    ProjetoFile.download({id: $attrs.idProjeto, idFile: $attrs.idFile}, function (data) {
                        $scope.$emit('salvar-arquivo', data);
                    });
                }
            }]
        }
    });
