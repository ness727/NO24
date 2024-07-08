<!-------------------------------------------------------------------------------------------->	
<!-- 프로그램 : 쇼핑몰 따라하기 실습지시서 (실습용 HTML)                                    -->
<!--                                                                                        -->
<!-- 만 든 이 : 윤형태 (2008.2 - 2017.12)                                                    -->
<!-------------------------------------------------------------------------------------------->	
<html>
<head>
<title>인덕닷컴 쇼핑몰</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<link href="include/font.css" rel="stylesheet" type="text/css">
<script language="Javascript" src="include/common.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {  //메인화면 배너 오토스크롤
		var banner = $("#banner").find("ul");
		
		var bannerWidth = banner.children().outerWidth();
		var bannerHeight = banner.children().outerHeight();
		var length = banner.children().length;
		
		var rollingInterval = setInterval(function() {rollBanner();}, 5000);
		
		function rollBanner() {
			banner.css({
				width: bannerWidth * length + "px",
				height: bannerHeight + "px"
			});
			banner.animate({left: - bannerWidth + "px"}, 1500, function() {
				$(this).append("<li>" + $(this).find("li:first").html() + "</li>");
				$(this).find("li:first").remove();
				$(this).css("left", 0);
			});
		}
	});

	$(window).on("scroll", function(){  //좌측 카테고리 스크롤시 이동
		const content = document.querySelector(".wing_content");
	  if(0 >= content.getBoundingClientRect().top){
		$(".wing").addClass('fixed');
	  }
	  else{
		$(".wing").removeClass('fixed');
	  }
	})
</script>

<style>
	@font-face {
		font-family:'SpoqaHanSansNeo';
		src:url('fonts/SpoqaHanSansNeo-Bold.ttf') format('ttf');
		font-weight:700;
	}
	
	@font-face {
		font-family:'SpoqaHanSansNeo';
		src:url('fonts/SpoqaHanSansNeo-Medium.ttf') format('ttf');
		font-weight:400;
	}
	
	body {
		margin: 0px;
	}
	
	td {
		font-family: 'SpoqaHanSansNeo', sans-serif;
		font-weight:700;
		font-size: 0.9em;
	}
	
	select, select > *{
		font-family: 'SpoqaHanSansNeo', sans-serif;
		font-weight:700;
	}
	
	#banner {
		position: relative;
		width: 959px;
		height: 400px;
		padding: 0px;
		margin: 0px;
		overflow: hidden;
	}
	
	#banner ul{
		position: absolute;
		list-style: none;
		padding: 0px;
		margin: 0px;
	}
	
	#banner ul li {
		float: left;
		padding: 0px;
		margin: 0px;
	}
	
	#banner_border {
		width: 959px;
		border: 1px solid #4C4556;
	}
	
	#container {
		display: inline-block;
		width: 1401px;
	}
	
	#aside_left {
		float: left;
		margin-top: 20px;
		width: 180px;
	}
	
	#article {
		float: right;
		margin-left: 40px;
		margin-right: 40px;
		margin-top: 20px;
		width: 959px;
	}
	
	#aside_right {
		float: right;
		margin-top: 20px;
		width: 180px;
	}
	
	.wing.fixed {
		float: left;
		position: fixed; 
		top: 20px;
	}
	
	.product {
		width: 959px;
		height: 100%;
		border: 1px solid #dddddd;
		background-color: #f9f9f9;
	}
	
	.content {
		text-align: center;
	}
	
	.content > * {
		display: inline-block;
	}
	
	.min {
		min-height: 700px;
	}
	
	a:link { color: #4C4556; }
	
	a:visited { color: #4C4556; }
</style>

</head>

<body>
<center>

<header>
<table width="1230" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr> 
		<td>
			<!--  상단 왼쪽 로고  -------------------------------------------->
			<table border="0" cellspacing="0" cellpadding="0" width="91">
				<tr valign="bottom">
					<td><a href="index.html"><img src="images/top_logo.png" width="91" height="35" border="0" style="margin-left: 40px;"></a></td>
				</tr>
			</table>
		</td>
		
		<td align="right">
			<!--  상단메뉴 Home/로그인/회원가입/장바구니/주문배송조회/즐겨찾기추가  ---->	
			<table border="0" cellspacing="1" cellpadding="0" valign="middle">
				<tr>
					<td valign="bottom"><a href="index.html" style="text-decoration-line: none;">Home</a></td>
					<td><img src="images/top_menu_line.gif" width="11"></td>
					<?php
						$cookie_no = $_COOKIE["cookie_no"];
						if (!$cookie_no) {
							echo("<td><a href='member_login.php' style='text-decoration-line: none;'>로그인</a></td>
								<td><img src='images/top_menu_line.gif' width='11'></td>
								<td><a href='member_agree.php' style='text-decoration-line: none;'>회원가입</a></td>
								<td><img src='images/top_menu_line.gif' width='11'></td>");
						}
						else {
							echo("<td><a href='member_logout.php' style='text-decoration-line: none;'>로그아웃</a></td>
								<td><img src='images/top_menu_line.gif' width='11'></td>
								<td><a href='member_edit.php' style='text-decoration-line: none;'>회원정보수정</a></td>
								<td><img src='images/top_menu_line.gif' width='11'></td>");
						}
					?>
					<td><a href="cart.php" style="text-decoration-line: none;">장바구니</a></td>
					<td><img src="images/top_menu_line.gif" width="11"></td>
					<td><a href="jumun_login.php" style="text-decoration-line: none;">주문조회</a></td>
					<td><img src="images/top_menu_line.gif"width="11"></td>
					<td onclick="javascript:Add_Site();" style="cursor:hand">즐겨찾기추가</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</header>

<!-- 상품 검색 ------------------------------------->
<div width="959" height="40" style="background-color: #4C4556;">
	<table  height="5" border="0" cellspacing="0" cellpadding="0" align="center" style="margin-bottom: 15px;">
		<tr height="40">
			<?php
				$cookie_no = $_COOKIE["cookie_no"];
				$cookie_name = $_COOKIE["cookie_name"];
				
				if (!$cookie_no) 
					echo("<td width='180' align='left'><font color='#eeeeee'>&nbsp <b>Welcome ! &nbsp;&nbsp 고객님.</b></font></td>");
				else
					echo("<td width='180' align='left'><font color='#eeeeee'>&nbsp <b>Welcome ! &nbsp;&nbsp {$cookie_name}님.</b></font></td>");
			?>
			
			<td align="right" width="959" style="color:#eeeeee;"><b></b></td>
			
			<form name="form1" method="post" action="product_search.html">
			<td width="165">
				<input type="text" name="findtext" maxlength="40" size="20" style="height: 20px; border-radius: 5px; border: none;">
			</td>
			</form>
			<td width="15" height="15" align="center" style="padding-left: 10px; padding-right: 5px;"><a href="javascript:Search()"><img src="images/i_search1.png" border="0" height="20" width="20"></a></td>
		</tr>
	</table>
</div>

<section id="container">
<!--  화면 좌측메뉴 시작 (aside_left) ------------------------------->
<aside id="aside_left">
	<table class="wing" width="181" border="0" cellspacing="0" cellpadding="0">
		<tr> 
			<td valign="top"> 
				<!--  Category 메뉴 : 세로인 경우 -------------------------------->
				<table width="177" cellpadding="2" cellspacing="1" style="border: 1px solid #aaaaaa;">
					<tr><td height="30" bgcolor="#FFFFFF" align="center" style="font-size:12pt;color:#333333; border-bottom: 3px solid #4C4556;"><b>카테고리</b></td></tr>
					<tr>
						<td bgcolor="#FFFFFF" border= "0">
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr><td><a href="product.php?menu=1"><img src="images/main_menu01_off.png" width="176" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td></tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF" border= "0">
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr><td><a href="product.php?menu=2"><img src="images/main_menu02_off.png" width="176" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td></tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF">
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr><td><a href="product.php?menu=3"><img src="images/main_menu03_off.png" width="176" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td></tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF">
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr><td><a href="product.php?menu=4"><img src="images/main_menu04_off.png" width="176" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td></tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF">
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr><td><a href="product.php?menu=5"><img src="images/main_menu05_off.png" width="176" height="30" border="0"  onmouseover="img_change('on')" onmouseout="img_change('off')"></a></td></tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr><td height="10"></td></tr>
		<tr> 
			<td> 
				<!--  Custom Service 메뉴(QA, FAQ...) -->
				<table width="177" bgcolor="#FFFFFF" border="0" cellpadding="2" cellspacing="1" style="border: 1px solid #aaaaaa;">
					<tr><td height="25" align="center" style="font-size:11pt; color:#333333; border-bottom: 3px solid #4C4556;"><b>Customer Service</b></td></tr>
					<tr>
						<td bgcolor="#FFFFFF">
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr><td><a href="qa.php"><img src="images/main_left_qa.png" border="0" width="176"></a></td></tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF">
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr><td><a href="faq.php"><img src="images/main_left_faq.png" border="0" width="176"></a></td></tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</aside>
<!--  화면 좌측메뉴 끝 (aside_left) --------------------------------->	

<!--  화면 우측메뉴 시작 (aside_right) ------------------------------->
<aside id="aside_right">
	<table width="80" height="500" align="left">
		<tr>
			<td align="center">AD
			<hr style="width: 40px; color: #4C4556; margin-top: 2px;">
			</td>
		</tr>
		<tr>
			<td style="border-bottom: 1px solid #4C4556;">
			<img src="images/banner_right1.jpg"></td>
		</tr>
		<tr>
			<td style="border-bottom: 1px solid #4C4556;">
			<img src="images/banner_right2.jpg"></td>
		</tr>
		<tr>
			<td><img src="images/banner_right3.jpg"></td>
		</tr>
	</table>
</aside>
<!--  화면 우측메뉴 끝 (aside_right) ------------------------------->

<article id="article">

<table width="959" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td height="100%" valign="top">
			
		</td>
		<td valign="top">

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	