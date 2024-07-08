<?
	include "common.php";
	
	$no = $_REQUEST["no"];
	
	$query = "DELETE FROM sj WHERE no24 = {$no};";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	echo("<script>location.href = 'sj_list.php'</script>");
?>