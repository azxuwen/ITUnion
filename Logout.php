<?php
header("Content-Type:text/html; charset=utf8");
session_start();
$_SESSION['USERID'] = null;
$_SESSION['USERNAME'] = null;
session_destroy();
//退出后能保证回到原页面
$l = $_SERVER['QUERY_STRING'];
$link = $_GET['l'].".php?";
$l = explode('&', $l);
for($i = 1; $i < count($l); $i++){
	$link .= $l[$i]."&";
}
header("Location:".$link."");
?>