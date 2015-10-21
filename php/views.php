<?php

// variables
$view_array = views_get_all_views($reset = FALSE);
$list = "";

// for each view
foreach($view_array as $view=>$v) {
	foreach($view_array[$view]->display as $display=>$d) {
		$list .= "<li>$view:$display</li>";
	}
}

?>