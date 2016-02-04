<?php namespace DavBfr\CF;

class MarkdownPlugin extends Plugins {

	public function resources($res) {
		$res->add("smde/simplemde.min.css");
		$res->add("smde/simplemde.min.js");
	}
}
