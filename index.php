<?php
# Implementations
# the back/router one is my router class
include "api_config.php";
require_once "back/vendor/autoload.php";
require_once "back/router.php";
require_once "back/src/utils.php";
require "back/src/err_handling.php";

use Boxes\Box;
use Dotenv\Dotenv;
use Notes\Note;

$dotenv = new Dotenv("back");
$dotenv->load();

$METHOD = $_SERVER["REQUEST_METHOD"];
$ROUTE = $_GET["q"];

Router::add("getBoxes", function(){
	require_once "back/src/boxes.php";
	\Boxes\getBoxes(0);
}, "get");

Router::add("addBox", function() {
	require_once "back/src/boxes_model.php";
	require_once "back/src/boxes.php";

	$data = get_Json();
	if(checkFields($data, ["name"])) {
		$box = new Box($data);
		\Boxes\addBox($box);
	} else 
		Errs::fields_error();
}, "post");

Router::add("renameBox", function() {
	require_once "back/src/boxes.php";
	
	$data = get_Json();
	if(checkFields($data, ["name", "box_id"]))
		\Boxes\renameBox($data->box_id, $data->name);
	else 
		Errs::fields_error();
}, "post");

Router::add("deleteBox", function() {
	require_once "back/src/boxes.php";
	
	$data = get_Json();
	if(checkFields($data, ["box_id"]))
		\Boxes\deleteBox($data->box_id); 
	else
		Errs::fields_error();
}, "post");

Router::add("getNotes", function() {
	require_once "back/src/notes.php";
	$data = get_Json();
	if(checkFields($data, ["box_id"])) 
		\Notes\getNotes($data->box_id);
	else 
		Errs::fields_error();
}, "get");

Router::add("addNote", function() {
	require_once "back/src/notes.php";
	require_once "back/src/notes_model.php";
	
	$data = get_Json();
	if(checkFields($data, ["name", "content", "box_id"])) {
		$note = new Note($data);
		\Notes\addNote($note);
	} else 
		Errs::fields_error();
}, "post");

Router::add("updateNote", function() {
	require_once "back/src/notes.php";
	require_once "back/src/notes_model.php";

	$data = get_Json();
	if(checkFields($data, ["note_id", "name", "content", "box_id"])) {
		$nNote = new \Notes\Note($data);
		\Notes\updateNote($nNote, $data->note_id);
	} else 
		Errs::fields_error();
}, "post");

Router::add("deleteNote", function() {
	require_once "back/src/notes.php";
	$data = get_Json();
	if(checkFields($data, ["note_id"]))
		\Notes\removeNote($data->note_id);
	else
		Errs::fields_error();
}, "post");

Router::eval($METHOD, $ROUTE);
