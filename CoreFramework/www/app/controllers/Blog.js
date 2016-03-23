app.service('BlogService', function ($http) {
	 angular.extend(this, new CrudService($http, 'blog'));
});


app.controller('BlogController', function ($scope, $timeout, $location, $route, BlogService, NotificationFactory) {
	angular.extend(this, new CrudController($scope, $timeout, $location, $route, BlogService, NotificationFactory));
	this.init();
	this.get_list();

	$scope.go_detail = function(id) {
		$location.path("/" + id);
		$('html,body').scrollTop(0);
	};

	$scope.go_category = function(id) {
		$location.path("category/" + id);
		$('html,body').scrollTop(0);
	};

});


app.controller('BlogDetailController', function ($scope, $timeout, $location, $route, $routeParams, BlogService, NotificationFactory) {
	angular.extend(this, new CrudController($scope, $timeout, $location, $route, BlogService, NotificationFactory));
	var self = this;

	$scope.go_category = function(id) {
		$location.path("category/" + id);
		$('html,body').scrollTop(0);
	};

	$scope.go_user = function(id) {
		$location.path("user/" + id);
		$('html,body').scrollTop(0);
	};

	this.get_fiche = function(id) {
		BlogService.getOne(id, function (data) {
			$scope.id = id;
			$scope.item = data.data;
			$scope.loading = false;
		}, function (data) {
			$scope.loading = false;
			NotificationFactory.error(data);
		});
	};

	this.init();
	$scope.comment_error = false;
	this.get_fiche($routeParams.id);
});
