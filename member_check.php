<?php
	include "common.php";
	
	$uid = $_REQUEST["uid"];
	$pwd = $_REQUEST["pwd"];
	
	$query = "SELECT no24, name24 FROM member WHERE uid24 = '{$uid}' AND pwd24 = '{$pwd}';";
	$result = mysqli_query($db, $query);
	if(!$result) exit("에러: $query");
	
	$row = mysqli_fetch_array($result);
	//$no = $row['no24'];
	//$name = $row['name24'];
	
	$count = mysqli_num_rows($result);
	if ($count > 0) {
		setcookie("cookie_no", $row['no24']);
		setcookie("cookie_name", $row['name24']);
		echo("<script>location.href = 'index.html'</script>");
	}
	else {
		echo("<script>location.href = 'member_login.php'</script>");
	}
?>