<?php include "main_top.php"; ?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	
			
			<?php
				include "common.php";
				$cart = $_COOKIE["cart"];
				$n_cart = $_COOKIE["n_cart"];
			?>
			
			<!--  현재 페이지 자바스크립  -------------------------------------------->
			<script language = "javascript">

			function cart_edit(kind,pos) {
				if (kind=="deleteall") 
				{
					location.href = "cart_edit.php?kind=deleteall";
				} 
				else if (kind=="delete")	{
					location.href = "cart_edit.php?kind=delete&pos="+pos;
				} 
				else if (kind=="insert")	{
					var num=eval("form2.num"+pos).value;
					location.href = "cart_edit.php?kind=insert&pos="+pos+"&num="+num;
				}
				else if (kind=="update")	{
					var num=eval("form2.num"+pos).value;
					location.href = "cart_edit.php?kind=update&pos="+pos+"&num="+num;
				}
			}

			</script>

			<!-- form2 시작  -->
			<div class="content wing_content min">
			<table border="0" cellpadding="0" cellspacing="0" width="746">
				<tr>
					<td height="10" align="left" style="padding-top: 0px; font-size: 1.2em;">
						<br>
						장바구니
						<hr width="747" color="#4C4556">
					</td>
				</tr>
			</table>
			<table border="0" cellpadding="0" cellspacing="0" width="747">
				<tr><td height="13"></td></tr>
			</table>

			<table border="0" cellpadding="0" cellspacing="0" width="710" class="cmfont">
				<tr>
					<!--<td><img src="images/cart_title1.gif" border="0"></td>-->
				</tr>
			</table>

			<table border="0" cellpadding="0" cellspacing="0" width="710">
				<tr><td height="10"></td></tr>
			</table>

			<table border="0" cellpadding="5" cellspacing="1" width="710" bgcolor="#CCCCCC">
				<tr bgcolor="F0F0F0" height="23">
					<td width="420" align="center">상품</td>
					<td width="70"  align="center">수량</td>
					<td width="80"  align="center">가격</td>
					<td width="90"  align="center">합계</td>
					<td width="50"  align="center">삭제</td>
				</tr>

				<form name="form2" method="post">
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
											<td class='cmfont'>
												<a href='product_detail.php?no=$no'>{$row['name24']}</a><br>
												<font color='#0066CC'>{$row1['name24']}</font> {$row2['name24']}
											</td>
										</tr>
									</table>
								</td>
								<td align='center' bgcolor='#FFFFFF'>
									<input type='text' name='num$i' size='3' value='$num' style='font-size: 0.7em;'>&nbsp<font color='#464646'>개</font>
								</td>
								<td align='center' bgcolor='#FFFFFF'><font color='#464646'>" . number_format($price) . "</font></td>
								<td align='center' bgcolor='#FFFFFF'><font color='#464646'>" . number_format($price * $num) . "</font></td>
								<td align='center' bgcolor='#FFFFFF'>
									<a href = 'javascript:cart_edit(\"update\",\"$i\")'><img src='images/b_edit1.gif' border='0'></a>&nbsp<br>
									<a href = 'javascript:cart_edit(\"delete\",\"$i\")'><img src='images/b_delete1.gif' border='0'></a>&nbsp
								</td>
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
			</form>
			<!-- form2 끝  -->
			<table width="710" border="0" cellpadding="0" cellspacing="0" class="cmfont">
				<tr height="44">
					<td width="710" align="center" valign="middle">
						<a href="index.html"><img src="images/b_shopping.gif" border="0"></a>&nbsp;&nbsp;
						<a href="javascript:cart_edit('deleteall',0)"><img src="images/b_cartalldel.gif" width="103" height="26" border="0"></a>&nbsp;&nbsp;
						<a href="order.php"><img src="images/b_order1.gif" border="0"></a>
					</td>
				</tr>
			</table>
			</div>
<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	

<?php include "main_bottom.php"; ?>