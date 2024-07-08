<?php
	include "../common.php";
	$name = $_REQUEST["name"];
	
	$query = "INSERT INTO opt (name24) VALUES ('{$name}')";
	
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	echo("<script>location.href='opt.php'</script>");