<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?php
		include "common.php";
		$no = $_REQUEST["no"];
?>
<html>
<head>
	<title>주소록 프로그램</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="font.css">
	
</head>

<body>

<?php
	$query = "SELECT * FROM juso WHERE no24 = {$no};";
	$result = mysqli_query($db, $query);
	if (!$no) echo("no없음");
	if(!$result) exit("에러: $query");
	
	$row = mysqli_fetch_array($result);
?>

<form name="form1" method="post" action="juso_update.php">
<input type="hidden" name="no" value="<?= $no ?>">

<table width="500" border="1" cellpadding="2" bgcolor="lightyellow" style="border-collapse:collapse">
	<tr>
		<td width="100" align="center" bgcolor="lightblue">이름</td>
		<td width="400">
			<input type="text" name="name" size="10" value="<?= $row['name24'] ?>">
		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="lightblue">전화</td>
		<td>
			<input type="text" name="tel1" size="3" maxlength="3" value="<?= trim(substr($row['tel24'], 0, 3)) ?>"> -
			<input type="text" name="tel2" size="4" maxlength="4" value="<?= trim(substr($row['tel24'], 3, 4)) ?>"> -
			<input type="text" name="tel3" size="4" maxlength="4" value="<?= trim(substr($row['tel24'], 7, 4)) ?>">
		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="lightblue">생일</td>
		<td>
			<input type="text" name="birthday1" size="4" maxlength="4" value="<?= substr($row['birthday24'], 0, 4) ?>"> -
			<input type="text" name="birthday2" size="2" maxlength="2" value="<?= substr($row['birthday24'], 5, 2) ?>"> -
			<input type="text" name="birthday3" size="2" maxlength="2" value="<?= substr($row['birthday24'], 8, 2) ?>"> 
			&nbsp;&nbsp 
			<?php
				if ($row['sm24'] == 0)
					echo("<input type='radio' name='sm' value='0' checked>양력
						<input type='radio' name='sm' value='1'>음력");
				else
					echo("<input type='radio' name='sm' value='0'>양력
						<input type='radio' name='sm' value='1' checked>음력");
			?>
		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="lightblue">주소</td>
		<td>
			<input type="text" name="juso" size="40" value="<?= $row['juso24'] ?>">
		</td>
	</tr>
</table>
<br>
<table width="500" border="0">
	<tr>
		<td align="center"> 
			<input type="submit" value="수정"> &nbsp
			<input type="button" value="이전화면으로" onclick="javascript:history.back();">
		</td>
	</tr>
</table>

</form>

</body>
</html>