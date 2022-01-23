<?php


//DBへ接続


$user_id = $_POST['user_id'];
$starttime = $_POST['start'];
$time = $_POST['time'];
$url = $_POST['url'];

try{
	$stt = $db->prepare('insert into access_log (user_id,url,chara,post_id,time,created,modified) values(:user_id,:url,:chara,:post_id,:time,now(),now())');
	$stt->bindValue(':user_id',$user_id);
	$stt->bindValue(':url',$url);
	$stt->bindValue(':chara',$chara);
	$stt->bindValue(':time',$time);
	$stt->bindValue(':post_id',$post_id);
	$stt->execute();
} catch(PDOException $e) {
	die('エラーメッセージ：'.$e->getMessage());
}
