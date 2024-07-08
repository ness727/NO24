<?
	include "common.php";
	
	$name = $_REQUEST["name"];
	$kor = $_REQUEST["kor"];
	$eng = $_REQUEST["eng"];
	$mat = $_REQUEST["mat"];
	$hap = $_REQUEST["hap"];
	$avg = $_REQUEST["avg"];
	
	$query = "INSERT INTO sj (name24, kor24, eng24, mat24, hap24, avg24) 
		VALUES ('$name', $kor, $eng, $mat, $hap, $avg);";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	echo("<script>location.href='sj_list.php'</script>");
?>