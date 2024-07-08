<?php
	include "../common.php";
	
	$no = $_REQUEST["no"];
	
	$query = "DELETE FROM jumun WHERE no24 = '$no';";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	$query = "DELETE FROM jumuns WHERE jumun_no24 = '$no';";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	echo("<script>location.href = 'jumun.php'</script>");