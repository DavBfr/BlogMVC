<?php namespace DavBfr\CF;

class PostsModel extends BasePostsModel {

  public function newRow() {
    $data = parent::newRow();
    $data->set(self::CREATED, time());
    $data->set(self::USER_ID, 0);
    return $data;
  }


  public function setNameField($data, $value) {
    if ($data->get(self::SLUG) == null)
      $data->set(self::SLUG, Slug::create($value));
    return $value;
  }


  public function setSlugField($data, $value) {
    if ($value == null)
      return $data->get(self::SLUG);
    return $value;
  }


  public function dataChanged() {
    Logger::info("PostsModel modified");
    $cache = new MemCache();
    $cache["posts-modified"] = true;
  }


  public static function isModified() {
    if (!MEMCACHE_ENABLED || (isset($cache["posts-modified"]) && $cache["posts-modified"] == true)) {
      $cache["posts-modified"] = false;
      return true;
    }
    return false;
  }

}
