<?php 
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "anunturidb";

$conn_anunturi = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn_anunturi){
	die("Nu s-a putut realiza conexiunea: " . mysqli_connect_error());
}