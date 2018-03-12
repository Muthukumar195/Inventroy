<?php 

	require_once("class_jabber.php");
	$jabber = new Jabber();
	$result =  $jabber->Connect();
	echo $result;


?>