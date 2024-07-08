<?php include "main_top.php"; ?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	
			<?php
				include "common.php";
				$no = $_REQUEST["no"];
				
				$query = "SELECT * FROM product WHERE no24 = $no;";
				$result = mysqli_query($db, $query);
				if (!$result) exit("에러: $query");
				$row = mysqli_fetch_array($result);
			?>
			<!--  현재 페이지 자바스크립트 -------------------------------------------->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
			<script language = "javascript">

			function SetOpts1Change() 
			{
				$.ajax({
					type : "GET",
					url : "admin/product_new_opt2_update.php",
					data : {opt1_val : $("select[name=opts1]").val()},
					dataType : "text",
					success : function(opt1_res)
					{
						$("select[name=opts2]").html(opt1_res);		
					}
				});
			}
			
			function SearchOpt1() 
			{
				if (form2.opts1.value == -1) 
				{
					alert("앞의 옵션을 먼저 선택하세요.");
					form2.opts1.focus();
					return;
				}
			}

			function Zoomimage(no, image2, name) 
			{
				window.open("zoomimage.php?no=" + no, "", "menubar=no, scrollbars=yes, width=560, height=640, top=30, left=50");
			}

			function check_form2(str) 
			{
				if (!form2.opts1.value) {
						alert("옵션1을 선택하십시요.");
						form2.opts1.focus();
						return;
				}
				if (!form2.opts2.value) {
						alert("옵션2를 선택하십시요.");
						form2.opts2.focus();
						return;
				}
				if (!form2.num.value) {
						alert("수량을 입력하십시요.");
						form2.num.focus();
						return;
				}
				if (str == "D") {
					form2.action = "cart_edit.php";
					form2.kind .value = "order";
					form2.submit();
				}
				else {
					form2.action = "cart_edit.php";
					form2.submit();
				}
			}
			</script>
			
			<div class="content wing_content">
				<table border="0" cellpadding="0" cellspacing="0" width="747">
					<tr style="padding-left: 10px; font-size: 1.3em; font-weight: 700;">
						<td height="10" align="left" style="padding-top: 0px; padding-left: 10px; font-size: 1em;">
							<br>
							상품정보
							<hr color="#4C4556" width="747">
						</td>
					</tr>
					<tr><td height="10"></td></tr>
				</table>

				<!-- form2 시작  -->
				<form name="form2" method="post" action="">
				<input type="hidden" name="no" value="<?= $no ?>">
				<input type="hidden" name="kind" value="insert">

				<table border="0" cellpadding="0" cellspacing="0" width="745">
					<tr>
						<td width="335" align="center" valign="top">
							<!-- 상품이미지 -->
							<table border="0" cellpadding="0" cellspacing="0" width="315" height="315" bgcolor="D4D0C8">
								<tr>
									<td bgcolor="white" align="center">
										<img src="product/<?= $row['image2'] ?>" height="315" border="0" align="absmiddle" ONCLICK="Zoomimage('<?= $no ?>')" STYLE="cursor:hand">
									</td>
								</tr>
							</table>
						</td>
						<td width="410 " align="center" valign="top">
							<!-- 상품명 -->
							<table border="0" cellpadding="0" cellspacing="0" width="370" class="cmfont">
								<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
								<tr>
									<td width="80" height="45" style="padding-left:10px; font-size: 1.2em;">
										<img src="images/i_dot1.gif" width="3" height="3" border="0" align="absmiddle">
										<b>제품명</b>
									</td>
									<td width="1" bgcolor="E8E7EA"></td>
									<td style="padding-left:10px; font-size: 1.2em;">
										<?= $row['name24'] ?><br>
										<?php
											if ($row['icon_new24'] == 1)
												echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'> ");
											if ($row['icon_hit24'] == 1)
												echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'> ");
											if ($row['icon_sale24'] == 1)
												echo("<img src='images/i_sale.gif' align='absmiddle' vspace='1'> ");
										?>
									</td>
								</tr>
								<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
								<!-- 시중가 -->
								<tr>
									<td width="80" height="35" style="padding-left:10px; font-size: 1.2em;">
										<img src="images/i_dot1.gif" width="3" height="3" border="0" align="absmiddle">
										<b>소비자가</b>
									</td>
									<td width="1" bgcolor="E8E7EA"></td>
									<td width="289" style="padding-left:10px; font-size: 1.2em;"><?= number_format($row['price24']) ?> 원</td>
								</tr>
								<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
								<!-- 판매가 -->
								<tr>
									<td width="80" height="35" style="padding-left:10px; font-size: 1.2em;">
										<img src="images/i_dot1.gif" width="3" height="3" border="0" align="absmiddle">
										<b>판매가</b>
									</td>
									<td width="1" bgcolor="E8E7EA"></td>
									<td style="padding-left:10px; font-size: 1.2em;"><b><?php if ($row['icon_sale24'] == 1) echo(number_format(round($row['price24'] * (100 - $row['discount24']) / 100, -3)) . " 원"); 
																								else echo(number_format($row['price24']) . " 원"); echo(" <font color='red'>" . $row['discount24'] . "%</font>"); ?></b></td>
								</tr>
								<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
								<!-- 옵션 -->
								<tr>
									<td width="80" height="35" style="padding-left:10px; font-size: 1.2em;">
										<img src="images/i_dot1.gif" width="3" height="3" border="0" align="absmiddle">
										<b>옵션선택</b>
									</td>
									<td width="1" bgcolor="E8E7EA"></td>
									<td style="padding-left:10px; padding-top: 10px; padding-bottom: 10px; font-size: 1.2em;">
										<?php
											$query_opt1 = "SELECT * FROM opt";
											$result_opt1 = mysqli_query($db, $query_opt1);
											if (!$result_opt1) exit("에러: $query_opt1");
											$count_opt1 = mysqli_num_rows($result_opt1);
											
											//--- 옵션선택1 ---
											echo("
												<select name='opts1' onchange='SetOpts1Change()'>
													<option value='-1'>옵션선택</option>
											");
											for ($i = 0; $i < $count_opt1; $i++) {
												$row_opt1 = mysqli_fetch_array($result_opt1);
												if ($row_opt1['no24'] == $row['opt1']) $selected = "selected"; else $selected = "";
												echo("
													<option value='{$row_opt1['no24']}'" . $selected . ">{$row_opt1['name24']}</option>
												");
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
											<select name='opts2' onclick = 'SearchOpt1()'>
												<option value='-1'>옵션선택</option>
											");
											for ($i = 0; $i < $count_opt2; $i++) {
												$row_opt2 = mysqli_fetch_array($result_opt2);
												if ($row_opt2['no24'] == $row['opt2']) $selected = "selected"; else $selected = "";
												echo("<option value='{$row_opt2['no24']}'" . $selected . ">{$row_opt2['name24']}</option>");
											}
											echo("</select>");
										?>
										<br><div style="font-size:0.5em; padding-top: 7px; font-weight: 700;">기본 제공 옵션과 다른 옵션도 선택 가능합니다.</div>
									</td>
								</tr>
								
								<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
								<!-- 수량 -->
								<tr>
									<td width="80" height="35" style="padding-left:10px; font-size: 1.2em;">
										<img src="images/i_dot1.gif" width="3" height="3" border="0" align="absmiddle">
										<b>수량</b>
									</td>
									<td width="1" bgcolor="E8E7EA"></td>
									<td style="padding-left:10px; font-size: 1.2em;">
										<input type="text" name="num" value="1" size="3" maxlength="5"> 개
									</td>
								</tr>
								<tr><td colspan="3" bgcolor="E8E7EA"></td></tr>
							</table>
							<table border="0" cellpadding="0" cellspacing="0" width="370" class="cmfont">
								<tr>
									<td height="70" align="center">
										<a href="javascript:check_form2('D')"><img src="images/b_order.gif" border="0" align="absmiddle"></a>&nbsp;&nbsp;&nbsp;
										<a href="javascript:check_form2('C')"><img src="images/b_cart.gif"  border="0" align="absmiddle"></a>
									</td>
								</tr>
							</table>
							<table border="0" cellpadding="0" cellspacing="0" width="370" class="cmfont">
								<tr>
									<td height="30" align="center">
										<img src="images/product_text1.gif" border="0" align="absmiddle">
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				</form>
				<!-- form2 끝  -->

				<table border="0" cellpadding="0" cellspacing="0" width="747">
					<tr><td height="22"></td></tr>
				</table>

				<!-- 상세설명 -->
				<table border="0" cellpadding="0" cellspacing="0" width="747">
					<tr><td height="13"></td></tr>
				</table>
				<table border="0" cellpadding="0" cellspacing="0" width="746">
					<tr>
						<td height="30" align="left" style="padding-left: 10px; font-size: 1.3em;">
							<!--<img src="images/product_title.gif" width="746" height="30" border="0">-->
							<br>
							상세설명
							<hr width="747">
						</td>
					</tr>
				</table>
				<table border="0" cellpadding="0" cellspacing="0" width="746" style="font-size:9pt">
					<tr><td height="13"></td></tr>
					<tr>
						<td height="200" valign="top" style="padding-left: 10px; padding-right: 10px; line-height: 14pt; font-weight: 400; font-size: 1.2em; line-height: 30px;">
							<?= $row['content24'] ?>
							<br><br><br>
							<hr width="300px" size="1">
							<br><br>
							<center>
							<?php
								if ($row['image3']) echo("<img src='product/{$row['image3']}' width='746'><br>");
							?>
							</center>
							<br><br>
						</td>
					</tr>
				</table>

				<!-- 교환배송정보 -->
				<table border="0" cellpadding="10" cellspacing="0" width="746" style="border-top: 1px solid #aaaaaa; border-collapse: collapse; font-size: 0.9em">
					<tr style="border-bottom: 1px solid #aaaaaa;">
						<td width="100px" align="center" style="background-color: #eeeeee;">배송 구분</td>
						<td width="646px">2만원 이상 결제 시 무료 배송</td>
					</tr>
					<tr style="border-bottom: 1px solid #aaaaaa;">
						<td align="center" style="background-color: #eeeeee;">반품 안내</td>
						<td>문의하기의 반품 카테고리 선택 후 문의 바랍니다.</td>
					</tr>
				</table>

			</div>

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	

<?php include "main_bottom.php"; ?>