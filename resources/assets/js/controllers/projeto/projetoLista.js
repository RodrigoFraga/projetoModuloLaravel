angular.module('app.controllers')
	.controller('ProjetoListaController', 
		['$scope', '$routeParams', 'Projeto', 'NgTableParams', function($scope, $routeParams, Projeto, NgTableParams){

		$scope.filters = {
			nome: ''
		};

		$scope.tableParams = new NgTableParams({
                filter: $scope.filters
            }, {
                getData: function($defer, params) {
                	var page = params.page();
                    Projeto.query({
                    	page: page
                    }, 
                    function(data){
                    	params.total(data.meta.pagination.total_pages);
                    	return $defer.resolve(data.data);
                    });
                }
            });
	}]);
