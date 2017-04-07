app.service('BlogService', function ($http) {
	angular.extend(this, new CrudService($http, 'blog'));

	this.get_cat_list = function (filter, page, onsuccess, onerror) {
		if (page < 0) {
			onsuccess && onsuccess([], 200);
			return;
		}
		if (filter == undefined)
			filter = "";
		$http.get(service_url + "/category?p=" + page + "&q=" + filter).success(function (data, status) {
				onsuccess && onsuccess(data.list, status);
		}).error(function (data, status) {
			onerror && onerror(data, status);
		});
	};

	this.get_user_list = function (filter, page, onsuccess, onerror) {
		if (page < 0) {
			onsuccess && onsuccess([], 200);
			return;
		}
		if (filter == undefined)
			filter = "";
		$http.get(service_url + "/user?p=" + page + "&q=" + filter).success(function (data, status) {
			onsuccess && onsuccess(data.list, status);
		}).error(function (data, status) {
			onerror && onerror(data, status);
		});
	};

});


function BlogBaseController($scope, $timeout, $location, $route, BlogService, NotificationFactory) {
	angular.extend(this, new CrudController($scope, $timeout, $location, $route, BlogService, NotificationFactory));

	$scope.go_detail = function (id) {
		$location.path("/" + id);
		$('html,body').scrollTop(0);
	};

	$scope.go_category = function (id) {
		$location.path("category/" + id);
		$('html,body').scrollTop(0);
	};

	$scope.go_user = function (id) {
		$location.path("user/" + id);
		$('html,body').scrollTop(0);
	};

};


app.controller('BlogController', function ($scope, $timeout, $location, $route, BlogService, NotificationFactory) {
	angular.extend(this, new BlogBaseController($scope, $timeout, $location, $route, BlogService, NotificationFactory));
	this.init();
	this.get_list();
});


app.controller('BlogDetailController', function ($scope, $timeout, $location, $route, $routeParams, BlogService, NotificationFactory) {
	angular.extend(this, new BlogBaseController($scope, $timeout, $location, $route, BlogService, NotificationFactory));
	var self = this;

	this.get_fiche = function (id) {
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
