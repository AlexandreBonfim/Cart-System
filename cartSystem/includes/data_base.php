<?php
	try{
		$host='127.0.0.1';
		$dbname = 'b_suppliers';
		$user = 'root';
		$pass = '';
		$DBH = new PDO("mysql:host=$host;dbname=$dbname",$user, $pass);
	}catch(PDOException $e) { echo "Error";}

?>
