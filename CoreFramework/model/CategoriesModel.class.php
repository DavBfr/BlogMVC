<?php namespace DavBfr\CF;

class CategoriesModel extends BaseCategoriesModel {

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


    public static function getList() {
      if (PostsModel::isModified())
        self::updateCounts();

      $col = Collection::Query(self::TABLE)
        ->Select(self::SLUG, self::NAME, self::POST_COUNT)
        ->orderBy(self::NAME)
        ->limit(20);
      $list = array();
      foreach($col->getValues() as $row) {
        $list[] = $row;
      }
      return $list;
    }


    public static function updateCounts() {
      $cats = new self();
      foreach($cats->simpleSelect() as $cat) {
        $nb = Collection::Query(PostsModel::TABLE)->whereEq(PostsModel::CATEGORY_ID, $cat->getId())->getCount();
        $cat->set(self::POST_COUNT, $nb);
        $cat->save();
      }
    }


}
