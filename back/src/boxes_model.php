<?php namespace Boxes;
class Box {
	private $name;
	function __construct($jdata) {
		$this->name = $jdata->name;
	}
	function getName() {
		$name = null;
		if(strlen($this->name) > 0) {
			$name = trim($this->name);
		}
		return $name;
	}
}
