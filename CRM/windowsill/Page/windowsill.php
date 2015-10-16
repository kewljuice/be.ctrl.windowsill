<?php

require_once 'CRM/Core/Page.php';

class CRM_windowsill_Page_windowsill extends CRM_Core_Page {
  function run() {
    // title
    CRM_Utils_System::setTitle(ts('WindowSill'));
	
		// variables
		$url = CRM_Utils_System::url() . "civicrm/ctrl/windowsill";
		$this->assign('url', $url);		
	
		// assign form
		$form = "";
    $this->assign('content', $form);
		
		// render
    parent::run();
  }
}
