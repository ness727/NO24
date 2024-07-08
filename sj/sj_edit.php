<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<?
	include "common.php";
	$no = $_REQUEST["no"];
?>
<html>
<head>
	<title>성적처리 프로그램</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="font.css">
</head>

<script>
	function cal_jumsu()
	{
		form1.hap.value=Number(form1.kor.value) + Number(form1.eng.value) + Number(form1.mat.value);
		form1.avg.value=(form1.hap.value/3.).toFixed(1);
	}
</script>

<body>

<?
	$query = "SELECT * FROM sj WHERE no24 = {$no};";
	$result = mysqli_query($db, $query);
	if (!$no) echo("no없음");
	if(!$result) exit("에러: $query");
	
	$row = mysqli_fetch_array($result);
	
	$avg = sprintf("%6.1f", $row["avg24"]);
?>

<form name="form1" method="post" action="sj_update.php">
<input type="hidden" name="no" value="<?= $no ?>">

<table width="300" border="1" cellpadding="2" bgcolor="lightyellow" style="border-collapse:collapse">
	<tr>
		<td width="100" align="center" bgcolor="lightblue">이름</td>
		<td width="200">
			<input type="text" name="name" size="20" value="<?=$row['name24']; ?>">
		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="lightblue">국어</td>
		<td>
			<input type="text" name="kor" size="6" value="<?=$row['kor24']; ?>" onChange="javascript:cal_jumsu();">
		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="lightblue">영어</td>
		<td>
			<input type="text" name="eng" size="6" value="<?=$row['eng24']; ?>" onChange="javascript:cal_jumsu();">
		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="lightblue">수학</td>
		<td>
			<input type="text" name="mat" size="6" value="<?=$row['mat24']; ?>" onChange="javascript:cal_jumsu();">
		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="lightblue">총점</td>
		<td>
			<input type="text" name="hap" size="6" value="<?=$row['hap24']; ?>" readonly style="border:0;background-color:#ffffe0">
		</td>
	</tr>
	<tr>
		<td align="center" bgcolor="lightblue">평균</td>
		<td>
			<input type="text" name="avg" size="6" value="<?=$row['avg24']; ?>" readonly style="border:0;background-color:#ffffe0">
		</td>
	</tr>
</table>
<br>
<table width="300" border="0">
	<tr>
		<td align="center"> 
			<input type="submit" value="저장"> &nbsp
			<input type="button" value="이전화면으로" onclick="javascript:history.back();">
		</td>
	</tr>
</table>

</form>

</body>
</html>
