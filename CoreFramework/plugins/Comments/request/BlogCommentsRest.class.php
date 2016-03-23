<?php namespace DavBfr\CF;

class BlogCommentsRest extends Rest {

	public function getRoutes() {
		$this->addRoute("/:id", "GET", "get_comments");
		$this->addRoute("/:id", "PUT", "post_comment");
	}


	protected function get_comments($r) {
		Input::ensureRequest($r, array("id"));
		$id = $r["id"];
		$list = CommentsModel::fromPost($id);
		Output::success(array("list" => $list));
	}


	protected function post_comment($r) {
		Input::ensureRequest($r, array("id"));
		$id = $r["id"];
		$posts = $this->jsonPost();
		Input::ensureRequest($posts, array("username", "mail", "content"));
		$comments = new CommentsModel();
		$comment = $comments->newRow();
		$comment->set(CommentsModel::POST_ID, $id);
		$comment->set(CommentsModel::USERNAME, $posts["username"]);
		$comment->set(CommentsModel::MAIL, $posts["mail"]);
		$comment->set(CommentsModel::CONTENT, $posts["content"]);
		$comment->save();
		$ret = $comment->getValues();
		$ret["gid"] = md5($ret[CommentsModel::MAIL]);
		unset($ret[CommentsModel::ID]);
		unset($ret[CommentsModel::POST_ID]);
		unset($ret[CommentsModel::MAIL]);
		Output::success($ret);
	}

}
