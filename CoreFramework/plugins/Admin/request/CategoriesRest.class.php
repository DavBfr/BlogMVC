<?php namespace DavBfr\CF;
Session::ensureLoggedin();

class CategoriesRest extends Crud {

	public function getRoutes() {
		parent::getRoutes();
		$this->addRoute("/cat", "GET", "get_cat");
	}


	protected function getModel() {
		return new CategoriesModel();
	}


	protected function get_cat() {
		$list = CategoriesModel::getList();
		Output::success(array("list" => $list));
	}

}
