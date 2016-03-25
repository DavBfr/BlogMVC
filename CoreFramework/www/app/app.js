if (typeof angular != 'undefined') {

	var app = angular.module('app', ['ngRoute', 'ngAnimate', 'mgcrea.ngStrap', 'ui.select']);

	app.config(function($routeProvider) {
		$routeProvider.when('/', {
			controller: 'BlogController',
			templateUrl: cf_options.rest_path + '/blog/list',
		});

/*
		AddPostsRoutes($routeProvider);
		AddCategoriesRoutes($routeProvider)
		AddUsersRoutes($routeProvider)
*/
		$routeProvider.when('/:id', {
				controller: 'BlogDetailController',
				templateUrl: cf_options.rest_path + '/blog/detail',
		});

		$routeProvider.when('/category/:id', {
				controller: 'CategoryController',
				templateUrl: cf_options.rest_path + '/blog/list',
		});

		$routeProvider.when('/user/:id', {
				controller: 'UserController',
				templateUrl: cf_options.rest_path + '/blog/list',
		});

		$routeProvider.otherwise({
			redirectTo: '/'
		});
	});

}
