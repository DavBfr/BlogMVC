<?php
//Session::ensureLoggedin();

class UsersRest extends Crud {

	protected function getModel() {
		return new UsersModel();
	}

}
