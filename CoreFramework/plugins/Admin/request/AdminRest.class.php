<?php namespace DavBfr\CF;
Session::ensureLoggedin();

class CategoriesRest extends Rest {

	public function getRoutes() {
		parent::getRoutes();
		$this->addRoute("/", "GET", "get_index");
	}


	protected function get_index() {
		$list = CategoriesModel::getList();
		Output::success(array("list" => $list));
	}

}
