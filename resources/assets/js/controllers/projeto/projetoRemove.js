angular.module('app.controllers')
	.controller('ProjetoRemoveController', 
	['$scope', '$location','$routeParams', 'Projeto',
		function($scope, $location, $routeParams, Projeto){

		$scope.projeto = Projeto.get({id: $routeParams.id});

		$scope.remove = function(){
			$scope.projeto.$delete({ id: $scope.projeto.id }).then(function(){
				$location.path('/projetos');
			});
		}
	}]);