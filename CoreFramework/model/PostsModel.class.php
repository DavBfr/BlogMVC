<?php namespace DavBfr\CF;

class PostsModel extends BasePostsModel {

  public function newRow() {
    $data = parent::newRow();
    $data->set(self::CREATED, time());
    $data->set(self::USER_ID, 0);
    return $data;
  }


  public function setNameField($data, $value) {
    if ($data->get(self::SLUG) == NULL)
      $data->set(self::SLUG, Slug::create($value));
    return $value;
  }


  public function setSlugField($data, $value) {
    if ($value == NULL)
      return $data->get(self::SLUG);
    return $value;
  }


  public function dataChanged() {
    $cats = new CategoriesModel();
    foreach($cats->simpleSelect() as $cat) {
      $nb = Collection::Query(self::TABLE)->whereEq(self::CATEGORY_ID, $cat->getId());
      $cat->set(CategoriesModel::POST_COUNT, $nb);
      $cat->save();
    }
  }

}
