<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<html>
<head>
<title>쇼핑몰 관리자 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?php
	include "../common.php";
	$text1 = $_REQUEST["text1"];
	$page = $_REQUEST["page"];
	$no = $_REQUEST["no"];
	$sel1 = $_REQUEST["sel1"];
?>
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>
<?php
	if (!$text1) $query = "SELECT * FROM member";
	else {
		if ($sel1 == 1) $query = "SELECT * FROM member WHERE name24 LIKE '%{$text1}%';";
		else $query = "SELECT * FROM member WHERE uid24 LIKE '%{$text1}%';";
	}
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	$count = mysqli_num_rows($result);  //쿼리 결과를 이용하여 전체 레코드 수를 저장
?>
<table width="800" border="0">
	<form name="form1" method="post" action="member.php">
	<tr height="40">
		<td width="200" valign="bottom">&nbsp 회원수 : <font color="#FF0000"><?= $count ?></font></td>
		<td width="540" align="right" valign="bottom">
			<?php
				echo("<select name='sel1'>");        //  콤보박스 html 대신 작성.
				for ($i = 1; $i < $n_idname; $i++)
				{
				   if ($sel1 == $i)
					   echo("<option value='$i' selected>$a_idname[$i]</option>");
				   else
					   echo("<option value='$i'>$a_idname[$i]</option>");
				}
				echo("</select>");
			?>
			<input type="text" name="text1" size="15" value="<?= $text1 ?>" class="font9">&nbsp
		</td>
		<td width="60" valign="bottom">
			<input type="button" value="검색" onclick="javascript:form1.submit();">&nbsp
		</td>
	</tr>
	</form>
</table>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="23"> 
		<td width="100" align="center">ID</td>
		<td width="100" align="center">이름</td>
		<td width="100" align="center">전화</td>
		<td width="100" align="center">핸드폰</td>
		<td width="200" align="center">E-Mail</td>
		<td width="100" align="center">회원구분</td>
		<td width="100" align="center">수정/삭제</td>
	</tr>

<?php
		if (!$page) $page = 1;  //초기 페이지는 페이지1로
		$pages = ceil($count / $page_line);  //총 페이지 수
		
		$first = 1;
		if ($count > 0) $first = $page_line * ($page - 1);  //해당 페이지에서 몇 번째 행부터 표시할건지 저장
		
		$page_last = $count - $first;  //남은 페이지 수를 계산
		if ($page_last > $page_line) $page_last = $page_line;  //현재 블록 내의 페이시 수보다 남은 페이지 수가 더 많으면 남은 페이지 수를 한 블록 당 최대 페이지 수로 변경
		
		if ($count > 0) mysqli_data_seek($result, $first);  //몇 번째 레코드부터 표시할건지 설정
		
		for ($i = 0; $i < $page_last; $i++)
		{
			$row = mysqli_fetch_array($result);
			
			if ($row['gubun24'] == 0) $gubun = "회원";
			else $gubun = "탈퇴";
			
			$tel1 = trim(substr($row['tel24'], 0, 3));
			$tel2 = trim(substr($row['tel24'], 3, 4));
			$tel3 = trim(substr($row['tel24'], 7, 4));
			$tel = $tel1 . "-" . $tel2 . "-" . $tel3;
			
			$phone1 = trim(substr($row['phone24'], 0, 3));
			$phone2 = trim(substr($row['phone24'], 3, 4));
			$phone3 = trim(substr($row['phone24'], 7, 4));
			$phone = $phone1 . "-" . $phone2 . "-" . $phone3;
			
			$no = $row['no24'];
			
			echo
			("
				<tr bgcolor='#F2F2F2' height='23'>	
					<td width='100'>&nbsp {$row['uid24']}</td>	
					<td width='100'>&nbsp {$row['name24']}</td>	
					<td width='100'>&nbsp {$tel}</td>	
					<td width='100'>&nbsp {$phone}</td>	
					<td width='200'>&nbsp {$row['email24']}</td>	
					<td width='100' align='center'>{$gubun}</td>	
					<td width='100' align='center'>
						<a href='member_edit.php?no=$no'>수정</a>/
						<a href='member_delete.php?no=$no' onclick='javascript:return confirm(\"삭제할까요?\");'>삭제</a>
					</td>
				</tr>
			");
		}
	?>
</table>

<?php
	$blocks = ceil($pages / $page_block);  //총 블록 수
	$block = ceil($page / $page_block);  //현재 위치해 있는 블록
	$page_s = $page_block * ($block - 1);  //현재 블록 내 시작 페이지 - 1를 나타내는 변수
	$page_e = $page_block * $block;  //현재 블록 내 마지막 페이지 나타내는 변수
	if ($blocks <= $block) $page_e = $pages;
	
	echo("<table width='650' border='0'>
			<tr>
				<td height='20' align='center'>");
			
	if ($block > 1)  //현재 블록이 두 번째 블록 이상일 때
	{
		$tmp = $page_s;
		echo("<a href='member.php?no=$no&page=$tmp&sel1=$sel1&text1=$text1'>
			<img src='images/i_prev.gif' align='absmiddle' border='0'/>
			</a>&nbsp");
	}
	
	for ($i = $page_s + 1; $i <= $page_e; $i++) //현재 블록 내의 페이지 목록을 출력
	{
		if ($page == $i) echo("<font color='red'><b>$i</b></font>&nbsp");
		else echo("<a href='member.php?no=$no&page=$i&sel1=$sel1&text1=$text1'>[$i]</a>&nbsp");
	}
	
	if ($block < $blocks)  //현재 블록이 마지막 블록보다 전에 있을 때
	{
		$tmp = $page_e + 1;
		echo("&nbsp<a href='member.php?no=$no&page=$tmp&sel1=$sel1&text1=$text1'><img src='images/i_next.gif' align='absmiddle' border='0'/></a>");
	}
	
	echo("</td>
		</tr>
	</table>");
?>
</center>

</body>
</html>