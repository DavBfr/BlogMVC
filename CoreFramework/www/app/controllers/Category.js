app.service('CategoryService', function ($http) {
	angular.extend(this, new CrudService($http, 'blog/cat'));

	this.get_list = function (filter, page, onsuccess, onerror) {
		if (page < 0) {
			onsuccess && onsuccess([], 200);
			return;
		}
		$http.get(this.getServiceUrl() + "/" + filter + "?p=" + page).success(function (data, status) {
			onsuccess && onsuccess(data.list, status);
		}).error(function (data, status) {
			onerror && onerror(data, status);
		});
	};

	this.get_count = function (filter, onsuccess, onerror) {
		$http.get(this.getServiceUrl() + "/" + filter + "/count").success(function (data, status) {
			onsuccess && onsuccess(data);
		}).error(function (data, status) {
			onerror && onerror(data, status);
		});
	};

});

app.controller('CategoryController', function ($scope, $timeout, $location, $route, $routeParams, CategoryService, NotificationFactory) {
	angular.extend(this, new BlogBaseController($scope, $timeout, $location, $route, CategoryService, NotificationFactory));
	this.init();
	$scope.filter = $routeParams.id;
	this.get_list();
});
