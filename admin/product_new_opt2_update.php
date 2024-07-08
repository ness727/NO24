<?php
	include "../common.php";
	$opt1_val = $_REQUEST["opt1_val"];
	
	//--- 옵션선택2 ---
	$query = "SELECT * FROM opts WHERE opt_no24 = {$opt1_val};";
	
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
		
	$count = mysqli_num_rows($result);  //쿼리 결과를 이용하여 전체 레코드 수를 저장
	
	echo("
		<select name='opt2' onchange = 'SearchOpt1()'>
			<option value='-1'>옵션선택</option>
	");
	for ($i=0; $i<$count; $i++) {
		$row = mysqli_fetch_array($result);
		echo("<option value='{$row['no24']}'>{$row['name24']}</option>");
	}
	echo("</select>");