<?php
	require_once("dbtools.inc.php");
	$pid = $_POST["pid"];

	$link = create_connection();

	$sql = "SELECT * FROM Products WHERE PID = '$pid'";

	$result = execute_sql($link, "id7769686_ordersys", $sql);
	$row = mysqli_fetch_assoc($result);

	$memberArray = Array();

	if(mysqli_num_rows($result) > 0){
		do{
			$memberArray[] = $row;
		}while($row = mysqli_fetch_assoc($result));

		echo json_encode($memberArray);
	}else {
		echo "查無會員紀錄!";
	}
?>