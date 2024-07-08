<?php include "main_top.php"; ?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

		<?php
			include "common.php";
			$cart = $_COOKIE["cart"];
			$n_cart = $_COOKIE["n_cart"];
			
			$o_name = $_REQUEST["o_name"];
			$o_tel1 = $_REQUEST["o_tel1"];
			$o_tel2 = $_REQUEST["o_tel2"];
			$o_tel3 = $_REQUEST["o_tel3"];
			$o_phone1 = $_REQUEST["o_phone1"];
			$o_phone2 = $_REQUEST["o_phone2"];
			$o_phone3 = $_REQUEST["o_phone3"];
			$o_email = $_REQUEST["o_email"];
			$o_zip = $_REQUEST["o_zip"];
			$o_juso = $_REQUEST["o_juso"];
			
			$r_name = $_REQUEST["r_name"];
			$r_tel1 = $_REQUEST["r_tel1"];
			$r_tel2 = $_REQUEST["r_tel2"];
			$r_tel3 = $_REQUEST["r_tel3"];
			$r_phone1 = $_REQUEST["r_phone1"];
			$r_phone2 = $_REQUEST["r_phone2"];
			$r_phone3 = $_REQUEST["r_phone3"];
			$r_email = $_REQUEST["r_email"];
			$r_zip = $_REQUEST["r_zip"];
			$r_juso = $_REQUEST["r_juso"];
			$memo = $_REQUEST["memo"];
		?>
	
			<!--  현재 페이지 자바스크립  -------------------------------------------->
			<script language="javascript">

			function Check_Value() 
			{
				if (form2.pay_method[0].checked)
				{
					if (!form2.card_kind.value) {
						alert("카드종류를 선택하세요.");	form2.card_kind.focus();	return;
					}
					if (!form2.card_no1.value || form2.card_no1.value.length!=4) {
						alert("카드번호를 입력하세요.");	form2.card_no1.focus();	return;
					}
					if (!form2.card_no2.value || form2.card_no2.value.length!=4) {
						alert("카드번호를 입력하세요.");	form2.card_no2.focus();	return;
					}
					if (!form2.card_no3.value || form2.card_no3.value.length!=4) {
						alert("카드번호를 입력하세요.");	form2.card_no3.focus();	return;
					}
					if (!form2.card_no4.value || form2.card_no4.value.length!=4) {
						alert("카드번호를 입력하세요.");	form2.card_no4.focus();	return;
					}
					if (!form2.card_year.value) {
						alert("카드기간 년도를 선택하세요.");	form2.card_year.focus();	return;
					}
					if (!form2.card_month.value) {
						alert("카드기간 월을 선택하세요.");	form2.card_month.focus();	return;
					}
					if (!form2.card_pw.value) {
						alert("카드 암호 뒷의 2자리를 선택하세요.");	form2.card_pw.focus();	return;
					}
				}
				else
				{
					if (!form2.bank_kind.value) {
						alert("입금할 은행을 선택하세요.");	form2.bank_kind.focus();	return;
					}
					if (!form2.bank_sender.value) {
						alert("입금자 이름을 입력하세요.");	form2.bank_sender.focus();	return;
					}
				}
				form2.card_kind.disabled = false;
				form2.card_no1.disabled = false;
				form2.card_no2.disabled = false;
				form2.card_no3.disabled = false;
				form2.card_no4.disabled = false;
				form2.card_year.disabled = false;
				form2.card_month.disabled = false;
				form2.card_pw.disabled = false;
				form2.bank_kind.disabled = false;
				form2.bank_sender.disabled = false;
				
				form2.submit();
			}

			function PaySel(n) 
			{
				if (n == 0) {
					form2.card_kind.disabled = false;
					form2.card_no1.disabled = false;
					form2.card_no2.disabled = false;
					form2.card_no3.disabled = false;
					form2.card_no4.disabled = false;
					form2.card_year.disabled = false;
					form2.card_month.disabled = false;
					form2.card_pw.disabled = false;
					form2.bank_kind.disabled = true;
					form2.bank_sender.disabled = true;
				}
				else {
					form2.card_kind.disabled = true;
					form2.card_no1.disabled = true;
					form2.card_no2.disabled = true;
					form2.card_no3.disabled = true;
					form2.card_no4.disabled = true;
					form2.card_year.disabled = true;
					form2.card_month.disabled = true;
					form2.card_pw.disabled = true;
					form2.bank_kind.disabled = false;
					form2.bank_sender.disabled = false;
				}
			}

			</script>
			
		<div class="content wing_content">
			<div width="747" height="900" style="">
					<div align="left" style="font-size: 1.5em; margin-right: 10px; margin-top: 10px; margin-bottom: 10px;">결제</div>
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
				</tr>
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

			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
			</table>
			<br><br>
			<br><br>

			<!-- form2 시작  -->
			<form name="form2" method="post"action="order_insert.php">

			<input type="hidden" name="o_name"   value="<?= $o_name ?>">
			<input type="hidden" name="o_tel1"    value="<?= $o_tel1 ?>">
			<input type="hidden" name="o_tel2"    value="<?= $o_tel2 ?>">
			<input type="hidden" name="o_tel3"    value="<?= $o_tel3 ?>">
			<input type="hidden" name="o_phone1"  value="<?= $o_phone1 ?>">
			<input type="hidden" name="o_phone2"  value="<?= $o_phone2 ?>">
			<input type="hidden" name="o_phone3"  value="<?= $o_phone3 ?>">
			<input type="hidden" name="o_email"  value="<?= $o_email ?>">
			<input type="hidden" name="o_zip"    value="<?= $o_zip ?>">
			<input type="hidden" name="o_juso"   value="<?= $o_juso ?>">

			<input type="hidden" name="r_name"   value="<?= $r_name ?>">
			<input type="hidden" name="r_tel1"    value="<?= $r_tel1 ?>">
			<input type="hidden" name="r_tel2"    value="<?= $r_tel2 ?>">
			<input type="hidden" name="r_tel3"    value="<?= $r_tel3 ?>">
			<input type="hidden" name="r_phone1"  value="<?= $r_phone1 ?>">
			<input type="hidden" name="r_phone2"  value="<?= $r_phone2 ?>">
			<input type="hidden" name="r_phone3"  value="<?= $r_phone3 ?>">
			<input type="hidden" name="r_email"  value="<?= $r_email ?>">
			<input type="hidden" name="r_zip"    value="<?= $r_zip ?>">
			<input type="hidden" name="r_juso"   value="<?= $r_juso ?>">
			<input type="hidden" name="memo"    value="<?= $memo ?>">
			
			<!-- 결재방법 선택 및 입력 -->
			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" valign="top" width="150" STYLE="padding-left:45;padding-top:5"><font size=2 color="#B90319"><b>결재방법</b></font></td>
					<td align="center" width="560">

						<table width="560" border="0" cellpadding="0" cellspacing="0" style="font-size: 1em;">
							<tr height="25">
								<td width="150"><b>결재방법 선택</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="radio" name="pay_method" value="0" onclick="javascript:PaySel(0);" checked>카드 &nbsp;
									<input type="radio" name="pay_method" value="1" onclick="javascript:PaySel(1);">무통장
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr height="1" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>
			<!-- 카드 -->
			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" valign="top" width="150" STYLE="padding-left:45;padding-top:5"><font size=2 color="#B90319"><b>카드</b></font></td>
					<td align="center" width="560">
						<table width="560" border="0" cellpadding="0" cellspacing="0" style="font-size: 1em;">
							<tr height="25">
								<td width="150"><b>카드종류</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<select name="card_kind">
										<option value="0">카드종류를 선택하세요.</option>
										<option value="1">국민카드</option>
										<option value="2">신한카드</option>
										<option value="3">우리카드</option>
										<option value="4">하나카드</option>
									</select>
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>카드번호</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="card_no1" size="4" maxlength="4" value=""> -
									<input type="text" name="card_no2" size="4" maxlength="4" value=""> -
									<input type="text" name="card_no3" size="4" maxlength="4" value=""> -
									<input type="text" name="card_no4" size="4" maxlength="4" value="">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>카드기간</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="card_month" size="2" maxlength="2" value=""> 월 / 
									<input type="text" name="card_year"  size="2" maxlength="2" value=""> 년
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>카드비밀번호(뒷2자리)</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									**<input type="password" name="card_pw" size="2" maxlength="2" value="">
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>할부</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<select name="card_halbu">
										<option value="0">일시불</option>
										<option value="3">3 개월</option>
										<option value="6">6 개월</option>
										<option value="9">9 개월</option>
										<option value="12">12 개월</option>
									</select>
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr height="1" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>
			<!-- 무통장 -->
			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" valign="top" width="150" style="padding-left:45;padding-top:5"><font size=2 color="#B90319"><b>무통장 입금</b></font></td>
					<td align="center" width="560">
						<table width="560" border="0" cellpadding="0" cellspacing="0" style="font-size: 1em;">
							<tr height="25">
								<td width="150"><b>은행선택</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<select name="bank_kind" disabled>
										<option value="0">입금할 은행을 선택하세요.</option>
										<option value="1">국민은행 000-00000-0000</option>
										<option value="2">신한은행 000-00000-0000</option>
									</select>
								</td>
							</tr>
							<tr height="25">
								<td width="150"><b>입금자 이름</b></td>
								<td width="20"><b>:</b></td>
								<td width="390">
									<input type="text" name="bank_sender" size="15" maxlength="20" value="" disabled>
								</td>
							</tr>
						</table>

					</td>
				</tr>
				<tr height="10"><td></td></tr>
			</table>

			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr height="3" bgcolor="#CCCCCC"><td></td></tr>
				<tr height="10"><td></td></tr>
			</table>

			</form>

			<table width="710" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="center">
						<img src="images/b_order1.gif" onclick="Check_Value()" style="cursor:hand">
					</td>
				</tr>
				<tr height="20"><td></td></tr>
			</table>
		</div>
<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	

<?php include "main_bottom.php"; ?>