if (typeof app != 'undefined') {

app.service('BlogService', function ($http) {
	 angular.extend(this, new CrudService($http, 'blog'));
});


app.service('CommentService', function ($http) {
	var service_url = cf_options.rest_path + "/blog/comments";

	var onerror = function(data, status) {
	};

	this.get_list = function (id, onsuccess, onerror) {
		$http.get(service_url + "/" + id).success(function (data, status) {
			if (data.success)
				onsuccess && onsuccess(data.list, status);
			else
				onerror && onerror(data.error);
		}).error(function (data, status) {
			onerror && onerror(data, status);
		});
	};

	this.get_count = function (filter, onsuccess, onerror) {
		if (filter == undefined)
			filter = "";
		$http.get(service_url + "/count?q="+filter).success(function (data, status) {
			if (data.success)
				onsuccess && onsuccess(data);
			else
				onerror && onerror(data.error);
		}).error(function (data, status) {
			onerror && onerror(data, status);
		});
	};

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

app.controller('BlogDetailController', function ($scope, $timeout, $location, $route, $routeParams, BlogService, CommentService, NotificationFactory) {
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
			self.get_comments(data.data.id);
		}, function (data) {
			$scope.loading = false;
			NotificationFactory.error(data);
		});
	};

	this.get_comments = function(id) {
		$scope.comments_loading = true;
		CommentService.get_list(id, function (data) {
			$scope.comments = data;
			$scope.comments_loading = false;
		}, function (data) {
			$scope.comments_loading = false;
			NotificationFactory.error(data);
		});
	};

	this.init();
	this.get_fiche($routeParams.id);
});

}
