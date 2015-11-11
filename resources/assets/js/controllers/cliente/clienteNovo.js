angular.module('app.controllers')
	.controller('ClienteNovoController',
		['$scope', '$location', 'Cliente', function($scope, $location, Cliente){
		$scope.cliente = new Cliente();

		$scope.save = function(){
			if ($scope.form.$valid) {
				$scope.cliente.$save().then(function(){
						$location.path('/clientes');
					});
			};
		}
	}]);