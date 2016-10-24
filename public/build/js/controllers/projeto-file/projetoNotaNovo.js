angular.module('app.controllers')
	.controller('ProjetoNotaNovoController',
		['$scope', '$location', '$routeParams', 'ProjetoNota', 
		function($scope, $location, $routeParams, ProjetoNota){

		$scope.projetoNota = new ProjetoNota();
		$scope.projetoNota.projeto_id = $routeParams.id;

		$scope.save = function(){
			if ($scope.form.$valid) {
				$scope.projetoNota.$save({id: $routeParams.id}).then(function(){
					$location.path('/projeto/' + $routeParams.id + '/nota');
				});
			};
		}
	}]);