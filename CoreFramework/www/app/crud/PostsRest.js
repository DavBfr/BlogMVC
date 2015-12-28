if (typeof app != 'undefined') {

app.service('PostsService', function ($http) {
	 angular.extend(this, new CrudService($http, 'posts'));
});

app.controller('PostsController', function ($scope, $timeout, $location, $route, PostsService, NotificationFactory) {
	angular.extend(this, new CrudController($scope, $timeout, $location, $route, PostsService, NotificationFactory));
	this.init();
	this.get_list();
});

app.controller('PostsDetailController', function ($scope, $timeout, $location, $route, $routeParams, PostsService, NotificationFactory) {
	angular.extend(this, new CrudController($scope, $timeout, $location, $route, PostsService, NotificationFactory));
	this.init();
	this.get_fiche($routeParams.id);
});

function AddPostsRoutes($routeProvider) {
	$routeProvider.when('/posts', {
		controller: 'PostsController',
		templateUrl: cf_options.rest_path + '/posts/list',
		menu: 'posts',
		title: 'Posts'
	}).when('/posts/:id', {
		controller: 'PostsDetailController',
		templateUrl: cf_options.rest_path + '/posts/detail',
		menu: 'posts',
	});
}

}
