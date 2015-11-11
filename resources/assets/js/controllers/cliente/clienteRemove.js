angular.module('app.controllers')
	.controller('ClientRemoveController', 
	['$scope', '$location','$routeParams', 'Cliente',
		function($scope, $location, $routeParams, Cliente){

		$scope.cliente = Cliente.get({id: $routeParams.id});

		$scope.remove = function(){
			$scope.cliente.$delete().then(function(){
				$location.path('/clientes');
			});
		}
	}]);