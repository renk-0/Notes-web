<?php namespace Notes;
require_once "back/src/err_handling.php";
use Errs;
use mysqli;

function getNotes($box_id) {
	$QUERY = "select * from notes where box=?;";
	if($conn = new mysqli("localhost",
		getenv("DB_USER"),
		getenv("DB_PASSWORD"),
		getenv("DB_DATABASE")
	)) {
		if($stm = $conn->prepare($QUERY)) {
			$stm->bind_param("i", $box_id);
			if($stm->execute()) {
				$data = [];
				$result = $stm->get_result();
				while($row = $result->fetch_assoc())
					array_push($data, $row);
				$stm->free_result();
				echo json_encode($data);
			} else
				Errs::db_error();
			$stm->close();
		} else
			Errs::db_error($conn->error);
		$conn->close();
	} else 
		Errs::db_error($conn->error);	
}

function addNote($note) {
	$QUERY = "insert into notes(name, content, box) values(?, ?, ?)";
	if($conn = new mysqli("localhost",
		getenv("DB_USER"),
		getenv("DB_PASSWORD"),
		getenv("DB_DATABASE")
	)) {
		if($stm = $conn->prepare($QUERY)) {
			$name = $note->getName();
			$box = $note->getBox();
			$stm->bind_param("ssi", 
				$name,
				$note->content, 
				$box);
			if(!$stm->execute())
				Errs::db_error($stm->error);
			$stm->close();
		} else 
			Errs::db_error($conn->error);
		$conn->close(); 
	} else
		Errs::db_error($conn->error);
}

function updateNote($new_note, $note_id) {
	$QUERY = "update notes set name=?, content=? where id=?;";
	if($conn = new mysqli("localhost",
		getenv("DB_USER"),
		getenv("DB_PASSWORD"),
		getenv("DB_DATABASE")
	)) {
		if($stm = $conn->prepare($QUERY)) {
			$new_name = $new_note->getName();
			$stm->bind_param("ssi", 
				$new_name,
				$new_note->content,
				$note_id);
			if(!$stm->execute()) 
				Errs::db_error($conn->error);
			$stm->close();
		} else 
			Errs::db_error($conn->error);
		$conn->close();
	} else
		Errs::db_error($conn->error);
}

function removeNote($note_id) {
	$QUERY = "delete from notes where id=?";
	if($conn = new mysqli("localhost",
		getenv("DB_USER"),
		getenv("DB_PASSWORD"),
		getenv("DB_DATABASE")
	)) {
		if($stm = $conn->prepare($QUERY)) {
			$stm->bind_param("i", $note_id);
			if(!$stm->execute())
				Errs::db_error($stm->error);
			$stm->close();
		} else 
			Errs::db_error($conn->error);
		$conn->close();
	} else
		Errs::db_error($conn);
}
