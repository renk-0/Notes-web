<?php 
function get_Json() {
	$json_str = file_get_contents('php://input');
	return json_decode($json_str);
}

function checkFields($json, $fields) {
	foreach($fields as $field) {
		if(!isset($json->$field))
			return false;
	}
	return true;
}
