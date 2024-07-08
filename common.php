<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	ini_set("display_errors", 1);
	
	mysqli_report(MYSQLI_REPORT_OFF);

	$db = mysqli_connect("localhost", "shop24", "1234", "shop24");
	if (!$db) exit("DB연결에러");
	
	$page_line = 5;  //페이지당 line 수
	$page_block = 5;  //블록당 page 수
	
	$admin_id = "admin";
	$admin_pw = "1234";
	
	$a_idname=array("전체", "이름", "ID");
	$n_idname=count($a_idname);
	
	$a_menu = array("분류선택", "국내도서", "외국도서", "중고도서", "eBook", "문구");
	$n_menu = count($a_menu);
	
	//---- product ----
	$a_status=array("상품상태","판매중","판매중지","품절");
	$n_status=count($a_status);

	$a_icon=array("아이콘","New","Hit","Sale");
	$n_icon=count($a_icon);

	$a_text1=array("","제품이름","제품번호");   // for문의 $i는 1부터 시작
	$n_text1=count($a_text1);

	$baesongbi = 2500;
	$max_baesongbi = 20000;
	
	$a_state = array("전체", "주문신청", "주문확인", "입금확인", "배송중", "주문완료", "주문취소");
	$n_state = count($a_state);