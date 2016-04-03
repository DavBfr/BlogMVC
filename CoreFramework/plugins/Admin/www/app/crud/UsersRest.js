if (typeof app != 'undefined') {

	app.service('UsersService', function ($http) {
		angular.extend(this, new CrudService($http, 'users'));
	});

	app.controller('UsersController', function ($scope, $timeout, $location, $route, UsersService, NotificationFactory) {
		angular.extend(this, new CrudController($scope, $timeout, $location, $route, UsersService, NotificationFactory));
		this.init();
		this.get_list();
	});

	app.controller('UsersDetailController', function ($scope, $timeout, $location, $route, $routeParams, UsersService, NotificationFactory) {
		angular.extend(this, new CrudController($scope, $timeout, $location, $route, UsersService, NotificationFactory));
		this.init();
		this.get_fiche($routeParams.id);
	});

	function AddUsersRoutes($routeProvider) {
		$routeProvider.when('/users', {
			controller: 'UsersController',
			templateUrl: cf_options.rest_path + '/users/list',
			menu: 'users',
			title: 'Users'
		}).when('/users/:id', {
			controller: 'UsersDetailController',
			templateUrl: cf_options.rest_path + '/users/detail',
			menu: 'users',
		});
	}

}
