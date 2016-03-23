app.service('CommentService', function ($http) {
	var service_url = cf_options.rest_path + "/blog-comments";

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

	this.save = function(post, user, email, content, onsuccess, onerror) {
		$http.put(service_url + "/" + post, {'username': user, 'mail': email, 'content': content}).success(function (data, status) {
			if (data.success)
				onsuccess && onsuccess(data);
			else
				onerror && onerror(data.error);
		}).error(function (data, status) {
			onerror && onerror(data, status);
		});
	};

});


app.controller('CommentsController', function ($scope, $location, CommentService, NotificationFactory) {
	$scope.comments = [];
	$scope.comment_error = false;
	var self = this;

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

	$scope.save_comment = function() {
		$scope.comment_submitting = true;
		CommentService.save($scope.item.id, $scope.comment_user, $scope.comment_email, $scope.comment_content, function (data) {
			$scope.comment_error = false;
			$scope.comments.unshift(data);
			$scope.comment_content = "";
			$scope.comment_submitting = false;
		}, function (err) {
			$scope.comment_submitting = false;
			$scope.comment_error = err;
		});
	}

	$scope.$parent.$watch('item.id', function () {
		if ($scope.$parent.item.id != undefined) {
			self.get_comments($scope.$parent.item.id);
		}
	});
});
