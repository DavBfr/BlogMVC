<?php namespace DavBfr\CF;
//Session::ensureLoggedin();

class CategoriesRest extends Crud {

	protected function getModel() {
		return new CategoriesModel();
	}

}
