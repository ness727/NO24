<?php
	include "common.php";
	
	$cookie_no = $_COOKIE["cookie_no"];
	$pwd1 = $_REQUEST["pwd1"];
	$name = $_REQUEST["name"];
	$birthday1 = $_REQUEST["birthday1"];
	$birthday2 = $_REQUEST["birthday2"];
	$birthday3 = $_REQUEST["birthday3"];
	$sm = $_REQUEST["sm"];
	$tel1 = $_REQUEST["tel1"];
	$tel2 = $_REQUEST["tel2"];
	$tel3 = $_REQUEST["tel3"];
	$phone1 = $_REQUEST["phone1"];
	$phone2 = $_REQUEST["phone2"];
	$phone3 = $_REQUEST["phone3"];
	$zip = $_REQUEST["zip"];
	$juso = $_REQUEST["juso"];
	$email = $_REQUEST["email"];
	
	$birthday = sprintf("%04d-%02d-%02d", $birthday1, $birthday2, $birthday3);
	$tel = sprintf("%-3s%-4s%-4s", $tel1, $tel2, $tel3);
	$phone = sprintf("%-3s%-4s%-4s", $phone1, $phone2, $phone3);
	
	if (!$pwd1) {
		$query = "UPDATE member SET name24 = '{$name}', birthday24 = '{$birthday}', sm24 = {$sm}, tel24 = '{$tel}', phone24 = '{$phone}', zip24 = '{$zip}', juso24 = '{$juso}', email24 = '{$email}' WHERE no24 = {$cookie_no};";
	}
	else {
		$query = "UPDATE member SET pwd24 = '{$pwd1}', name24 = '{$name}', birthday24 = '{$birthday}', sm24 = {$sm}, tel24 = '{$tel}', phone24 = '{$phone}', zip24 = '{$zip}', juso24 = '{$juso}', email24 = '{$email}' WHERE no24 = {$cookie_no};";
	}
	$result = mysqli_query($db, $query);
	if(!$result) exit("에러: $query");
	echo("<script>location.href = 'member_edit.php'</script>");