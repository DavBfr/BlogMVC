<?php

require_once(__DIR__ . "/../libs/Markdown.php");

class Markdown {

	public static function transform($data) {
		$md = new Michelf\Markdown();
		return $md->defaultTransform($data);
	}

}
