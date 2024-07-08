<?php include "main_top.php"; ?>
<?php include "banner.php"; ?>
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	
			<?php
				include "common.php";
				$query = "SELECT * FROM product WHERE icon_new24 = 1 AND status24 = 1 ORDER BY rand() limit 15;";
				$result = mysqli_query($db, $query);
				if (!$result) exit("에러: $query");
			?>
			<!---- 화면 우측(신상품) 시작 -------------------------------------------------->
			<div class="product">
			<table width="959" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="60" style=" font-size: 1.3em; padding: 20px;">
						&nbsp이달의 신간
					</td>
				</tr>
			</table>

				<!---1번째 줄-->
				<?php
					$num_col = 4;   $num_row = 3;                   // column수, row수
					$count = mysqli_num_rows($result);         // 출력할 제품 개수
					$icount = 0;                                              // 출력한 제품 개수 카운터
					echo("<table border='0' cellpadding='0' cellspacing='0'>");
					for ($ir = 0; $ir < $num_row; $ir++)
					{
						echo("<tr>");
						for ($ic=0;  $ic<$num_col;  $ic++)
						{
							if ($icount < $count)
							{
								$row = mysqli_fetch_array($result);
								echo("
								<td width='150' height='205' align='center' valign='top'> 
									<table border='0' cellpadding='0' cellspacing='0' width='239'>
										<tr> 
											<td align='center'> 
												<a href='product_detail.php?no={$row['no24']}'><img src='product/{$row['image1']}' width='150' height='220' border='0'></a>
											</td>
										</tr>
										<tr><td height='5'></td></tr>
										<tr> 
											<td height='20' align='center'>
											<a href='product_detail.php?no={$row['no24']}'><font color='444444'>{$row['name24']}</font></a>&nbsp<br>
								");
								if ($row['icon_new24'] == 1)
									echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'> ");
								if ($row['icon_hit24'] == 1)
									echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'> ");
								if ($row['icon_sale24'] == 1)
									echo("
											<img src='images/i_sale.gif' align='absmiddle' vspace='1'> 
											<font color='red'>{$row['discount24']}%</font>
											</td>
										</tr>
										<tr>
											<td height='20' align='center'><strike>" . number_format($row['price24']) . " 원</strike><br><b>"
											. number_format(round($row['price24'] * (100 - $row['discount24']) / 100, -3))
											. "원</b>
											</td>
										</tr>
									</table>
									<br>
								</td>
									");
								else echo("
													</td>
												</tr>
												<tr>
													<td height='20' align='center'>{$row['price24']} 원</td>
												</tr>
											</table> 
											<br>
										</td>
									");
							}
							else echo("<td></td>");      // 제품 없는 경우
							$icount++;
						}
						echo("</tr>");
					}
					echo("</table>");
				?>
				<tr><td height="10"></td></tr>
			</table>
			</div>
			<!---- 화면 우측(신상품) 끝 -------------------------------------------------->	

<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	
<?php include "main_bottom.php"; ?>