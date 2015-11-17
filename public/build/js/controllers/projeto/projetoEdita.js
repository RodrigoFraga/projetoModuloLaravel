angular.module('app.controllers')
	.controller('ProjetoEditaController', 
	['$scope', '$location','$routeParams', 'ProjetoNota',
		function($scope, $location, $routeParams, ProjetoNota){

		$scope.projetoNota = ProjetoNota.get({
			id: $routeParams.id,
			notaId: $routeParams.idNota
		});

		$scope.save = function(){
			if ($scope.form.$valid) {
				ProjetoNota.update({id: 'null', notaId: $scope.projetoNota.id}, $scope.projetoNota, function(){
						$location.path('/projeto/' + $routeParams.id + '/nota');
					});
			}
		}
	}]);