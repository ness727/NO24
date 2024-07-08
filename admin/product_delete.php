<?php
	include "../common.php";
	
	$no = $_REQUEST["no"];
	$sel1 = $_REQUEST["sel1"];
	$sel2 = $_REQUEST["sel2"];
	$sel3 = $_REQUEST["sel3"];
	$sel4 = $_REQUEST["sel4"];
	$text1 = $_REQUEST["text1"];
	$page = $_REQUEST["page"];
	
	$query = "DELETE FROM product WHERE no24 = {$no};";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	echo("<script>location.href = 'product.php?sel1={$sel1}&sel2={$sel2}&sel3={$sel3}&sel4={$sel4}&text1={$text1}&page={$page}'</script>");