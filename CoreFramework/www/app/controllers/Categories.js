app.service('CatService', function ($http) {
	var data_cache = null;

	this.get_list = function (onsuccess, onerror) {
		if (data_cache != null) {
			onsuccess && onsuccess(data_cache, 304);
			return;
		}

		$http.get(cf_options.rest_path + "/categories/cat").success(function (data, status) {
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


app.controller('CatController', function ($scope, CatService, NotificationFactory) {
	$scope.list = [];
	$scope.loading = true;

	CatService.get_list(function (data) {
		$scope.list = data;
		$scope.loading = false;
	}, function (data) {
		$scope.loading = false;
		NotificationFactory.error(data);
	});

});
