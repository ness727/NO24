<?
	include "common.php";
	
	$no = $_REQUEST["no"];
	$name = $_REQUEST["name"];
	$kor = $_REQUEST["kor"];
	$eng = $_REQUEST["eng"];
	$mat = $_REQUEST["mat"];
	$hap = $_REQUEST["hap"];
	$avg = $_REQUEST["avg"];
	
	$query = "UPDATE sj SET name24 = '{$name}', kor24 = {$kor}, eng24 = {$eng}, mat24 = {$mat}, hap24 = {$hap}, avg24 = {$avg} WHERE no24 = {$no};";
	$result = mysqli_query($db, $query);
	
	if (!$result) exit("에러: $query");
	
	echo("<script>location.href = 'sj_list.php'</script>");
?>