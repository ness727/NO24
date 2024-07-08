<?php
	include "../common.php";
	
	$no1 = $_REQUEST["no1"];
	
	$query = "DELETE FROM opt WHERE no24 = {$no1};";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	echo("<script>location.href = 'opt.php'</script>");