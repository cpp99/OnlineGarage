<?php 
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "userDb";

$conn_users = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn_users){
	die("Nu s-a putut realiza conexiunea: " . mysqli_connect_error());
}