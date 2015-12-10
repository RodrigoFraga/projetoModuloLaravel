angular.module('app.controllers')
	.controller('ProjetoEditaController', 
	['$scope', '$location', '$routeParams', '$cookies', 'Projeto', 'Cliente', 'appConfig',
		 function($scope, $location, $routeParams, $cookies, Projeto, Cliente, appConfig){

		Projeto.get({id: $routeParams.id}, function (data){
			$scope.projeto = data;
			$scope.clienteSelected = data.cliente.data;
		});

		$scope.status = appConfig.projeto.status;

		$scope.save = function(){
			if ($scope.form.$valid) {
				$scope.projeto.owner_id = $cookies.getObject('user').id;
				Projeto.update({id: $scope.projeto.id}, $scope.projeto, function (){
					$location.path('/projetos');
				});
			};
		};

		$scope.formatNome = function (model){
			if (model) {
				return model.nome;
			};
			return '';
		};

		$scope.getCliente = function (nome) {
			return Cliente.query({
				search: nome,
				searchFields: 'nome:like'
			}).$promise;
		};

		$scope.selectCliente = function (item) {
			$scope.projeto.cliente_id = item.id;
		};

	}]);