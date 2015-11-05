<?php

require_once 'CRM/Core/Page.php';

class CRM_windowsill_Page_windowsill_render extends CRM_Core_Page {
  function run() {
	// get html from view by setting_name
	$setting = $_REQUEST['name'];
	// get settings from civicrm
	$settings = CRM_Core_BAO_Setting::getItem('windowsill', 'settings');
	$decode = json_decode(utf8_decode($settings), true);
	// variables
	$error = TRUE;
	$content = "";
	$view = array();
	// loop settings		
	foreach ($decode as &$value) {
	// get view data if setting exists
		if($setting  == $value['name']) {
			$error = FALSE;
			$view = explode(':',$value['view']);
			break;
		}
	}
	// check if setting exists & set page variables
	if(!$error) { 
		$title = $setting;    
		$content .= views_embed_view($view[0], $view[1]) . "<br>";
	} else {
		$title = "Configuration error";    
		$content .= "Check your windowsill settings.";
	}	
	// assign page title
    CRM_Utils_System::setTitle(ts('WindowSill Render'));	
	// assign a variable for use in a template
    $this->assign('title', $title);
	$this->assign('content', $content);
	// render
    parent::run();
  }
}