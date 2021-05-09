<?php namespace Notes;
class Note {
	private $name;
	public $content;
	private $box_data;
	function __construct($json) {
		$this->name = $json->name;
		$this->content = $json->content;
		$this->box_id = $json->box_id;
	}
	
	function getName() {
		$name = null;
		if(strlen($this->name) > 0)
			$name = trim($this->name);
		return $name;
	}
	function getBox() { return $this->box_id; }
}
