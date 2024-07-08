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
	$day1_y = $_REQUEST["day1_y"];
	$day1_m = $_REQUEST["day1_m"];
	$day1_d = $_REQUEST["day1_d"];
	$day2_y = $_REQUEST["day2_y"];
	$day2_m = $_REQUEST["day2_m"];
	$day2_d = $_REQUEST["day2_d"];
	
	$sel1 = $_REQUEST["sel1"];
	$sel2 = $_REQUEST["sel2"];
	$text1 = $_REQUEST["text1"];
	$page = $_REQUEST["page"];
	//$no = $_REQUEST["no"];
?>
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script>
	function go_update(no, pos)
	{
		state=form1.state[pos].value;
		location.href="jumun_update.php?no="+no+"&state="+state+"&page="+form1.page.value+
			"&sel1="+form1.sel1.value+"&sel2="+form1.sel2.value+"&text1="+form1.text1.value+
			"&day1_y="+form1.day1_y.value+"&day1_m="+form1.day1_m.value+"&day1_d="+form1.day1_d.value+
			"&day2_y="+form1.day2_y.value+"&day2_m="+form1.day2_m.value+"&day2_d="+form1.day2_d.value;
	}
	
	function select_update(sel)
	{
		sel.style.color = "black";
		if (sel.value == 5) sel.style.color = "blue";
		if (sel.value == 6) sel.style.color = "red";
	}
</script>
</head>

<body style="margin:0">
<?php
	if (!$day1_y) $query = "SELECT * FROM jumun ORDER BY no24 DESC;";
	else {
		$query = "SELECT * FROM jumun WHERE (jumunday24 BETWEEN '$day1_y-$day1_m-$day1_d' AND '$day2_y-$day2_m-$day2_d') ";  // 날짜
		
		if ($sel1 != 0) $query .= " AND state24 = $sel1 ";  // State
		
		if ($sel2 == 1) $query .= " AND no24 LIKE '%$text1%' ";  // 주문번호, 고객명, 상품명
		else if ($sel2 == 2) $query .= "AND o_name24 LIKE '%$text1%' ";
		else if ($sel2 == 3) $query .= "AND product_names24 LIKE '%$text1%' ";
	
		$query .=  "ORDER BY no24 DESC;";
	}
	
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	$count = mysqli_num_rows($result);
?>
<center>

<br>
<script> document.write(menu());</script>

<form name="form1" method="post" action="jumun.php">
<input type="hidden" name="page" value="0">

<table width="800" border="0" cellspacing="0" cellpadding="0">
	<tr height="40">
		<td align="left"  width="70" valign="bottom">&nbsp 주문수 : <font color="#FF0000"><?= $count ?></font></td>
		<td align="right" width="730" valign="bottom">
			기간 : 
			
			<input type="text" name="day1_y" size="4" value="<?php if ($day1_y) echo("$day1_y"); else echo(date("Y") - 1); ?>">
			
			<select name="day1_m">
			<?php
				for ($i = 1; $i <= 12; $i++) {
					if ($day1_m) {
						if ($i == $day1_m) $selected = "selected";
						else $selected = "";
					}
					else if ($i == date("m")) {
						$selected = "selected";
					}
					else $selected = "";
					echo("<option value='$i' $selected>$i</option>");
				}
			?>
			</select>
			
			<select name="day1_d">
			<?php
				for ($i = 1; $i <= 31; $i++) {
					if ($day1_d) {
						if ($i == $day1_d) $selected = "selected";
						else $selected = "";
					}
					else if ($i == date("d")) {
						$selected = "selected";
					}
					else $selected = "";
					echo("<option value='$i' $selected>$i</option>");
				}
			?>
			</select> - 
			
			<input type="text" name="day2_y" size="4" value="<? if ($day2_y) echo("$day2_y"); else echo(date("Y")); ?>">
			
			<select name="day2_m">
			<?php
				for ($i = 1; $i <= 12; $i++) {
					if ($day2_m) {
						if ($i == $day2_m) $selected = "selected";
						else $selected = "";
					}
					else if ($i == date("m")) {
						$selected = "selected";
					}
					else $selected = "";
					echo("<option value='$i' $selected>$i</option>");
				}
			?>
			</select>
			
			<select name="day2_d">
			<?php
				for ($i = 1; $i <= 31; $i++) {
					if ($day2_d) {
						if ($i == $day2_d) $selected = "selected";
						else $selected = "";
					}
					else if ($i == date("d")) {
						$selected = "selected";
					}
					else $selected = "";
					echo("<option value='$i' $selected>$i</option>");
				}
			?>
			</select> &nbsp
			
			<select name="sel1">
			<?php
				for ($i = 0; $i < $n_state; $i++) {
					if ($sel1 == $i) $selected = "selected";
					else $selected = "";
					echo("<option value='$i' $selected>{$a_state[$i]}</option>");
				}
			?>
			</select> &nbsp 
			
			<select name="sel2">
				<option value="1" <?php if ($sel2 == 1) echo("selected");?>>주문번호</option>
				<option value="2" <?php if ($sel2 == 2) echo("selected");?>>고객명</option>
				<option value="3" <?php if ($sel2 == 3) echo("selected");?>>상품명</option>
			</select>
			
			<input type="text" name="text1" size="10" value="<?= $text1 ?>">&nbsp
			<input type="button" value="검색" onclick="javascript:form1.submit();"> &nbsp;
		</td>
	</tr>
	</tr><td height="5" colspan="2"></td></tr>
</table>

<table width="800" border="1" cellpadding="0" style="border-collapse:collapse">

<tr bgcolor='#CCCCCC' height='23'> 
	<td width='70'  align='center'>주문번호</td>
	<td width='70'  align='center'>주문일</td>
	<td width='250' align='center'>상품명</td>
	<td width='50'  align='center'>제품수</td>	
	<td width='70'  align='center'>총금액</td>
	<td width='65'  align='center'>주문자</td>
	<td width='50'  align='center'>결재</td>
	<td width='135' align='center' colspan='2'>주문상태</td>
	<td width='50'  align='center'>삭제</td>
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
		
		echo("
		<tr bgcolor='#F2F2F2' height='23'> 
			<td width='70'  align='center'><a href='jumun_info.php?no={$row['no24']}'>{$row['no24']}</a></td>
			<td width='70'  align='center'>{$row['jumunday24']}</td>
			<td width='250' align='left'>&nbsp;{$row['product_names24']}</td>	
			<td width='40' align='center'>{$row['product_nums24']}</td>	
			<td width='70'  align='right'>". number_format($row['total_cash24']) . "&nbsp</td>	
			<td width='65'  align='center'>{$row['o_name24']}</td>
		");
		
		if ($row['pay_method24'] == 0) echo("<td width='50'  align='center'>카드</td>");
		else if ($row['pay_method24'] == 1) echo("<td width='50'  align='center'>무통장</td>");
		
		$font_color = "black";
		if ($row['state24'] == 5) $font_color = "blue";
		if ($row['state24'] == 6) $font_color = "red";
		
		echo("
			<td width='85' align='center' valign='bottom'>
			<select name='state' style='font-size:9pt; color: $font_color;' onchange='javascript:select_update(this);'>
		");

		for ($j = 1; $j < $n_state; $j++) {
			$font_color = "black";
			if ($j == 5) $font_color = "blue";
			if ($j == 6) $font_color = "red";
			if ($row['state24'] == $j) echo("<option value='$j' style='color: $font_color' selected>$a_state[$j]</option>");
			else echo("<option value='$j' style='color: $font_color'>$a_state[$j]</option>");
		}
		
		echo("
			</select>&nbsp;
			</td>
			<td width='50' align='center'>
				<a href='javascript:go_update(\"{$row['no24']}\",\"$i\");'><img src='images/b_edit1.gif' border='0'></a>
			</td>	
			<td width='50' align='center'>
				<a href='jumun_delete.php?no={$row['no24']}' onclick='javascript:return confirm(\"삭제할까요?\");'><img src='images/b_delete1.gif' border='0'></a>
			</td>
		</tr>
		");
	}

?>
</table>

<input type="hidden" name="state">

<?php
	$blocks = ceil($pages / $page_block);  //총 블록 수
	$block = ceil($page / $page_block);  //현재 위치해 있는 블록
	$page_s = $page_block * ($block - 1);  //현재 블록 내 시작 페이지 - 1를 나타내는 변수
	$page_e = $page_block * $block;  //현재 블록 내 마지막 페이지 나타내는 변수
	if ($blocks <= $block) $page_e = $pages;
	
	echo("<table width='800' border='0'>
			<tr>
				<td height='30' align='center'>");
			
	if ($block > 1)  //현재 블록이 두 번째 블록 이상일 때
	{
		$tmp = $page_s;
		echo("<a href='jumun.php?no=$no&page=$tmp&text1=$text1&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d
			&day2_y=$day2_y&day2_m=$day2_m& day2_d=$day2_d&sel1=$sel1&sel2=$sel2'>
			<img src='images/i_prev.gif' align='absmiddle' border='0'/>
			</a>&nbsp");
	}
	
	for ($i = $page_s + 1; $i <= $page_e; $i++) //현재 블록 내의 페이지 목록을 출력
	{
		if ($page == $i) echo("<font color='red'><b>$i</b></font>&nbsp");
		else echo("<a href='jumun.php?no=$no&page=$i&text1=$text1&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d
			&day2_y=$day2_y&day2_m=$day2_m&day2_d=$day2_d&sel1=$sel1&sel2=$sel2'>[$i]</a>&nbsp");
	}
	
	if ($block < $blocks)  //현재 블록이 마지막 블록보다 전에 있을 때
	{
		$tmp = $page_e + 1;
		echo("&nbsp<a href='jumun.php?no=$no&page=$tmp&text1=$text1&day1_y=$day1_y&day1_m=$day1_m&day1_d=$day1_d
			&day2_y=$day2_y&day2_m=$day2_m& day2_d=$day2_d&sel1=$sel1&sel2=$sel2'><img src='images/i_next.gif' align='absmiddle' border='0'/></a>");
	}
	
	echo("</td>
		</tr>
	</table>");
?>

</form>

</center>

</body>
</html>