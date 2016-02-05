<?php namespace DavBfr\CF;
//Session::ensureLoggedin();

class CategoriesRest extends Crud {
	
	public function getRoutes() {
		parent::getRoutes();
		$this->addRoute("/cat", "GET", "get_cat");
	}


	protected function getModel() {
		return new CategoriesModel();
	}
	
	
	protected function get_cat() {
		$col = Collection::Query(CategoriesModel::TABLE)
			->Select(CategoriesModel::SLUG, CategoriesModel::NAME, CategoriesModel::POST_COUNT)
			->orderBy(CategoriesModel::NAME)
			->limit(20);
		$list = array();
		foreach($col->getValues() as $row) {
			$list[] = $row;
		}

		Output::success(array("list"=>$list));
	}

}
