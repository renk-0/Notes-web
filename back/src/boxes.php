<?php namespace Boxes;
require_once "back/src/err_handling.php";
use Errs;
use mysqli;

function getBoxes() {
	$QUERY = "select * from boxes;";
	if($conn = new mysqli(
		"localhost",
		getenv("DB_USER"),
		getenv("DB_PASSWORD"),
		getenv("DB_DATABASE")
	)) {
		if($stm = $conn->prepare($QUERY)) {
			$stm->bind_param("s", $BOXES_RESULT);
			if($stm->execute()) { 
				$data = [];
				$result = $stm->get_result();
				while($row = $result->fetch_assoc())
					array_push($data, $row);
				$stm->free_result();
				echo json_encode($data);
			} else
				Errs::db_error($stm->error);
			$stm->close();
		} else
			Errs::db_error($conn->error);
		$conn->close();
	} else
		Errs::db_error($conn->error);
}

function addBox($box) {
	$QUERY = "insert into boxes(name) values(?);";
	if($conn = new mysqli(
		"localhost",
		getenv("DB_USER"),
		getenv("DB_PASSWORD"),
		getenv("DB_DATABASE")
	)) {
		if($stm = $conn->prepare($QUERY)) {
			$name = $box->getName();
			$stm->bind_param("s", $name);
			if(!$stm->execute())
				Errs::db_error($stm->error);
			else
				echo $stm->insert_id;
			$stm->close();
		} else
			Errs::db_error($conn->error);
		$conn->close();
	} else 
		Errs::db_error($conn->error);
}

function renameBox($box_id, $name) {
	$QUERY = "update boxes set name=? where id=?;";
	if($conn = new mysqli(
		"localhost",
		getenv("DB_USER"),
		getenv("DB_PASSWORD"),
		getenv("DB_DATABASE")
	)) {
		if($stm = $conn->prepare($QUERY)) {
			$stm->bind_param("si", $name, $box_id);
			if(!$stm->execute())
				Errs::db_error($stm->error);
			$stm->close();
		} else 
			Errs::db_error($conn->error);
		$conn->close();
	} else
		Errs::db_error($conn->error);
}

function deleteBox($box_id) {
	$QUERY = "delete from boxes where id=?;";
	if($conn = new mysqli(
		"localhost",
		getenv("DB_USER"),
		getenv("DB_PASSWORD"),
		getenv("DB_DATABASE")
	)) {
		if($stm = $conn->prepare($QUERY)) {
			$stm->bind_param("i", $box_id);
			if(!$stm->execute())
				Errs::db_error($stm->error);
			$stm->close();
		} else 
			Errs::db_error($conn->error);
		$conn->close();
	} else
		Errs::db_error($conn->error);
}
