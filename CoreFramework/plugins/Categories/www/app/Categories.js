app.service('CatService', function ($http) {
	var data_cache = null;

	this.get_list = function (onsuccess, onerror) {
		if (data_cache != null) {
			onsuccess && onsuccess(data_cache, 304);
			return;
		}

		$http.get(cf_options.rest_path + "/blog-cat").success(function (data, status) {
			if (data.success) {
				data_cache = data.list;
				onsuccess && onsuccess(data.list, status);
			} else
				onerror && onerror(data.error);
		}).error(function (data, status) {
			onerror && onerror(data, status);
		});
	};

});


app.controller('CatController', function ($scope, $location, CatService, NotificationFactory) {
	$scope.list = [];
	$scope.loading = true;

	CatService.get_list(function (data) {
		$scope.list = data;
		$scope.loading = false;
	}, function (data) {
		$scope.loading = false;
		NotificationFactory.error(data);
	});

	$scope.go_category = function (slug) {
		$location.path("/category/" + slug);
		$('html,body').scrollTop(0);
	};

});
