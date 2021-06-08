<?php 
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "piesedb";

$conn_piese = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn_piese){
	die("Nu s-a putut realiza conexiunea: " . mysqli_connect_error());
}