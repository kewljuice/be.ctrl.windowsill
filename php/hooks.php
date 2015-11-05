<?php

/**
 * implementation of CiviCRM navigationMenu hook.
 */
function windowsill_civicrm_navigationMenu(&$params) {
	//  Get the maximum key of $params.
 	$nextKey = ( max(array_keys($params)) );
	// Check for Administer navID.
	foreach($params as $k => $v) {
	  if($v['attributes']['name'] == 'Administer') { $AdministerKey = $v['attributes']['navID']; }	
	}
	// Check for Parent navID.
	foreach($params[$AdministerKey]['child'] as $k => $v) {
		if($v['attributes']['name'] == 'CTRL') { $parentKey = $v['attributes']['navID']; }	
	}
	// If Parent navID doesn't exist create.
	if(!isset($parentKey)) {
	  // Create parent array
	  $parent = array(
				  'attributes' => array(	
					  'label' => 'CTRL', 
					  'name' => 'CTRL',
					  'url' => null,
					  'permission' => 'access CiviCRM',
					  'operator' => null,
					  'separator' => 0,
					  'parentID' => $AdministerKey,
					  'navID' => $nextKey,
					  'active' => 1 ),
				  'child' => null );
	  // Add parent to Administer					
	  $params[$AdministerKey]['child'][$nextKey] = $parent;
	  $parentKey = $nextKey;
	  $nextKey++;	
	}
	// Create child(s) array
	$child = array(
				'attributes' => array(	
				  'label' => 'WindowSill', 
				  'name' => 'ctrl_windowsill',
				  'url' => 'civicrm/ctrl/windowsill',
				  'permission' => 'access CiviCRM',
				  'operator' => null,
				  'separator' => 0,
				  'parentID' => $parentKey,
				  'navID' => $nextKey,
				  'active' => 1 ),
				'child' => null );
	// Add child(s) for this extension
	$params[$AdministerKey]['child'][$parentKey]['child'][$nextKey]  = $child;
}

/**
 * implementation of CiviCRM tabs hook.
 */
function windowsill_civicrm_tabs( &$tabs, $contactID ) {
	// Get settings from civicrm
	$settings = CRM_Core_BAO_Setting::getItem('windowsill', 'settings');
	$decode = json_decode(utf8_decode($settings), true);
	// Loop settings		
	$c = 300;
	foreach ($decode as &$value) {
		// Check if tab is configured
		if($value['tab']) {
			// Get view data if setting exists
			$url = CRM_Utils_System::url('civicrm/ctrl/windowsill/render',"reset=1&cid=$contactID&name=".$value['name']);
			$tabs[] = array('id' => str_replace(' ','_',$value['name']), 'url' => $url, 'title' => $value['name'], 'weight' => $c++);
		}
	}
}

/**
 * implementation of CiviCRM tokens hook.
 */
function windowsill_civicrm_tokens(&$tokens) {
	// Register tokens
	$tokens['windowsill'] = array();
	// Get settings from civicrm
	$settings = CRM_Core_BAO_Setting::getItem('windowsill', 'settings');
	$decode = json_decode(utf8_decode($settings), true);
	// Loop settings	
	foreach ($decode as &$value) {
		// Check if tab is configured
		if($value['token']) {
			$token = str_replace(' ','_',$value['name']);
			// create token
			$tokens['windowsill']['windowsill.'.$token] = 'windowsill: ' . $token;
		}
	}
}

/**
 * implementation of CiviCRM tokenValues hook.
 */
function windowsill_civicrm_tokenValues(&$values,&$contactIDs,$jobID,$tokens=array(),$context=null) {
	// Get settings from civicrm
	$settings = CRM_Core_BAO_Setting::getItem('windowsill', 'settings');
	$decode = json_decode(utf8_decode($settings), true);
	// Loop settings	
	foreach ($decode as &$value) {
		// Check if tab is configured
		if($value['token']) {
			$name = str_replace(' ','_',$value['name']);
			$view = explode(':',$value['view']);
			// Rendered
			$rendered = views_embed_view($view[0], $view[1]) ;
			/*
			// absolute paths are set to url paths (Anchor tags)
			//$rendered['windowsill:'.$name] = preg_replace('/<\s*a\s(.*?)href="\/(.*?)"(.*?)>/i', '<a $1href="'.$base_url.$base_path.'$2"$3>', $rendered['windowsill:'.$name]);
			//$rendered['windowsill:'.$name] = preg_replace('/<\s*img\s(.*?)src="\/(.*?)"(.*?)>/i', '<img $1src="'.$base_url.$base_path.'$2"$3>', $rendered['windowsill:'.$name]);
			*/
			// Set token
			foreach ($contactIDs as $contactID) { $values[$contactID]['windowsill.'.$name] = $rendered; }
		}
	}
}
			
?>