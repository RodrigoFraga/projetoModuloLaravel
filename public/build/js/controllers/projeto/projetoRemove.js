angular.module('app.controllers')
	.controller('ProjetoRemoveController', 
	['$scope', '$location','$routeParams', 'ProjetoNota',
		function($scope, $location, $routeParams, ProjetoNota){

		$scope.projetoNota = ProjetoNota.get({
			id: $routeParams.id,
			notaId: $routeParams.idNota
		});

		$scope.remove = function(){
			$scope.projetoNota.$delete({
				id:'null',
				notaId:$scope.projetoNota.id
			}).then(function(){
				$location.path('/projeto/' + $routeParams.id + '/nota');
			});
		}
	}]);