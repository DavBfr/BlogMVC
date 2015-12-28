<?php
//Session::ensureLoggedin();

class CategoriesRest extends Crud {

	protected function getModel() {
		return new CategoriesModel();
	}

}
