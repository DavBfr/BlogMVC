<?php namespace DavBfr\CF;
//Session::ensureLoggedin();

class BlogRest extends Crud {

	public function getRoutes() {
		parent::getRoutes();
		$this->addRoute("/comments/:id", "GET", "get_comments");
		$this->addRoute("/catlist", "GET", "get_catlist");
	}


	protected function getModel() {
		return new PostsModel();
	}


	protected function getOptions() {
		return array(
			"list_partial"=>"blog-list.php",
			"detail_partial"=>"blog-entry.php",
			"limit" => 5,
		);
	}


	protected function filterList($col) {
		$this->filterListField($col, $this->model->getField(PostsModel::NAME));
		$this->filterListField($col, $this->model->getField(PostsModel::CONTENT));
		$this->filterListField($col, $this->model->getField(PostsModel::CONTENT));
		$this->filterListField($col, $this->model->getField(PostsModel::SLUG));
		$this->filterListField($col, $this->model->getField(PostsModel::CREATED));
	}


	protected function list_values($row) {
		$row[PostsModel::CONTENT] = Markdown::transform(substr($row[PostsModel::CONTENT], 0, 200) . "...");
		return $row;
	}


	protected function get_list($r) {
		$col = Collection::Query($this->model->getTableName())
			->SelectAs($this->model->getField($this->model->getPrimaryField())->getFullName(), self::ID)

			->leftJoin(CategoriesModel::TABLE, CategoriesModel::TABLE.".".CategoriesModel::ID ."=". PostsModel::TABLE.".".PostsModel::CATEGORY_ID)
			->SelectAs(CategoriesModel::TABLE.".".CategoriesModel::NAME, "catname")
			->SelectAs(CategoriesModel::TABLE.".".CategoriesModel::SLUG, "catslug")

			->leftJoin(UsersModel::TABLE, UsersModel::TABLE.".".UsersModel::ID ."=". PostsModel::TABLE.".".PostsModel::USER_ID)
			->orderByDesc(PostsModel::CREATED)
			->SelectAs(UsersModel::TABLE.".".UsersModel::USERNAME, "username")
			->limit($this->options["limit"]);
		$this->filterList($col);

//Query SELECT posts.id as CRUD_ID_FIELD, posts.name as name, posts.content as content, posts.slug as slug, posts.created as created FROM posts LEFT JOIN categories ON id=category_id ORDER BY created desc LIMIT 0, 5  []

		if (isset($_GET["q"]) && strlen($_GET["q"])>0) {
			$col->filter($_GET["q"]);
		}

		$list = array();
		foreach($col->getValues(isset($_GET["p"])?intval($_GET["p"]):0) as $row) {
			$list[] = $this->list_values($row);
		}

		Output::success(array("list"=>$list));
	}


	protected function get_item($r) {
		Input::ensureRequest($r, array("id"));
		$id = $r["id"];
		$item = $this->model->getBy(PostsModel::SLUG, $id);
		Logger::debug("Fetch $id");
		$values = array();
		$values["id"] = $item->get("id");
		$values["slug"] = $item->get("slug");
		$values["created"] = $item->get("created");
		$values["name"] = $item->get("name");
		$values["content"] = Markdown::transform($item->get("content"));

		$cats = new CategoriesModel();
		$cat = $cats->getById($item->get("category_id"));
		$values["category"] = $cat->get("name");
		$values["category_slug"] = $cat->get("slug");

		$users = new UsersModel();
		$user = $users->getById($item->get("user_id"));
		$values["user"] = $user->get("username");

		Output::success(array(self::ID=>$id, "foreigns"=>array(), "data"=>$values));
	}


	protected function get_comments($r) {
		Input::ensureRequest($r, array("id"));
		$id = $r["id"];
		$list = CommentsModel::fromPost($id);
		Output::success(array("list"=>$list));
	}


	protected function get_catlist($r) {
		$tpt = new Template($this->options);
		$tpt->outputCached("cat-posts.php");
	}

}
