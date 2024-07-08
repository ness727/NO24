<?php include "main_top.php"; ?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	
	
	<?php
		include "common.php";
		$cart = $_COOKIE["cart"];
		$n_cart = $_COOKIE["n_cart"];
		$cookie_no = $_COOKIE["cookie_no"];
	?>

			<!--  현재 페이지 자바스크립  -------------------------------------------->
			<script language="javascript">

			function Check_Value() {
				if (!form2.o_name.value) {
					alert("주문자 이름이 잘 못 되었습니다.");	form2.o_name.focus();	return;
				}
				if (!form2.o_tel1.value || !form2.o_tel2.value || !form2.o_tel3.value) {
					alert("전화번호가 잘 못 되었습니다.");	form2.o_tel1.focus();	return;
				}
				if (!form2.o_phone1.value || !form2.o_phone2.value || !form2.o_phone3.value) {
					alert("핸드폰이 잘 못 되었습니다.");	form2.o_phone1.focus();	return;
				}
				if (!form2.o_email.value) {
					alert("이메일이 잘 못 되었습니다.");	form2.o_email.focus();	return;
				}
				if (!form2.o_zip.value) {
					alert("우편번호가 잘 못 되었습니다.");	form2.o_zip.focus();	return;
				}
				if (!form2.o_juso.value) {
					alert("주소가 잘 못 되었습니다.");	form2.o_juso.focus();	return;
				}

				if (!form2.r_name.value) {
					alert("받으실 분의 이름이 잘 못 되었습니다.");	form2.r_name.focus();	return;
				}
				if (!form2.r_tel1.value || !form2.r_tel2.value || !form2.r_tel3.value) {
					alert("전화번호가 잘 못 되었습니다.");	form2.r_tel1.focus();	return;
				}
				if (!form2.r_phone1.value || !form2.r_phone2.value || !form2.r_phone3.value) {
					alert("핸드폰이 잘 못 되었습니다.");	form2.r_phone1.focus();	return;
				}
				if (!form2.r_email.value) {
					alert("이메일이 잘 못 되었습니다.");	form2.r_email.focus();	return;
				}
				if (!form2.r_zip.value) {
					alert("우편번호가 잘 못 되었습니다.");	form2.r_zip.focus();	return;
				}
				if (!form2.r_juso.value) {
					alert("주소가 잘 못 되었습니다.");	form2.r_juso.focus();	return;
				}

				form2.submit();
			}

			function FindZip(zip_kind) 
			{
				window.open("zipcode.php?zip_kind="+zip_kind, "", "scrollbars=no,width=500,height=250");
			}

			function SameCopy(str) {
				if (str == "Y") {
					form2.r_name.value = form2.o_name.value;
					form2.r_zip.value = form2.o_zip.value;
					form2.r_juso.value = form2.o_juso.value;
					form2.r_tel1.value = form2.o_tel1.value;
					form2.r_tel2.value = form2.o_tel2.value;
					form2.r_tel3.value = form2.o_tel3.value;
					form2.r_phone1.value = form2.o_phone1.value;
					form2.r_phone2.value = form2.o_phone2.value;
					form2.r_phone3.value = form2.o_phone3.value;
					form2.r_email.value = form2.o_email.value;
				}
				else {
					form2.r_name.value = "";
					form2.r_zip.value = "";
					form2.r_juso.value = "";
					form2.r_tel1.value = "";
					form2.r_tel2.value = "";
					form2.r_tel3.value = "";
					form2.r_phone1.value = "";
					form2.r_phone2.value = "";
					form2.r_phone3.value = "";
					form2.r_email.value = "";
				}
			}

			</script>
			
		<div class="content wing_content">
			
			<div width="747" height="900" style="">
					<div align="left" style="font-size: 1.5em; margin-right: 10px; margin-top: 10px; margin-bottom: 10px;">주문</div>
					<hr width="747" color="#4C4556" style="margin-bottom: 30px;">
			</div>

			<table border="0" cellpadding="0" cellspacing="0" width="710">
				<tr>
					<td><img src="images/order_title1.gif" width="65" height="15" border="0"></td>
				</tr>
				<tr><td height="10"></td></tr>
			</table>

			<table border="0" cellpadding="5" cellspacing="1" width="710" bgcolor="#CCCCCC">
				<tr bgcolor="F0F0F0" height="23">
					<td width="440" align="center">상품</td>
					<td width="70"  align="center">수량</td>
					<td width="100" align="center">가격</td>
					<td width="100" align="center">합계</td>
				</tr>
				<?php
					$total = 0;
					if (!$n_cart) $n_cart = 0;
					for ($i = 1; $i <= $n_cart; $i++) {
						if ($cart[$i])
					    {
						    list($no, $num, $opts1, $opts2) = explode("^", $cart[$i]);
						    $query = "SELECT * FROM product WHERE no24 = $no;";
						    $result = mysqli_query($db, $query);
						    if (!$result) exit("에러: $query");
						    $row = mysqli_fetch_array($result);
						    
						    $query1 = "SELECT * FROM opt WHERE no24 = $opts1;";
						    $result1 = mysqli_query($db, $query1);
						    if (!$result1) exit("에러: $query1");
						    $row1 = mysqli_fetch_array($result1);
						    
						    $query2 = "SELECT * FROM opts WHERE no24 = $opts2;";
						    $result2 = mysqli_query($db, $query2);
						    if (!$result2) exit("에러: $query2");
						    $row2 = mysqli_fetch_array($result2);
						   
						    if ($row['icon_sale24'] == 1) $price = round($row['price24'] * (100 - $row['discount24']) / 100, -3); 
							else $price = $row['price24'];
						   
						    echo("
							<tr>
								<td height='60' align='center' bgcolor='#FFFFFF'>
									<table cellpadding='0' cellspacing='0' width='100%'>
										<tr>
											<td width='60'>
												<a href='product_detail.php?no=$no'><img src='product/{$row['image1']}' width='60' height='80' border='0' style='margin: 3px; margin-right: 10px;'></a>
											</td>
											<td>
												<a href='product_detail.php?no=$no'>{$row['name24']}</a><br>
												<div style='font-size: 0.8em;'>
													<font color='#0066CC'>{$row1['name24']}</font> {$row2['name24']}
												</div>
											</td>
										</tr>
									</table>
								</td>
								<td align='center' bgcolor='#FFFFFF'>
									<input type='text' name='num$i' size='3' value='$num' style='font-size: 0.7em;'>&nbsp<font color='#464646'>개</font>
								</td>
								<td align='center' bgcolor='#FFFFFF'><font color='#464646'>" . number_format($price) . "</font></td>
								<td align='center' bgcolor='#FFFFFF'><font color='#464646'>" . number_format($price * $num) . "</font></td>
							</tr>
							");
							$total += $price * $num;
						}
					}
				?>
				<tr>
					<td colspan="5" bgcolor="#F0F0F0">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size: 1em;">
							<tr>
								<td bgcolor="#F0F0F0"><img src="images/cart_image1.gif" border="0"></td>
								<td align="right" bgcolor="#F0F0F0">
									<font color="#0066CC"><b>총 합계금액</font></b> : 상품대금(<?= number_format($total) ?>원) 
										+ 배송료(<?php if ($total != 0) { if ($total < $max_baesongbi) { echo($baesongbi); $total = $total + $baesongbi; } else echo("0"); } else echo("0"); ?>원)
										= <font color="#FF3333"><b><?php echo(number_format($total)); ?>원</b></font>&nbsp;&nbsp
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br><br>

			<!-- 주문자 정보 -->
			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
			</table>

			<!-- form2 시작  -->
			
			<?php
				$o_no = "0"; $o_name = ""; $o_tel = "";
				$o_phone = ""; $o_email = "";
				$o_zip = ""; $o_juso = "";
				
				if ($cookie_no) {
					$query = "SELECT * FROM member WHERE no24 = $cookie_no;";
					$result = mysqli_query($db, $query);
					if (!$result) exit("에러: $query");
					$row = mysqli_fetch_array($result);
					
					$o_no = $row['no24']; $o_name = $row['name24']; $o_tel = $row['tel24'];
					$o_phone = $row['phone24']; $o_email = $row['email24'];
					$o_zip = $row['zip24']; $o_juso = $row['juso24'];
					
					$tel1 = trim(substr($o_tel, 0, 3));
					$tel2 = trim(substr($o_tel, 3, 4));
					$tel3 = trim(substr($o_tel, 7, 4));
					
					$phone1 = trim(substr($o_phone, 0, 3));
					$phone2 = trim(substr($o_phone, 3, 4));
					$phone3 = trim(substr($o_phone, 7, 4));
				}
			?>
			
			<form name="form2" method="post" action="order_pay.php">
			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" valign="top" width="150" STYLE="padding-left:45;padding-top:5">
						<font size="2" color="#B90319"><b>주문자 정보</b></font>
					</td>
					<td align="center" width="560">

						<table width="560" border="0" cellpadding="0" cellspacing="0" style="font-size: 0.9em;">
							<tr height="25">
								<td width="150"><b>주문자 성명</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="hidden" name="o_no" value="<?= $o_no ?>">
									<input type="text"   name="o_name" size="20" maxlength="10" value="<?= $o_name ?>">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>전화번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="o_tel1" size="4" maxlength="4" value="<?= $tel1 ?>"> -
									<input type="text" name="o_tel2" size="4" maxlength="4" value="<?= $tel2 ?>"> -
									<input type="text" name="o_tel3" size="4" maxlength="4" value="<?= $tel3 ?>">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>휴대폰번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="o_phone1" size="4" maxlength="4" value="<?= $phone1 ?>"> -
									<input type="text" name="o_phone2" size="4" maxlength="4" value="<?= $phone2 ?>"> -
									<input type="text" name="o_phone3" size="4" maxlength="4" value="<?= $phone3 ?>">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>E-Mail</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="o_email" size="50" maxlength="50" value="<?= $o_email ?>">
								</td>
							</tr>
							<tr height="50">
								<td width="150"><b>주소</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="o_zip" size="5" maxlength="5" value="<?= $o_zip ?>"> 
									<a href="javascript:FindZip(1)"><img src="images/b_zip.gif" align="absmiddle" border="0"></a> <br>
									<input type="text" name="o_juso" size="55" maxlength="200" value="<?= $o_juso ?>"><br>
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr height="10"><td></td></tr>
			</table>

			<!-- 배송지 정보 -->
			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" valign="top" width="150" STYLE="padding-left:45;padding-top:5"><font size=2 color="#B90319"><b>배송지 정보</b></font></td>
					<td align="center" width="560">

						<table width="560" border="0" cellpadding="0" cellspacing="0" style="font-size: 0.9em;">
							<tr height="25">
								<td width="150"><b>주문자정보와 동일</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="radio" name="same" onclick="SameCopy('Y')">예 &nbsp;
									<input type="radio" name="same" onclick="SameCopy('N')">아니오
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>받으실 분 성명</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_name" size="20" maxlength="10" value="">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>전화번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_tel1" size="4" maxlength="4" value=""> -
									<input type="text" name="r_tel2" size="4" maxlength="4" value=""> -
									<input type="text" name="r_tel3" size="4" maxlength="4" value="">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>휴대폰번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_phone1" size="4" maxlength="4" value=""> -
									<input type="text" name="r_phone2" size="4" maxlength="4" value=""> -
									<input type="text" name="r_phone3" size="4" maxlength="4" value="">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>E-Mail</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_email" size="50" maxlength="50" value="">
								</td>
							</tr>
							<tr height="50">
								<td width="150"><b>주소</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="r_zip" size="5" maxlength="5" value=""> 
									<a href="javascript:FindZip(2)"><img src="images/b_zip.gif" align="absmiddle" border="0"></a> <br>
									<input type="text" name="r_juso" size="55" maxlength="200" value=""><br>
								</td>
							</tr>
							<tr height="50">
								<td width="150"><b>배송시요구사항</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<textarea name="memo" cols="60" rows="3"></textarea>
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>

			</form>

			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr>
					<td align="center">
						<img src="images/b_order4.gif" onclick="Check_Value()" style="cursor:hand">

						

					</td>
				</tr>
				<tr height="20"><td></td></tr>
			</table>
			
		</div>
<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	

<?php include "main_bottom.php"; ?>