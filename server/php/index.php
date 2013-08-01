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
		$subdir = array_key_exists('subdir', $_REQUEST) ? trim(basename(stripslashes($_REQUEST['subdir'])), ".\x00..\x20") : '';
		$subdir = empty($subdir) ? '' : $this->trim_file_name($_REQUEST['subdir']);
		$customdir = empty($_REQUEST['customdir']) ? '' : $_REQUEST['customdir'].'/';
		$this->options['upload_dir'] .= $subdir.$customdir;
		$this->options['upload_url'] .= $subdir.$customdir;
	        parent::initialize();
	}
}
$upload_handler = new CustomUploadHandler();
