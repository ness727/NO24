<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<html>
<head>
	<title>주소록 프로그램</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="font.css">
	<?php
		include "common.php";
		$text1 = $_REQUEST["text1"];
		$page = $_REQUEST["page"];
	?>
</head>
<body>

<table width="650" border="0">
	<form name="form1" method="post" action="juso_list.php">
	<tr>
		<td width="400">
			이름 : <input type="text" name="text1" size="10" value="<?= $text1?>">
			<input type="button" value="검색" onClick="javascript:form1.submit();">
		</td>
		<td align="right"><a href="juso_new.html">입력</a>&nbsp</td>
	</tr>
	</form>
</table>

<table width="650" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="lightblue">
		<td width="70" align="center">이름</td>
		<td width="100" align="center">전화</td>
		<td width="50" align="center">음/양</td>
		<td width="80" align="center">생일</td>
		<td width="300" align="center">주소</td>
		<td width="50" align="center">삭제</td>
	</tr>
	<?php
		if (!$text1) $query = "SELECT * FROM juso ORDER BY name24;";
		else $query = "SELECT * FROM juso WHERE name24 LIKE '%$text1%' ORDER BY name24;";
		
		$result = mysqli_query($db, $query);
		if (!$result) exit("에러: $query");
	
		$count = mysqli_num_rows($result);  //쿼리 결과를 이용하여 전체 레코드 수를 저장
		
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
			
			if ($row['sm24'] == 0) $sm = "양력";
			else $sm = "음력";
			
			$tel1 = trim(substr($row['tel24'], 0, 3));
			$tel2 = trim(substr($row['tel24'], 3, 4));
			$tel3 = trim(substr($row['tel24'], 7, 4));
			$tel = $tel1 . "-" . $tel2 . "-" . $tel3;
			
			echo
			("
				<tr bgcolor='lightyellow'>
					<td align='center'><a href='juso_edit.php?no=$row[no24]'>{$row['name24']}</a></td>
					<td align='center'>{$tel}</td>
					<td align='center'>{$sm}</td>
					<td align='center'>{$row['birthday24']}</td>
					<td align='left'>{$row['juso24']}</td>
					<td align='center'>
						<a href='juso_delete.php?no=$row[no24]' onClick='javascript:return confirm(\"삭제할까요?\");'>삭제</a>
					</td>
				</tr>
			");
		}
	?>
</table>

<?
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
		echo("<a href='juso_list.php?page=$tmp&text1=$text1'>
			<img src='images/i_prev.gif' align='absmiddle' border='0'/>
			</a>&nbsp");
	}
	
	for ($i = $page_s + 1; $i <= $page_e; $i++) //현재 블록 내의 페이지 목록을 출력
	{
		if ($page == $i) echo("<font color='red'><b>$i</b></font>&nbsp");
		else echo("<a href='juso_list.php?page=$i&text1=$text1'>[$i]</a>&nbsp");
	}
	
	if ($block < $blocks)  //현재 블록이 마지막 블록보다 전에 있을 때
	{
		$tmp = $page_e + 1;
		echo("&nbsp<a href='juso_list.php?page=$tmp&text1=$text1'><img src='images/i_next.gif' align='absmiddle' border='0'/></a>");
	}
	
	echo("</td>
		</tr>
	</table>");
?>

</body>
</html>
