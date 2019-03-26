<?php

require_once("./password.php");



$Username = $_POST["name"];
$Password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$Phone = $_POST["phone"];
$Permission = $_POST["permission"];

require_once("./dbtools.inc.php");
$link = create_connection();

$sql = "INSERT INTO Userdata (Name, Phone, Password, Permission) Values('$Username', '$Phone', '$Password', '$Permission')";

if(execute_sql($link, "id7769686_ordersys", $sql)){
	echo "reg sucess";
}else{
	echo "reg fail";
}

?>