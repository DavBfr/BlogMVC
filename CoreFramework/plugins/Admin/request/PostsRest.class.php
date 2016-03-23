<?php namespace DavBfr\CF;
Session::ensureLoggedin();

class PostsRest extends Crud {

	protected function getModel() {
		return new PostsModel();
	}


	protected function list_values($row) {
		$row[PostsModel::CONTENT] = substr($row[PostsModel::CONTENT], 0, 100) . "...";
		return $row;
	}

}
