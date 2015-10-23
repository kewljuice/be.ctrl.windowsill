<?php

require_once 'CRM/Core/Page.php';

class CRM_windowsill_Page_windowsill_views extends CRM_Core_Page {
  function run() {
		// variables
		$view_array = views_get_all_views($reset = FALSE);
		$json = array();
		// build array for each view and their display
		foreach($view_array as $view=>$v) {
			foreach($view_array[$view]->display as $display=>$d) {
				$arr = array('id'=>"$v->name:$display",'name'=>"$v->human_name ($d->display_title)");
				$json[] = $arr;
			}
		}
		// return JSON 
		// http://wiki.civicrm.org/confluence/display/CRMDOC/Create+a+Module+Extension
		// http://civicrm.stackexchange.com/questions/2348/how-to-display-a-drupal-view-in-a-civicrm-tab
		print json_encode($json, JSON_PRETTY_PRINT);
		// exit
		CRM_Utils_System::civiExit();
  }
}
