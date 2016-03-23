<?php namespace DavBfr\CF;

class BlogCatRest extends Crud {

	public function getRoutes() {
		$this->addRoute("/", "GET", "get_cat");
		$this->addRoute("/list", "GET", "get_catlist");
	}


	protected function getModel() {
		return new CategoriesModel();
	}


	protected function get_cat() {
		$list = CategoriesModel::getList();
		Output::success(array("list" => $list));
	}


	protected function get_catlist($r) {
		$tpt = new Template($this->options);
		$tpt->outputCached("cat-posts.php");
	}


}
