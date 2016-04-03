app.service('UserService', function ($http) {
	angular.extend(this, new CrudService($http, 'blog/user'));

	this.get_list = function (filter, page, onsuccess, onerror) {
		if (page < 0) {
			onsuccess && onsuccess([], 200);
			return;
		}
		$http.get(this.getServiceUrl() + "/" + filter + "?p=" + page).success(function (data, status) {
			if (data.success)
				onsuccess && onsuccess(data.list, status);
			else
				onerror && onerror(data.error);
		}).error(function (data, status) {
			onerror && onerror(data, status);
		});
	};

	this.get_count = function (filter, onsuccess, onerror) {
		$http.get(this.getServiceUrl() + "/" + filter + "/count").success(function (data, status) {
			if (data.success)
				onsuccess && onsuccess(data);
			else
				onerror && onerror(data.error);
		}).error(function (data, status) {
			onerror && onerror(data, status);
		});
	};

});

app.controller('UserController', function ($scope, $timeout, $location, $route, $routeParams, UserService, NotificationFactory) {
	angular.extend(this, new BlogBaseController($scope, $timeout, $location, $route, UserService, NotificationFactory));
	this.init();
	$scope.filter = $routeParams.id;
	this.get_list();
});
