<?php namespace DavBfr\CF;

class CFAppPlugin extends Plugins {

	public function resources($resources) {
	}


	protected function init() {
	}


	public function config($conf) {
	}


	public function install() {
		$bdd = Bdd::getInstance();
		$filename = DATA_DIR . "/data.json";
		Cli::pinfo("Import $filename in database");
		$data = json_decode(file_get_contents($filename));
		$bdd->import($data);
	}


	public function cli($cli) {
	}

}
