angular.module('app.services')
	.service('ProjetoNota',['$resource', 'appConfig', function($resource, appConfig){
		return $resource(appConfig.baseUrl + '/projeto/:id/nota/:notaId', {
			id: '@id',
			notaId: '@notaId'

		}, {
			update: {
				method: 'PUT'
			}
		});
	}]);