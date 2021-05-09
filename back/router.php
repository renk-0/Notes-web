<?php

class Router {
	static private $routes = [];
	static public $not_found = null;

	static public function add($route, $function, $method) {
		self::$routes[$route] = [
			"method" => $method, 
			"func" => $function
		];
	}

	static public function eval($METHOD, $ROUTE) {
		if(isset(self::$routes[$ROUTE])) {
			$route = self::$routes[$ROUTE];
			$METHOD = strtolower($METHOD);
			$method = strtolower($route["method"]);
			if($METHOD === $method) {
				call_user_func($route["func"], null);
				exit;
			} else if($METHOD == "options")
				exit;
		}
		http_response_code(404);
		if(!is_null(self::$not_found))
			require self::$not_found;
		else
			echo "Not found";
		exit;
	}
}
