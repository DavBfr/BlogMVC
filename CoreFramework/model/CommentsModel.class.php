<?php namespace DavBfr\CF;

class CommentsModel extends BaseCommentsModel {

	public function newRow() {
		$data = parent::newRow();
		$data->set(self::CREATED, time());
		return $data;
	}


	public static function fromPost($id) {
		$col = Collection::Query(self::TABLE)
			->Select(self::USERNAME, self::CONTENT, self::CREATED, self::MAIL)
			->WhereEq(self::POST_ID, $id)
			->orderByDesc(self::CREATED);
		$list = array();
		foreach($col->getValues(isset($_GET["p"]) ? intval($_GET["p"]) : 0) as $row) {
			$row["gid"] = md5($row["mail"]);
			unset($row["mail"]);
			$list[] = $row;
		}
		return $list;
	}
}
