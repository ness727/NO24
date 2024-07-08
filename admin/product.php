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
	$sel2 = $_REQUEST["sel2"];
	$sel3 = $_REQUEST["sel3"];
	$sel4 = $_REQUEST["sel4"];
?>
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	function go_new()
	{
		location.href="product_new.php";
	}
	
	function go_edit(no, text1, page) 
	{
		location.href = "product_edit.php?no=" + no + "&sel1=" + $('select[name=sel1]').val() 
			+ "&sel2=" + $('select[name=sel2]').val() + "&sel3=" + $('select[name=sel3]').val() + "&sel4=" + $('select[name=sel4]').val() + "&text1=" + text1 + "&page=" + page;
	}
	
	function go_delete(no, text1, page) 
	{
		confirm_delete = confirm("삭제할까요?");
		
		if (confirm_delete)
		location.href = "product_delete.php?no=" + no + "&sel1=" + $('select[name=sel1]').val() 
			+ "&sel2=" + $('select[name=sel2]').val() + "&sel3=" + $('select[name=sel3]').val() + "&sel4=" + $('select[name=sel4]').val() + "&text1=" + text1 + "&page=" + page;
	}
</script>
</head>

<body style="margin:0">
<?php
	if (!$sel1)   $sel1=0;
	if (!$sel2)   $sel2=0;
	if (!$sel3)   $sel3=0;
	if (!$sel4)   $sel4=1;
	if (!$text1) $text1=""; 
		  
	$k=0;
	if ($sel1 != 0)        { $s[$k] = "status24=" . $sel1;  $k++; }
	if ($sel2 == 1)       { $s[$k] = "icon_new24=1";      $k++; }
	elseif ($sel2==2)   { $s[$k] = "icon_hit24=1";         $k++; }
	elseif ($sel2==3)   { $s[$k] = "icon_sale24=1";       $k++; }
	if ($sel3 != 0)        { $s[$k] = "menu24=" . $sel3;   $k++; }
	if ($text1)
	{
		if ($sel4==1)       { $s[$k] = "name24 like '%" . $text1 . "%'"; $k++; }
		elseif ($sel4==2) { $s[$k] = "code24 like '%" . $text1 . "%'"; $k++; }
	}
	
	if ($k> 0)
	{
		$tmp = implode(" and ", $s); 
		$tmp = " where " . $tmp;
	}
	$query="select * from product " . $tmp . " order by name24";
	
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
		
	$count = mysqli_num_rows($result);  //쿼리 결과를 이용하여 전체 레코드 수를 저장
	//if (!$count != 0)
	if (!$page) $page = 1;  //초기 페이지는 페이지1로
	$pages = ceil($count / $page_line);  //총 페이지 수
		
	$first = 1;
	if ($count > 0) $first = $page_line * ($page - 1);  //해당 페이지에서 몇 번째 행부터 표시할건지 저장
		
	$page_last = $count - $first;  //남은 페이지 수를 계산
	if ($page_last > $page_line) $page_last = $page_line;  //현재 블록 내의 페이시 수보다 남은 페이지 수가 더 많으면 남은 페이지 수를 한 블록 당 최대 페이지 수로 변경
		
	if ($count > 0) mysqli_data_seek($result, $first);  //몇 번째 레코드부터 표시할건지 설정
?>

<center>

<br>
<script> document.write(menu());</script>

<table width="800" border="0" cellspacing="0" cellpadding="0">
	<form name="form1" method="post" action="product.php">
	<tr height="40">
		<td align="left"  width="150" valign="bottom">&nbsp 제품수 : <font color="#FF0000"><?= $count ?></font></td>
		<td align="right" width="550" valign="bottom">
			<?php
				echo("<select name='sel1'>");
				for($i=0; $i<$n_status; $i++)
				{
					if ($i==$sel1)
					   echo("<option value='$i' selected>$a_status[$i]</option>");
					else
					   echo("<option value='$i'>$a_status[$i]</option>");
				}
				echo("</select>&nbsp");

				echo("<select name='sel2'>");
				for($i=0;$i<$n_icon;$i++)
				{
					if ($i==$sel2)
					   echo("<option value='$i' selected>$a_icon[$i]</option>");
					else
					   echo("<option value='$i'>$a_icon[$i]</option>");
				}
				echo("</select>&nbsp ");

				echo("<select name='sel3'>");
				for($i=0;$i<$n_menu;$i++)
				{
					if ($i==$sel3)
					   echo("<option value='$i' selected>$a_menu[$i]</option>");
					else
					   echo("<option value='$i'>$a_menu[$i]</option>");
				}
				echo("</select>&nbsp");

				echo("<select name='sel4'>");
				for($i=1;$i<$n_text1;$i++)
				{
					if ($i==$sel4)
					   echo("<option value='$i' selected>$a_text1[$i]</option>");
					else
					   echo("<option value='$i'>$a_text1[$i]</option>");
				}
				echo("</select>");
			?>
			<input type="text" name="text1" size="10" value="">&nbsp
		</td>
		<td align="left" width="120" valign="bottom">
			<input type="button" value="검색" onclick="javascript:form1.submit();"> &nbsp;&nbsp
			<input type="button" value="입력" onclick="javascript:go_new();">
		</td>
	</tr>
	<tr><td height="5"></td></tr>
	</form>
</table>

<table width="900" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC" height="23"> 
		<td width="100" align="center">제품분류</td>
		<td width="100" align="center">제품코드</td>
		<td width="280" align="center">제품명</td>
		<td width="70"  align="center">판매가</td>
		<td width="70"  align="center">상태</td>
		<td width="120" align="center">이벤트</td>
		<td width="80"  align="center">수정/삭제</td>
	</tr>
	<?php
		for ($i = 0; $i < $page_last; $i++)
			{
				$row = mysqli_fetch_array($result);
				//$no = $row['no24'];
				
				if ($row['status24'] == 1) $status = "판매중";
				else if ($row['status24'] == 2) $status = "판매중지";
				else $status = "품절";
				
				if ($row['icon_new24'] == 1) $new = "New";
				else $new = "";
				
				if ($row['icon_hit24'] == 1) $hit = "Hit";
				else $hit = "";
				
				if ($row['icon_sale24'] == 1) {
					$sale = "Sale";
					$discount = "(" . $row['discount24'] . ")";
				}
				else {
					$sale = "";
					$discount = "";
				}
				
				$event = $new . " " . $hit . " " . $sale . $discount;
				
				echo
				("
					<tr bgcolor='#F2F2F2' height='23'>	
						<td width='100'>&nbsp {$row['menu24']}</td>	
						<td width='100'>&nbsp {$row['code24']}</td>	
						<td width='280'>&nbsp {$row['name24']}</td>	
						<td width='70'>&nbsp {$row['price24']}</td>	
						<td width='50'>&nbsp {$status}</td>	
						<td width='120' align='center'>{$event}</td>	
						<td width='80' align='center'>
							<a onclick='go_edit({$row['no24']}, \"$text1\", $page);' style='cursor:hand; color:blue'><u>수정</u></a>/
							<a onclick='go_delete({$row['no24']}, \"$text1\", $page);' style='cursor:hand; color:blue'><u>삭제</u></a>
						</td>
					</tr>
				");
			}
	?>
		</td>
	</tr>
</table>

<?php
	$blocks = ceil($pages / $page_block);  //총 블록 수
	$block = ceil($page / $page_block);  //현재 위치해 있는 블록
	$page_s = $page_block * ($block - 1);  //현재 블록 내 시작 페이지 - 1를 나타내는 변수
	$page_e = $page_block * $block;  //현재 블록 내 마지막 페이지 나타내는 변수
	if ($blocks <= $block) $page_e = $pages;
	
	echo("<table width='800' border='0' cellpadding='0' cellspacing='0'>
			<tr>
				<td height='30' class='cmfont' align='center'>");
			
	if ($block > 1)  //현재 블록이 두 번째 블록 이상일 때
	{
		$tmp = $page_s;
		echo("<a href='product.php?sel1={$sel1}&sel2={$sel2}&sel3={$sel3}&sel4={$sel4}&text1={$text1}&page=$tmp''>
			<img src='images/i_prev.gif' align='absmiddle' border='0'/>
			</a>&nbsp");
	}
	
	for ($i = $page_s + 1; $i <= $page_e; $i++) //현재 블록 내의 페이지 목록을 출력
	{
		if ($page == $i) echo("<font color='red'><b>$i</b></font>&nbsp");
		else echo("<a href='product.php?sel1={$sel1}&sel2={$sel2}&sel3={$sel3}&sel4={$sel4}&text1={$text1}&page=$i'>[$i]</a>&nbsp");
	}
	
	if ($block < $blocks)  //현재 블록이 마지막 블록보다 전에 있을 때
	{
		$tmp = $page_e + 1;
		echo("&nbsp<a href='product.php?sel1={$sel1}&sel2={$sel2}&sel3={$sel3}&sel4={$sel4}&text1={$text1}&page=$tmp'><img src='images/i_next.gif' align='absmiddle' border='0'/></a>");
	}
	
	echo("</td>
		</tr>
	</table>");
?>
</table>

</center>

</body>
</html>