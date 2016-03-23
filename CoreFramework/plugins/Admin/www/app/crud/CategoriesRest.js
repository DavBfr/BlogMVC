if (typeof app != 'undefined') {

app.service('CategoriesService', function ($http) {
	 angular.extend(this, new CrudService($http, 'categories'));
});

app.controller('CategoriesController', function ($scope, $timeout, $location, $route, CategoriesService, NotificationFactory) {
	angular.extend(this, new CrudController($scope, $timeout, $location, $route, CategoriesService, NotificationFactory));
	this.init();
	this.get_list();
});

app.controller('CategoriesDetailController', function ($scope, $timeout, $location, $route, $routeParams, CategoriesService, NotificationFactory) {
	angular.extend(this, new CrudController($scope, $timeout, $location, $route, CategoriesService, NotificationFactory));
	this.init();
	this.get_fiche($routeParams.id);
});

function AddCategoriesRoutes($routeProvider) {
	$routeProvider.when('/categories', {
		controller: 'CategoriesController',
		templateUrl: cf_options.rest_path + '/categories/list',
		menu: 'categories',
		title: 'Categories'
	}).when('/categories/:id', {
		controller: 'CategoriesDetailController',
		templateUrl: cf_options.rest_path + '/categories/detail',
		menu: 'categories',
	});
}

}
