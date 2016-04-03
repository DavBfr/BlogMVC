<?php namespace DavBfr\CF;

class LoginRest extends AbstractLogin {

	public function getRoutes() {
		parent::getRoutes();
		$this->addRoute("/", "GET", "get_index");
	}


	protected function get_index() {
		$conf = Config::getInstance();
		if (Session::isLogged()) {
			Output::redirect(WWW_PATH);
		}

		$conf = Config::getInstance();
		$tpt = new TemplateRes(array(
				"title" => $conf->get("title"),
				"description" => $conf->get("description"),
				"favicon" => $conf->get("favicon", null),
		));

		$tpt->output("login.php");
	}


	protected function login($username, $password) {
		$users = new UsersModel();
		$userid = $users->dologin($username, $password);

		if ($userid === false)
			ErrorHandler::error(401, "Invalid username or password");

		return $userid;
	}


	protected function apiLogin($token) {
		return false;
	}


	protected function getUserData($userid) {
		$users = new UsersModel();
		$user = $users->getById($userid);


		return array("username" => $user->username);
	}

}
