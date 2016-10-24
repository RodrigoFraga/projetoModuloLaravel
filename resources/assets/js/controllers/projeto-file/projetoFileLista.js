angular.module('app.controllers')
	.controller('ProjetoNotaListaController', 
		['$scope', '$routeParams', 'ProjetoNota', function($scope, $routeParams, ProjetoNota){
		$scope.projetoNotas = ProjetoNota.query({id: $routeParams.id});
	}]);