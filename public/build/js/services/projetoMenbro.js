angular.module('app.services')
    .service('ProjetoMenbro', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/projetos/:id/menbro/:menbroId', {
            id: '@id',
            menbroId: '@menbroId'

        }, {
            save: {
                method: 'POST',
                transformRequest: appConfig.utils.transformRequest
            },
            update: {
                method: 'PUT',
                transformRequest: appConfig.utils.transformRequest
            }
        });
    }]);