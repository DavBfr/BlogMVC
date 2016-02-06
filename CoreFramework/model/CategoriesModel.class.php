<?php namespace DavBfr\CF;

class CategoriesModel extends BaseCategoriesModel {

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


    public static function getList() {
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


}
