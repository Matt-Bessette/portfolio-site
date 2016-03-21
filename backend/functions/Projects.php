<?php

## require_once '../settings/Codes.php';

function FetchAllProjects($con) {
	
	$gproj = $con->prepare('select _id, name, description, github, date, img from projects');

	$gproj->execute();

	return $gproj->fetchAll(PDO::FETCH_ASSOC);

}

function FetchProjectById($con, $id) {

	$gproj = $con->prepare('select _id, name, description, github, date, img from projects where _id = ?');

	$gproj->execute([$id]);

	return $gproj->fetch(PDO::FETCH_ASSOC);

}

function CreateProject($con, $p) {

	if(!isset($p['name'], $p['description'], $p['github'], $p['date'], $p['img'])) 
		throw new Exception(MISSINGDATA);

	$ins = $con->prepare('insert into projects (name, description, github, date, img) values (?, ?, ?, ?, ?)');

	$ins->execute([
		$p['name'], $p['description'], $p['github'], $p['date'], $p['img']
	]);

	return OK;

}

function UpdateProject($con, $id, $p) {

	$o = [];
	$v = [];

	if(isset($p['name'])) {
		$o[] = 'name=?';
		$v[] = $p['name'];
	}
	if(isset($p['description'])) {
		$o[] = 'description=?';
		$v[] = $p['description'];
	}
	if(isset($p['github'])) {
		$o[] = 'github=?';
		$v[] = $p['github'];
	}
	if(isset($p['date'])) {
		$o[] = 'date=?';
		$v[] = $p['date'];
	}
	if(isset($p['img'])) {
		$o[] = 'img=?';
		$v[] = $p['img'];
	}

	if(count($o) === 0)
		throw new Exception(MISSINGDATA);

	$v[] = $id;

	$uproj = $con->prepare('update projects set '.implode(',', $o).' where _id=?');

	$uproj->execute($v);

	return OK;

}

function DeleteProject($con, $id) {

	$dproj = $con->prepare('delete from projects where _id = ?');

	$dproj->execute([$id]);

	return OK;

}