<?php
require "/../db.php";
session_start();
if($_POST['action'] == "addques"){
	$questions = R::dispense('questions');
	$questions->title 		= $_POST['title'];
	$questions->number 		= $_POST['number'];
	$questions->type        = $_POST['type'];
	$questions->question    = $_POST['question'];
	$questions->correct    =  $_POST['correct'];
	$questions->a 			= $_POST['a'];
	$questions->b 			= $_POST['b'];
	$questions->c 			= $_POST['c'];
	$questions->d 			= $_POST['d'];
	R::store($questions);
	echo 'success';
}elseif($_POST['action'] == 'remques'){
		$sQuery = "DELETE FROM course WHERE id = ".$_POST['id'];
		R::exec($sQuery);
	//header('Location: main.php');
	echo $sQuery;
}elseif($_POST['action'] == 'getques'){
	$sQuery = "select * from questions WHERE title = '".$_POST['title']."' 
	and number = '".$_POST['number']."' order by id desc LIMIT 1" ;
	$rows = R::getAll($sQuery);
	//echo $sQuery;
	print json_encode($rows);
}else echo "ERROR";






