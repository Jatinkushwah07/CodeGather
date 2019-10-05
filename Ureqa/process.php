<?php 
require('mail.php');

try {
	
	$conn = new mysqli('localhost', 'root', '', 'epgquery');
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO customer_query1 (name, email, phone, message) VALUES ('".$_REQUEST['name']."', '".$_REQUEST['email']."', ".$_REQUEST['phone'].", '".$_REQUEST['message']."')";
	
	if ($conn->query($sql) === TRUE) {
		if(sendmail($_REQUEST)) {
			die('success');
		} else {
			throw new Exception('Unable to process this request');
		}
	} else {
		throw new Exception($sql . "<br>" . $conn->error);
	}
	$conn->close();
} catch(Exception $e) {
	die($e->getMessage());
}
?>