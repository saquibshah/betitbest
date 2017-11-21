<?php 

	function getFiles($dirhandler) {
		$files = array();

		while(false !== ($filename = readdir($dirhandler))) {
			$files[] = $filename;
		}

		return $files;
	}


?>