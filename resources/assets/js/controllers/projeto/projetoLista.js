angular.module('app.controllers')
	.controller('ProjetoListaController', 
		['$scope', '$routeParams', 'Projeto', function($scope, $routeParams, Projeto){
		$scope.projetos = Projeto.query();
	}]);