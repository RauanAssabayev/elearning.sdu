<?php
require "/../db.php";
session_start();
if($_POST['action'] == "addques"){
	$questions = R::dispense('questions');
	$questions->cid 		= $_POST['cid'];
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
	$sQuery = "select * from questions WHERE cid = '".$_POST['cid']."' 
	and number = '".$_POST['number']."' order by id desc LIMIT 1" ;
	$rows = R::getAll($sQuery);
	//echo $sQuery;
	print json_encode($rows);
// }elseif($_POST['action'] == 'getques'){
// 	$questions = R::dispense('questions');
// 	$questions->title 		= $_POST['title'];
// 	$questions->status 		= $_POST['status'];
// 	R::store($questions);
// 	echo 'success';
}elseif($_POST['action'] == 'saveanswer'){
	print_r($_POST);
	$answer = R::dispense('answers');
	$answer->user   	= $_POST['user'];
	$answer->cid   	    = $_POST['cid'];
	$answer->ques_id 	= $_POST['ques_id'];
	$answer->answer 	= $_POST['answer'];
	R::store($answer);
	echo 'success';
}elseif($_POST['action'] == 'finishquiz'){
	$user = $_POST['user'];
	$cid = $_POST['cid'];

	$sql = "select COUNT(k.answer) as correct from (SELECT t.* FROM (SELECT * FROM `answers` a where a.user = '".$user."' order by a.id DESC) t GROUP BY t.ques_id) k, questions q where k.answer = q.correct and k.cid = ".$cid." and k.ques_id = q.id and q.cid =".$cid;
	$rows = R::getAll($sql);
	$result = R::dispense('result');
	$result->user   	= $_POST['user'];
	$result->cid     	= $_POST['cid'];
	$result->corrects 	= $rows[0]['correct'];
	$result->percent 	= ($rows[0]['correct'] * 100 ) / $_POST['number'];
	$result->qsum 		= $_POST['number'];
	R::store($result);
	echo "SUCCESS";
}elseif($_POST['action'] == 'addarticle'){
	$articles = R::dispense('articles');
	$articles->courseid   = $_POST['courseid'];
	$articles->title   	= $_POST['title'];
	$articles->article 	= $_POST['article'];
	R::store($articles);
	echo 'success';
}else echo "ERROR";