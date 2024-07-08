<?php
	include "common.php";
	
	$name = $_REQUEST["name"];
	$tel1 = $_REQUEST["tel1"];
	$tel2 = $_REQUEST["tel2"];
	$tel3 = $_REQUEST["tel3"];
	$birthday1 = $_REQUEST["birthday1"];
	$birthday2 = $_REQUEST["birthday2"];
	$birthday3 = $_REQUEST["birthday3"];
	$sm = $_REQUEST["sm"];
	$juso = $_REQUEST["juso"];
	
	$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
	$birthday = sprintf("%04d-%02d-%02d", $birthday1, $birthday2, $birthday3);
	
	$query = "INSERT INTO juso (name24, tel24, birthday24, sm24, juso24) 
		VALUES ('{$name}', '{$tel}', '{$birthday}', {$sm}, '{$juso}');";
		

	
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	echo("<script>location.href='juso_list.php'</script>");