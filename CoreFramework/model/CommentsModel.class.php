<?php namespace DavBfr\CF;

class CommentsModel extends BaseCommentsModel {

  public static function fromPost($id) {
    $col = Collection::Query(self::TABLE)
      ->Select(self::USERNAME, self::CONTENT, self::CREATED)
      ->WhereEq(self::POST_ID, $id)
      ->orderByDesc(self::CREATED);
    $list = array();
    foreach($col->getValues(isset($_GET["p"])?intval($_GET["p"]):0) as $row) {
      $list[] = $row;
    }
    return $list;
  }
}
