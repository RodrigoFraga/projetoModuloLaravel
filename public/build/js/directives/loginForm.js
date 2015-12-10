angular.module('app.directives')
	.directive('loginForm', function(){
		return {
			restrict: 'E',
			templateUrl: 'build/views/templates/form-login.html',
			scope: false
		}
	});
