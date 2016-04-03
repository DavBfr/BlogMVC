<?php namespace DavBfr\CF;

class UsersModel extends BaseUsersModel {

	public function dologin($login, $password) {
		$bdd = Bdd::getInstance();

		$user = $this->simpleSelect(array($bdd->quoteIdent(self::USERNAME) . "=:login"), array("login" => $login));

		if ($user->isEmpty()) {
			Logger::debug("User $login not found");
			return false;
		}

		$hash = $user->get(self::PASSWORD);
		$pwd = new Password();
		if (! $pwd->check($password, $hash)) {
			Logger::debug("Invalid password for $login");
			return false;
		}

		Logger::debug("User $login authenticated");
		return $user->getId();
	}


	public function setPasswordField($data, $value) {
		$pwd = new Password();

		if ($value == $data->get(self::PASSWORD)) {
			return $value;
		}

		return $pwd->hash($value);
	}

}
