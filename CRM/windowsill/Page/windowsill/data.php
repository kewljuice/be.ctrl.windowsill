<?php

require_once 'CRM/Core/Page.php';

class CRM_windowsill_Page_windowsill_data extends CRM_Core_Page {
  function run() {
	  	$json = array();
	  	// get action
		$data = json_decode(file_get_contents("php://input"));
		// switch
		switch ($data->action) {
			case 'views':
				// variables
				$view_array = views_get_all_views($reset = FALSE);
				// build array for each view and their display
				foreach($view_array as $view=>$v) {
					foreach($view_array[$view]->display as $display=>$d) {
						$arr = array('id'=>"$v->name:$display",'name'=>"$v->human_name ($d->display_title)");
						$json[] = $arr;
					}
				}
				break;
			case 'settings':
				// variables
				// log
				$settings = CRM_Core_BAO_Setting::getItem('windowsill', 'settings');
				$json = json_decode(utf8_decode($settings), true);
				break;
		}
		// return JSON 
		// http://wiki.civicrm.org/confluence/display/CRMDOC/Create+a+Module+Extension
		// http://civicrm.stackexchange.com/questions/2348/how-to-display-a-drupal-view-in-a-civicrm-tab
		print json_encode($json, JSON_PRETTY_PRINT);
		// exit
		CRM_Utils_System::civiExit();
  }
}
