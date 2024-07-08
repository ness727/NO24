<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<html>
<head>
<title>쇼핑몰 관리자 홈페이지</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="include/font.css">
<script language="JavaScript" src="include/common.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script language="JavaScript">
	function SetOpt1Change() 
	{
		$.ajax({
			type : "GET",
			url : "product_new_opt2_update.php",
			data : {opt1_val : $("select[name=opt1]").val()},
			dataType : "text",
			success : function(opt1_res)
			{
				$("select[name=opt2]").html(opt1_res);		
			}
		});
	}
	
	function SearchOpt1() 
	{
		if (form1.opt1.value == -1) 
		{
			alert("앞의 옵션을 먼저 선택하세요.");
			form1.opt1.focus();
			return;
		}
	}
	
	function SetSaleFirst() 
	{
		if (!$("input:checkbox[name=icon_sale]").is(":checked") ) 
		{
			alert("Sale을 먼저 체크하세요.");
			$("input:checkbox[name=icon_sale]").focus();
			return;
		}
	}
	
	function SetDiscountZero() {
		if (!$("input:checkbox[name=icon_sale]").is(":checked"))
		{
			$("input:text[name=discount]").val("0");
			return;
		}
	}
</script>
<?php
	include "../common.php";
?>
</head>

<body style="margin:0">
<?php
//--- 옵션선택1 ---
	$query = "SELECT * FROM opt";
	
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
		
	$count = mysqli_num_rows($result);  //쿼리 결과를 이용하여 전체 레코드 수를 저장
	
	
?>

<form name="form1" method="post" action="product_insert.php" enctype="multipart/form-data">
 
<center>

<br>
<script> document.write(menu());</script>
<br>
<br>

<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr height="23"> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품분류</td>
		<td width="700" bgcolor="#F2F2F2">
			<?php
				echo("<select name='menu'>");
				for($i=0;$i<$n_menu;$i++)
				{
					   echo("<option value='$i'>$a_menu[$i]</option>");
				}
				echo("</select>&nbsp");
			?>
		</td>
	</tr>
	<tr height="23"> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품코드</td>
		<td width="700" bgcolor="#F2F2F2">
			<input type="text" name="code" value="" size="20" maxlength="20">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품명</td>
		<td width="700" bgcolor="#F2F2F2">
			<input type="text" name="name" value="" size="60" maxlength="60">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">저자</td>
		<td width="700" bgcolor="#F2F2F2">
			<input type="text" name="coname" value="" size="30" maxlength="30">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">판매가</td>
		<td width="700" bgcolor="#F2F2F2">
			<input type="text" name="price" value="" size="12" maxlength="12"> 원
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">옵션</td>
    <td width="700" bgcolor="#F2F2F2">
		<?php
			//--- 옵션선택1 ---
			echo("
				<select name='opt1' onchange='SetOpt1Change()'>
					<option value='-1'>옵션선택</option>
			");
			for ($i=0; $i<$count; $i++) {
				$row = mysqli_fetch_array($result);
				echo("
					<option value='{$row['no24']}'>{$row['name24']}</option>
				");
			}
			echo("
				</select> &nbsp; &nbsp;
			");
		?>
		<!--- 옵션선택2 --->
		<select name="opt2" onclick="SearchOpt1()">
			<option value="-1" selected>옵션선택</option>
		</select>
	</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">제품설명</td>
		<td width="700" bgcolor="#F2F2F2">
			<textarea name="content" rows="10" cols="80"></textarea>
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품상태</td>
    <td width="700" bgcolor="#F2F2F2">
			<input type="radio" name="status" value="1" checked> 판매중
			<input type="radio" name="status" value="2"> 판매중지
			<input type="radio" name="status" value="3"> 품절
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">아이콘</td>
		<td width="700" bgcolor="#F2F2F2">
			<input type="checkbox" name="icon_new" value="1"> New &nbsp;&nbsp	
			<input type="checkbox" name="icon_hit" value="1"> Hit &nbsp;&nbsp	
			<input type="checkbox" name="icon_sale" value="1" onchange="SetDiscountZero()"> Sale &nbsp;&nbsp
			할인율 : <input type="text" name="discount" value="0" size="3" maxlength="3" onclick="SetSaleFirst()"> %
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">등록일</td>
		<td width="700" bgcolor="#F2F2F2">
			<input type="text" name="regday1" value="<?= date("Y") ?>" size="4" maxlength="4"> 년 &nbsp
			<input type="text" name="regday2" value="<?= date("m") ?>" size="2" maxlength="2"> 월 &nbsp
			<input type="text" name="regday3" value="<?= date("d") ?>" size="2" maxlength="2"> 일
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">이미지</td>
		<td width="700" bgcolor="#F2F2F2">
			<b>이미지1</b>: <input type="file" name="image1" size="30" value="찾아보기"><br>
			<b>이미지2</b>: <input type="file" name="image2" size="30" value="찾아보기"><br>
			<b>이미지3</b>: <input type="file" name="image3" size="30" value="찾아보기"><br>
		</td>
	</tr>
</table>

<table width="800" border="0" cellspacing="0" cellpadding="7">
	<tr> 
		<td align="center">
			<input type="submit" value="등록하기"> &nbsp;&nbsp
			<input type="button" value="이전화면" onClick="javascript:history.back();">
		</td>
	</tr>
</table>

</form>

</center>

</body>
</html>
