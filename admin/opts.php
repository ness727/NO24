<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<html>
<head>
<title>쇼핑몰 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?php
	include "../common.php";
	$no1 = $_REQUEST["no1"];
	$name = $_REQUEST["name"];
	if (!$name) {
		$query = "SELECT * FROM opt WHERE no24 = {$no1};";
		$result = mysqli_query($db, $query);
		if (!$result) exit("에러: $query");
		$row = mysqli_fetch_array($result);
		$name = $row['name24'];
	}
?>
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script>
	function go_new()
	{
		location.href="opts_new.php?no1=<?= $no1 ?>";
	}
</script>
</head>

<body style="margin:0">
<?php
	$query = "SELECT * FROM opts WHERE opt_no24 = {$no1};";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	$count = mysqli_num_rows($result);  //쿼리 결과를 이용하여 전체 레코드 수를 저장
?>
<center>
<br>
<script> document.write(menu());</script>

<table width="500" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td align="left"  width="250" height="50" valign="bottom">&nbsp 옵션명 : <font color="#FF0000"><?= $name ?></font></td>
		<td align="right" width="250" height="50" valign="bottom">
			<input type="button" value="신규입력" onclick="javascript:go_new();"> &nbsp
		</td>
	</tr>
	<tr><td height="5" colspan="2"></td></tr>
</table>

<table width="500" border="1" cellpadding="2"  style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="20"> 
		<td width="50"  align="center"><font color="#142712">번호</font></td>
		<td width="250" align="center"><font color="#142712">옵션명</font></td>
		<td width="100" align="center"><font color="#142712">수정/삭제</font></td>
	</tr>
	<?php
		for ($i = 0; $i < $count; $i++) { 
			$row = mysqli_fetch_array($result);
			echo("
				<tr bgcolor='#F2F2F2' height='20'>	
					<td width='50'  align='center'>{$row['no24']}</td>
				<td width='250' align='left'>{$row['name24']}</td>
					<td width='100' align='center'>
						<a href='opts_edit.php?no1={$row['opt_no24']}&no2={$row['no24']}'>수정</a>/
						<a href='opts_delete.php?no1={$row['opt_no24']}&no2={$row['no24']}' onclick='javascript:return confirm(\"삭제할까요?\");'>삭제</a>
					</td>
				</tr>
			");
		}
	?>
</table>

<br>
</center>

</body>
</html>