<?php include "main_top.php"; ?>
<?php include "banner.php"; ?>
<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	
<?php
	include "common.php";
	$page = $_REQUEST["page"];
	$menu = $_REQUEST["menu"];
	$sort = $_REQUEST["sort"];
	
	if($sort == "up") $query = "SELECT * FROM product WHERE menu24 = $menu AND status24 = 1 ORDER BY price24 DESC;";
	else if($sort == "down") $query = "SELECT * FROM product WHERE menu24 = $menu AND status24 = 1 ORDER BY price24;";
	else if($sort == "name") $query = "SELECT * FROM product WHERE menu24 = $menu AND status24 = 1 ORDER BY name24;";
	else $query = "SELECT * FROM product WHERE menu24 = $menu AND status24 = 1 ORDER BY no24 DESC;";
	
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	$count = mysqli_num_rows($result);         // 출력할 제품 개수
?>
   <!-- 하위 상품목록 -->

<!-- form2 시작 -->
<div class="product min">
	<form name="form2" method="post" action="product.php">
	<input type="hidden" name="menu" value="<?= $menu ?>">


	<table border="0" cellpadding="0" cellspacing="5" width="959" class="cmfont">
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0" width="950" class="cmfont">
					<tr>
						<td valign="middle">
							<table border="0" cellpadding="0" cellspacing="0" width="950" height="40" class="cmfont">
								<tr>
									<td width="700" style="font-size: 1.8em; padding: 15px;">
										<b><?= $a_menu[$menu] ?>&nbsp&nbsp</b>
									</td>
									<td align="right" width="474" style="padding: 15px;">
										<table width="100%" border="0" cellpadding="0" cellspacing="0">
											<tr>
												<td align="right"><font color="EF3F25"><b><?= $count ?></b></font> 개의 상품&nbsp&nbsp&nbsp</td>
												<td width="100">
													<select name="sort" size="1" class="cmfont" onChange="form2.submit()">
														<option value="new" <?php if ($sort == "new") echo("selected"); ?> >신상품순 정렬</option>
														<option value="up" <?php if ($sort == "up") echo("selected"); ?> >고가격순 정렬</option>
														<option value="down" <?php if ($sort == "down") echo("selected"); ?> >저가격순 정렬</option>
														<option value="name" <?php if ($sort == "name") echo("selected"); ?> >상품명 정렬</option>
													</select>
												</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>


	</form>
	<!-- form2 -->

	<table border="0" cellpadding="0" cellspacing="0">
	<!--- 1 번째 줄 -->
	<?php
		$num_col = 5;   $num_row = 4;                   // column수, row수
		$page_line = $num_col * $num_row;
		$icount = 0;                         // 출력한 제품 개수 카운터
		
		if (!$page) $page = 1;  //초기 페이지는 페이지1로
		$pages = ceil($count / $page_line);  //총 페이지 수
		
		$first = 1;
		if ($count > 0) $first = $page_line * ($page - 1);  //해당 페이지에서 몇 번째 행부터 표시할건지 저장
		
		$page_last = $count - $first;  //남은 페이지 수를 계산
		if ($page_last > $page_line) $page_last = $page_line;  //현재 블록 내의 페이지 수보다 남은 페이지 수가 더 많으면 남은 페이지 수를 한 블록 당 최대 페이지 수로 변경
		
		if ($count > 0) mysqli_data_seek($result, $first);  //몇 번째 레코드부터 표시할건지 설정

		echo("<table border='0' cellpadding='0' cellspacing='0'>");
		
		for ($ir = 0; $ir < $num_row; $ir++)
		{
			echo("<tr>");
			for ($ic = 0;  $ic < $num_col;  $ic++)
			{
				if ($icount < $page_last)
				{
					$row = mysqli_fetch_array($result);
					echo("
					<td width='239' height='205' align='center' valign='top'> 
						<table border='0' cellpadding='0' cellspacing='0' width='100'>
							<tr> 
								<td align='center'> 
									<a href='product_detail.php?no={$row['no24']}'><img src='product/{$row['image1']}' width='150' height='220' border='0'></a>
								</td>
							</tr>
							<tr><td height='5'></td></tr>
							<tr> 
								<td height='20' align='center'>
								<a href='product_detail.php?no={$row['no24']}'><font color='444444'>{$row['name24']}</font></a><br>");
					if ($row['icon_new24'] == 1)
						echo("<img src='images/i_new.gif' align='absmiddle' vspace='1'> ");
					if ($row['icon_hit24'] == 1)
						echo("<img src='images/i_hit.gif' align='absmiddle' vspace='1'> ");
					if ($row['icon_sale24'] == 1)
						echo("
								<img src='images/i_sale.gif' align='absmiddle' vspace='1'> 
								<font color='red'>{$row['discount24']}%</font>
							</tr>
							<tr><td height='20' align='center'><strike>" . number_format($row['price24']) . " 원</strike><br><b>"
							. number_format(round($row['price24'] * (100 - $row['discount24']) / 100, -3))
							. "원</b></td></tr>
						</table>
						<br>
					</td>
						");
					else echo("
							</td>
							</tr>
							<tr><td height='20' align='center'>{$row['price24']} 원</td></tr>
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
	</table>
</div>

	<?php
		$blocks = ceil($pages / $page_block);  //총 블록 수
		$block = ceil($page / $page_block);  //현재 위치해 있는 블록
		$page_s = $page_block * ($block - 1);  //현재 블록 내 시작 페이지 - 1를 나타내는 변수
		$page_e = $page_block * $block;  //현재 블록 내 마지막 페이지 나타내는 변수
		if ($blocks <= $block) $page_e = $pages;
		
		echo("<table class='num' border='0' cellpadding='0' cellspacing='0' width='690'>
				<tr>
					<td height='40' align='center'>");
				
		if ($block > 1)  //현재 블록이 두 번째 블록 이상일 때
		{
			$tmp = $page_s;
			echo("<a href='product.php?menu=1&sort=1&page=$tmp'>
				<img src='images/i_prev.gif' align='absmiddle' border='0'/>
				</a>&nbsp");
		}
		
		for ($i = $page_s + 1; $i <= $page_e; $i++) //현재 블록 내의 페이지 목록을 출력
		{
			if ($page == $i) echo("<font color='red'><b>$i</b></font>&nbsp");
			else echo("<a href='product.php?menu=$menu&sort=$sort&page=$i'>[$i]</a>&nbsp");
		}
		
		if ($block < $blocks)  //현재 블록이 마지막 블록보다 전에 있을 때
		{
			$tmp = $page_e + 1;
			echo("&nbsp<a href='product.php?menu=$menu&sort=$sort&page=$tmp'><img src='images/i_next.gif' align='absmiddle' border='0'/></a>");
		}
		
		echo("</td>
			</tr>
		</table>");
	?>


<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	

<?php include "main_bottom.php"; ?>