angular.module('app.services')
    .service('Cliente', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/cliente/:id', {id: '@id'}, {
            query: {
                isArray: false
            },
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