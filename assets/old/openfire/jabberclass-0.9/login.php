<?php

	require_once("class_Jabber.php");
	define("JABBER_SERVER","192.168.1.151");
	// create an instance of the Jabber class
	
	
	$display_debug_info = False;
	$jab = new Jabber($display_debug_info);
	
	if (!$jab->connect(JABBER_SERVER)) {
		die("Could not connect to the Jabber server!\n");
	}
	
	$user_name = "selvaman;'';'";
	$password = "selva@sweet0507;l;l";
	
	$result = $jab->login($user_name, $password);
	print_r($result);

?>