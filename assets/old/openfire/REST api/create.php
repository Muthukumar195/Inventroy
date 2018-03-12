
<?php
	//include "vendor/autoload.php";

	// Create the Openfire Rest api object
	require_once("/root/openfire/REST api/Gidkom/OpenFireRestApi/OpenFireRestApi.php");
	 $api = new OpenFireRestApi();
	
	// Set the required config parameters
	// $api->secret = "8AfG5V0z5tzTdTmT";
	$api->host = "192.168.1.151";
	$api->port = "9090";  // default 9090

	// Optional parameters (showing default values)

	$api->useSSL = false;
	$api->plugin = "/plugins/restapi/v1";  // plugin 

	// Add a new user to OpenFire and add to a group
	$result = $api->addUser('Username', 'Password', 'Real Name', 'johndoe@domain.com', array('Group 1'));

	// Check result if command is succesful
	if($result['status']) {
		// Display result, and check if it's an error or correct response
		echo 'Success: ';
		echo $result['message'];
	} else {
		// Something went wrong, probably connection issues
		echo 'Error: ';
		echo $result['message'];
	}
?>