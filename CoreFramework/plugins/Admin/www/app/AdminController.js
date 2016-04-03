app.controller('AdminController', function ($scope, $location, $http, NotificationFactory, LoginService) {
	init();

	function init() {
		$scope.user = LoginService.getUser();
		$scope.userdata = {
			"username": "User"
		}
		LoginService.getUserInfos(function (data) {
			$scope.userdata = data;
		});
	}

	$scope.hasRight = function (right) {
		return LoginService.hasRight(right);
	};

	$scope.logout = function () {
		LoginService.logout(function (message) {
			$scope.user = LoginService.getUser();
			$scope.userdata = {};
			if (message) {
				NotificationFactory.success(message);
			}
		});
	};

	$scope.login = function (username, password) {
		LoginService.login(username, password, function (rights, message) {
			$scope.user = LoginService.getUser();
			LoginService.getUserInfos(function (data) {
				$scope.userdata = data;
			});
			if (message) {
				NotificationFactory.success(message);
			}
		});
	};

});
