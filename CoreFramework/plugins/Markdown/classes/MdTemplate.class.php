<?php

class MdTemplate extends Template {

	public function parse($filenames) {
		if (!is_array($filenames)) {
			$filenames = array($filenames);
		}

		$template = false;
		foreach ($filenames as $filename) {
			$template = self::findTemplate($filename);
			if ($template !== false)
			break;
		}
		if ($template === false)
			ErrorHandler::error(404, NULL, implode(", ", $filenames));

		return Markdown::transform(file_get_contents($template));
	}

}
