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
	$no = $_REQUEST["no"];
	
	$query = "SELECT j.jumunday24, j.state24, o_name24, member_no24, o_tel24, o_phone24, o_email24, o_zip24, o_juso24,
		r_name24, member_no24, r_tel24, r_phone24, r_email24, r_zip24, r_juso24, memo24,
		pay_method24, card_okno24, card_halbu24, bank_kind24, bank_sender24,
		p.name24, js.num24, js.price24, js.cash24, js.discount24, o.name24 as opt1, os.name24 as opt2,
		total_cash24
		FROM jumuns js 
		INNER JOIN jumun j ON js.jumun_no24 = j.no24 
		INNER JOIN product p ON js.product_no24 = p.no24
		LEFT OUTER JOIN opt o ON js.opts_no1 = o.no24
		LEFT OUTER JOIN opts os ON js.opts_no2 = os.no24
		WHERE js.jumun_no24 = '$no';";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	$count = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);
	
	$o_tel = trim(substr($row['o_tel24'], 0, 3)) . "-" . trim(substr($row['o_tel24'], 3, 4)) . "-" . trim(substr($row['o_tel24'], 7, 4));
	$o_phone = trim(substr($row['o_phone24'], 0, 3)) . "-" . trim(substr($row['o_phone24'], 3, 4)) . "-" . trim(substr($row['o_phone24'], 7, 4));
	
	$r_tel = trim(substr($row['r_tel24'], 0, 3)) . "-" . trim(substr($row['r_tel24'], 3, 4)) . "-" . trim(substr($row['r_tel24'], 7, 4));
	$r_phone = trim(substr($row['r_phone24'], 0, 3)) . "-" . trim(substr($row['r_phone24'], 3, 4)) . "-" . trim(substr($row['r_phone24'], 7, 4));
?>
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
</head>

<body style="margin:0">

<center>

<br>
<script> document.write(menu());</script>
<br>
<br>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문번호</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE">&nbsp;<font size="3"><b><?= $no ?> (<font color="blue"><?= $a_state[$row['state24']] ?></font>)</b></font></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문일</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['jumunday24'] ?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['o_name24'] ?> (<?php if($row['member_no24'] == 0) echo("비회원"); else echo("회원"); ?>)</td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $o_tel ?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['o_email24'] ?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $o_phone ?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">주문자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3">(<?= $row['o_zip24'] ?>) <?= $row['o_juso24'] ?></td>
	</tr>
	</tr>
</table>
<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['r_name24'] ?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자전화</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $r_tel ?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자 E-Mail</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $row['r_email24'] ?></td>
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자핸드폰</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE"><?= $r_phone ?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">수신자주소</font></td>
        <td width="300" height="20" bgcolor="#EEEEEE" colspan="3">(<?= $row['r_zip24'] ?>) <?= $row['r_juso24'] ?></td>
	</tr>
	<tr> 
        <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">메모</font></td>
        <td width="300" height="50" bgcolor="#EEEEEE" colspan="3"><?= $row['memo24'] ?></td>
	</tr>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<?php
		if ($row['pay_method24'] == 0) {
			echo("
				<tr> 
					<td width='100' height='20' bgcolor='#CCCCCC' align='center'><font color='#142712'>지불종류</font></td>
					<td width='300' height='20' bgcolor='#EEEEEE'>"); if ($row['pay_method24'] == 0) echo("카드"); else echo("무통장"); echo("</td>
					<td width='100' height='20' bgcolor='#CCCCCC' align='center'><font color='#142712'>카드승인번호 </font></td>
					<td width='300' height='20' bgcolor='#EEEEEE'>{$row['card_okno24']}&nbsp</td>
				</tr>
				<tr> 
					<td width='100' height='20' bgcolor='#CCCCCC' align='center'><font color='#142712'>카드 할부</font></td>
					<td width='300' height='20' bgcolor='#EEEEEE'>"); if ($row['card_halbu24'] == 0) echo("일시불"); else echo("{$row['card_halbu24']}개월"); echo("</td>
					<td width='100' height='20' bgcolor='#CCCCCC' align='center'><font color='#142712'>카드종류</font></td>
					<td width='300' height='20' bgcolor='#EEEEEE'>개인</td>
				</tr>
			");
		}
		else if ($row['pay_method24'] == 1) {
			echo("
				<tr> 
					<td width='100' height='20' bgcolor='#CCCCCC' align='center'><font color='#142712'>무통장</font></td>
					<td width='300' height='20' bgcolor='#EEEEEE'>"); if ($row['bank_kind24'] == 1) echo("국민"); else echo("신한"); echo("은행:123-12-12345</td>
					<td width='100' height='20' bgcolor='#CCCCCC' align='center'><font color='#142712'>입금자이름</font></td>
					<td width='300' height='20' bgcolor='#EEEEEE'>{$row['bank_sender24']}</td>
				</tr>
			");
		}
	?>
</table>
<br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr bgcolor="#CCCCCC"> 
    <td width="340" height="20" align="center"><font color="#142712">상품명</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">수량</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">단가</font></td>
		<td width="70"  height="20" align="center"><font color="#142712">금액</font></td>
		<td width="50"  height="20" align="center"><font color="#142712">할인</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션1</font></td>
		<td width="60"  height="20" align="center"><font color="#142712">옵션2</font></td>
	</tr>
	<tr bgcolor="#EEEEEE" height="20">	
		<td width="340" height="20" align="left"><?= $row['name24'] ?></td>	
		<td width="50"  height="20" align="center"><?= $row['num24'] ?></td>	
		<td width="70"  height="20" align="right"><?= $row['price24'] ?></td>	
		<td width="70"  height="20" align="right"><?= $row['cash24'] ?></td>	
		<td width="50"  height="20" align="center"><?= $row['discount24'] ?>%</td>	
		<td width="60"  height="20" align="center"><?= $row['opt1'] ?></td>	
		<td width="60"  height="20" align="center"><?= $row['opt2'] ?></td>	
	</tr>
	<?php
		for ($i = 0; $i < $count - 1; $i++) {
			$row = mysqli_fetch_array($result);
			echo("
				<tr bgcolor='#EEEEEE' height='20'>	
					<td width='340' height='20' align='left'>{$row['name24']}</td>	
					<td width='50'  height='20' align='center'>{$row['num24']}</td>	
					<td width='70'  height='20' align='right'>{$row['price24']}</td>	
					<td width='70'  height='20' align='right'>{$row['cash24']}</td>	
					<td width='50'  height='20' align='center'>{$row['discount24']}%</td>	
					<td width='60'  height='20' align='center'>{$row['opt1']}</td>	
					<td width='60'  height='20' align='center'>{$row['opt2']}</td>	
				</tr>
			");
		}
		
		$query2 = "SELECT * FROM jumuns WHERE product_no24 = 0 AND jumun_no24 = '$no';";  //배송비 처리
		$result2 = mysqli_query($db, $query2);
		if (!$result2) exit("에러: $query2");
		$count2 = mysqli_num_rows($result2);

		if ($count2 == 1) echo("
			<tr bgcolor='#EEEEEE' height='20'>	
				<td width='340' height='20' align='left'>배송비</td>	
				<td width='50'  height='20' align='center'></td>	
				<td width='70'  height='20' align='right'></td>	
				<td width='70'  height='20' align='right'>$baesongbi</td>	
				<td width='50'  height='20' align='center'></td>	
				<td width='60'  height='20' align='center'></td>	
				<td width='60'  height='20' align='center'></td>	
			</tr>
		");
	?>
</table>
<img src="blank.gif" width="10" height="5"><br>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr> 
	  <td width="100" height="20" bgcolor="#CCCCCC" align="center"><font color="#142712">총금액</font></td>
		<td width="700" height="20" bgcolor="#EEEEEE" align="right"><font color="#142712" size="3"><b><?= number_format($row['total_cash24']) ?></b></font> 원&nbsp;&nbsp</td>
	</tr>
</table>

<table width="800" border="0" cellspacing="0" cellpadding="7">
	<tr> 
		<td align="center">
			<input type="button" value="이 전 화 면" onClick="javascript:history.back();">&nbsp
			<input type="button" value="프린트" onClick="javascript:print();">
		</td>
	</tr>
</table>

</center>

<br>
</body>
</html>
