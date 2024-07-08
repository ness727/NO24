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
<?php
	include "../common.php";
	
	$no = $_REQUEST["no"];
	$sel1 = $_REQUEST["sel1"];
	$sel2 = $_REQUEST["sel2"];
	$sel3 = $_REQUEST["sel3"];
	$sel4 = $_REQUEST["sel4"];
	$text1 = $_REQUEST["text1"];
	$page = $_REQUEST["page"];
?>
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
	
	function imageView(strImage)
	{
		this.document.images["big"].src = strImage;
	}
</script>

</head>

<body style="margin:0">

<form name="form1" method="post" action="product_update.php" enctype="multipart/form-data">

<input type="hidden" name="no" value="<?= $no ?>">
<input type="hidden" name="sel1" value="<?= $sel1 ?>">
<input type="hidden" name="sel2" value="<?= $sel2 ?>">
<input type="hidden" name="sel3" value="<?= $sel3 ?>">
<input type="hidden" name="sel4" value="<?= $sel4 ?>">
<input type="hidden" name="text1" value="<?= $text1 ?>">
<input type="hidden" name="page" value="<?= $page ?>">

<center>

<br>
<script> document.write(menu());</script>
<br>
<br>
<?php 
	$query="SELECT * FROM product WHERE no24 = $no";
	
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
		
	$row = mysqli_fetch_array($result);
?>
<table width="800" border="1" cellpadding="2" style="border-collapse:collapse">
	<tr height="23"> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품분류</td>
		<td width="700" bgcolor="#F2F2F2">
			<?php
				echo("<select name='menu'>");
				for($i = 0; $i < $n_menu; $i++)
				{
					if ($i == $row['menu24'])
							echo("<option value='$i' selected>$a_menu[$i]</option>");
					else
							echo("<option value='$i'>$a_menu[$i]</option>");
				}
				echo("</select>&nbsp");
			?>
		</td>
	</tr>
	<tr height="23"> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품코드</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="code" value="<?= $row['code24'] ?>" size="20" maxlength="20">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품명</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="name" value="<?= htmlspecialchars($row['name24']) ?>" size="60" maxlength="60">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">저자</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="coname" value="<?= $row['coname24'] ?>" size="30" maxlength="30">
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">판매가</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="price" value="<?= $row['price24'] ?>" size="12" maxlength="12"> 원
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">옵션</td>
		<td width="700"  bgcolor="#F2F2F2">
			<?php
			$query_opt1 = "SELECT * FROM opt";
			$result_opt1 = mysqli_query($db, $query_opt1);
			if (!$result_opt1) exit("에러: $query_opt1");
			$count_opt1 = mysqli_num_rows($result_opt1);
			
			//--- 옵션선택1 ---
			echo("
				<select name='opt1' onchange='SetOpt1Change()'>
					<option value='-1'>옵션선택</option>
			");
			for ($i = 0; $i < $count_opt1; $i++) {
				$row_opt1 = mysqli_fetch_array($result_opt1);
				if ($row_opt1['no24'] == $row['opt1'])
					echo("<option value='{$row_opt1['no24']}' selected>{$row_opt1['name24']}</option>");
				else
					echo("<option value='{$row_opt1['no24']}'>{$row_opt1['name24']}</option>");
			}
			echo("
				</select> &nbsp; &nbsp;
			");
			//--- 옵션선택2 ---
			$query_opt2 = "SELECT * FROM opts WHERE opt_no24 = {$row['opt1']};";
	
			$result_opt2 = mysqli_query($db, $query_opt2);
			if (!$result_opt2) exit("에러: $query_opt2");
				
			$count_opt2 = mysqli_num_rows($result_opt2);  //쿼리 결과를 이용하여 전체 레코드 수를 저장
			
			echo("
			<select name='opt2' onchange = 'SearchOpt1()'>
				<option value='-1'>옵션선택</option>
			");
			for ($i = 0; $i < $count_opt2; $i++) {
				$row_opt2 = mysqli_fetch_array($result_opt2);
				if ($row_opt2['no24'] == $row['opt2'])
					echo("<option value='{$row_opt2['no24']}' selected>{$row_opt2['name24']}</option>");
				else
					echo("<option value='{$row_opt2['no24']}'>{$row_opt2['name24']}</option>");
			}
			echo("</select>");
		?>
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">제품설명</td>
		<td width="700"  bgcolor="#F2F2F2">
			<textarea name="content" rows="4" cols="70"><?= stripslashes($row['content24']) ?></textarea>
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">상품상태</td>
    <td width="700"  bgcolor="#F2F2F2">
			<input type="radio" name="status" value="1" <?php if($row['status24'] == 1) echo("checked"); ?>> 판매중
			<input type="radio" name="status" value="2" <?php if($row['status24'] == 2) echo("checked"); ?>> 판매중지
			<input type="radio" name="status" value="3" <?php if($row['status24'] == 3) echo("checked"); ?>> 품절
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">아이콘</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="checkbox" name="icon_new" value="1" <?php if($row['icon_new24'] == 1) echo("checked"); ?>> New &nbsp;&nbsp	
			<input type="checkbox" name="icon_hit" value="1" <?php if($row['icon_hit24'] == 1) echo("checked"); ?>> Hit &nbsp;&nbsp	
			<input type="checkbox" name="icon_sale" value="1" <?php if($row['icon_sale24'] == 1) echo("checked"); ?> onchange="SetDiscountZero()"> Sale &nbsp;&nbsp
			할인율 : <input type="text" name="discount" value="<?= $row['discount24'] ?>" size="3" maxlength="3" onclick="SetSaleFirst()"> %
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">등록일</td>
		<td width="700"  bgcolor="#F2F2F2">
			<input type="text" name="regday1" value="<?= trim(substr($row['regday24'], 0, 4)); ?>" size="4" maxlength="4"> 년 &nbsp
			<input type="text" name="regday2" value="<?= trim(substr($row['regday24'], 5, 2)); ?>" size="2" maxlength="2"> 월 &nbsp
			<input type="text" name="regday3" value="<?= trim(substr($row['regday24'], 8, 2)); ?>" size="2" maxlength="2"> 일 &nbsp
		</td>
	</tr>
	<tr> 
		<td width="100" bgcolor="#CCCCCC" align="center">이미지</td>
		<td width="700"  bgcolor="#F2F2F2">

			<table border="0" cellspacing="0" cellpadding="0" align="left">
				<tr>
					<td>
						<table width="390" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td>
									<input type='hidden' name='imagename1' value='<?= $row['image1'] ?>'>
									&nbsp;<input type="checkbox" name="checkno1" value="1"> <b>이미지1</b>: <?= $row['image1'] ?>
									<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="file" name="image1" size="20" value="찾아보기">
								</td>
							</tr> 
							<tr>
								<td>
									<input type='hidden' name='imagename2' value='<?= $row['image2'] ?>'>
									&nbsp;<input type="checkbox" name="checkno2" value="1"> <b>이미지2</b>: <?= $row['image2'] ?>
									<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="file" name="image2" size="20" value="찾아보기">
								</td>
							</tr> 
							<tr>
								<td>
									<input type='hidden' name='imagename3' value='<?= $row['image3'] ?>'>
									&nbsp;<input type="checkbox" name="checkno3" value="1"> <b>이미지3</b>: <?= $row['image3'] ?>
									<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="file" name="image3" size="20" value="찾아보기">
								</td>
							</tr> 
							<tr>
								<td><br>&nbsp;&nbsp;&nbsp;※ 삭제할 그림은 체크를 하세요.</td>
							</tr> 
				  	</table>
						<br><br><br><br><br>
						<table width="390" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td  valign="middle">&nbsp;
									<img src="../product/<? if ($row['image1']) echo("{$row['image1']}"); else echo('nopic');?>" width="50" height="50" border="1" style='cursor:hand' onclick="imageView('../product/<? if ($row['image1']) echo("{$row['image1']}"); else echo('nopic');?>')">&nbsp;
									<img src="../product/<? if ($row['image2']) echo("{$row['image2']}"); else echo('nopic');?>" width="50" height="50" border="1" style='cursor:hand' onclick="imageView('../product/<? if ($row['image2']) echo("{$row['image2']}"); else echo('nopic');?>')">&nbsp;
									<img src="../product/<? if ($row['image3']) echo("{$row['image3']}"); else echo('nopic');?>"  width="50" height="50" border="1" style='cursor:hand' onclick="imageView('../product/<? if ($row['image3']) echo("{$row['image3']}"); else echo('nopic');?>')">&nbsp;
								</td>
							</tr>				 
						</table>
					</td>
					<td>
						<td align="right" width="310"><img name="big" src="../product/<? if ($row['image1']) echo("{$row['image1']}"); else echo('nopic');?>" width="300" height="300" border="1"></td>
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>

<table width="800" border="0" cellspacing="0" cellpadding="5">
	<tr> 
		<td align="center">
			<input type="submit" value="수정하기"> &nbsp;&nbsp
			<input type="button" value="이전화면" onClick="javascript:history.back();">
		</td>
	</tr>
</table>

</form>

</center>

</body>
</html>
