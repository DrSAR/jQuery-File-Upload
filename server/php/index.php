<?php
/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);
require('KLogger.php');
require('UploadHandler.php');

class CustomUploadHandler extends UploadHandler {
	protected function initialize() {
		# subdir will begin and end in a slash or be fully empty
		$subdir = array_key_exists('subdir', $_REQUEST) ? trim(stripslashes($_REQUEST['subdir']), ".\x00..\x20") : '';

		$customdir = empty($_REQUEST['customdir']) ? '' : $_REQUEST['customdir'].'/';
		$this->options['upload_dir'] .= $subdir.$customdir;
		$this->options['upload_url'] .= $subdir.$customdir;
	        parent::initialize();
	}
}
$upload_handler = new CustomUploadHandler();
