<?php
class Errs {
	static private $DEBUG = true;

	static public function db_error($db_debug_data = null) {
		echo "Databse error <br>";
		if(self::$DEBUG) {
			echo "<pre>";
			print_r($db_debug_data);
			echo "</pre>";
		}
		http_response_code(500);
	}

	static public function fields_error() {
		echo "Fill fields properly <br>";
		http_response_code(400);
	}
}
