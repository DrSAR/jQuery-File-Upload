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
		$log   = KLogger::instance(dirname(__FILE__).'/logs', KLogger::DEBUG);
		$log->logInfo('REQUEST',$_REQUEST);

		$subdir = empty($_REQUEST['subdir']) ? '' : $this->trim_file_name($_REQUEST['subdir']);
		$this->options['upload_dir'] .= $subdir.'/';
		$this->options['upload_url'] .= $subdir.'/';
	        parent::initialize();
	}
}
$upload_handler = new CustomUploadHandler();
