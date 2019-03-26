<?php
	session_start();

	require_once("./password.php");
	require_once("./dbtools.inc.php");
	
	$Username = $_POST["username"];
	$Password = password_hash($_POST["password"], PASSWORD_DEFAULT);

	
	$link = create_connection();

	$sql = "SELECT * FROM Userdata WHERE Name ='$Username' AND Password ='$Password'";

	$result = execute_sql($link, "id7769686_ordersys", $sql);
	if(mysqli_num_rows($result) == 1){
		
		$row = mysqli_fetch_assoc($result);
		echo $row;

		echo "login success";
		$_SESSION["username"] = $Username;
		// $_SESSION["permission"] = 
	}else{
		echo "login fail";
		echo mysqli_num_rows($result);
	}

	
?>