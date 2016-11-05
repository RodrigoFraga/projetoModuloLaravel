angular.module('app.services')
    .service('ProjetoFile', ['$resource', 'appConfig', 'Url', function ($resource, appConfig, Url) {
        var url = appConfig.baseUrl + '/' + Url.getUrlResource(appConfig.urls.projetoFile);
        return $resource(url, {
            id: '@id',
            idFile: '@idFile'

        }, {
            update: {
                method: 'PUT'
            },
            download: {
                url: url + '/download',
                method: 'GET'
            }
        });
    }]);