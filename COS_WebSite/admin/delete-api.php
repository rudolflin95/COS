<?php 
	$ID = $_GET["id"];
	
	require_once("dbtools.inc.php");
	$link = create_connection();
	$sql = "DELETE FROM Userdata WHERE ID = $ID";

	if(execute_sql($link, "id7769686_ordersys", $sql)){
		echo '<script>location.href="member.php";</script>'; //刪除成功自動換頁
	}else {
		echo 0; //刪除失敗
	}

 ?>