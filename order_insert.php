<?php
	include "common.php";

	$cart = $_COOKIE["cart"];
	$n_cart = $_COOKIE["n_cart"];
	$cookie_no = $_COOKIE["cookie_no"];
	
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
	
	$pay_method = $_REQUEST["pay_method"];
	
	$card_kind = $_REQUEST["card_kind"];
	$card_halbu = $_REQUEST["card_halbu"];
	
	$bank_kind = $_REQUEST["bank_kind"];
	$bank_sender = $_REQUEST["bank_sender"];
	
	$o_tel = sprintf("%-3s%-4s%-4s", $o_tel1, $o_tel2, $o_tel3);
	$o_phone = sprintf("%-3s%-4s%-4s", $o_phone1, $o_phone2, $o_phone3);
	$r_tel = sprintf("%-3s%-4s%-4s", $r_tel1, $r_tel2, $r_tel3);
	$r_phone = sprintf("%-3s%-4s%-4s", $r_phone1, $r_phone2, $r_phone3);
	
	$query = "SELECT * FROM jumun WHERE jumunday24 = curdate() ORDER BY no24 DESC LIMIT 1;";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	$count = mysqli_num_rows($result);
	
	if ($count > 0) {
		$row = mysqli_fetch_array($result);
		$no = str_pad(substr($row['no24'], 6, 4) + 1, 4, 0, STR_PAD_LEFT);
		$no = date("ymd") . $no;
	}
	else $no = date("ymd") . "0001";
	
	$total_price = 0;
	$product_nums = 0;
	$product_names = "";
	
	for ($i = 0; $i <= $n_cart; $i++) {
		if ($cart[$i]) {
			list($product_no, $num, $opts1, $opts2) = explode("^", $cart[$i]);
			
			$query_product = "SELECT * FROM product WHERE no24 = $product_no;";
			$result_product = mysqli_query($db, $query_product);
			if (!$result_product) exit("에러: $query_product");
			$row_product = mysqli_fetch_array($result_product);
			
			if ($row_product['icon_sale24'] == 1) $price = round($row_product['price24'] * (100 - $row_product['discount24']) / 100, -3); 
			else $price = $row_product['price24'];
			
			$cash = $num * $price;

			$query = "INSERT INTO jumuns(jumun_no24, product_no24, num24, price24, cash24, discount24, opts_no1, opts_no2)
				VALUES('$no', {$row_product['no24']}, $num, $price, $cash, {$row_product['discount24']}, $opts1, $opts2);";
			$result = mysqli_query($db, $query);
			if (!$result) exit("에러: $query");
			
			setcookie("cart[$i]", "", 0);
			
			$total_price = $total_price + $cash;
			$product_nums = $product_nums + 1;
			if ($product_nums == 1) $product_names = $row_product['name24'];
		}
	}
	
	if ($product_nums > 1) {
		$tmp = $product_nums;
		$product_names = $product_names . " 외 " . $tmp - 1;
	}
	
	if ($total_price < $max_baesongbi) {
		$query = "INSERT INTO jumuns(jumun_no24, product_no24, num24, price24, cash24, discount24, opts_no1, opts_no2)
			VALUES('$no', 0, 1, $baesongbi, $baesongbi, 0, 0, 0);";
		$result = mysqli_query($db, $query);
		if (!$result) exit("에러: $query");
		$total_price += $baesongbi;
	}
	
	if ($cookie_no) $member_no = $cookie_no;
	else $member_no = 0;
	
	$today = date("Ymd");
	$card_okno = $no;
	$query = "INSERT INTO jumun(no24, member_no24, jumunday24, product_names24, product_nums24, 
		o_name24, o_tel24, o_phone24, o_email24, o_zip24, o_juso24, 
		r_name24, r_tel24, r_phone24, r_email24, r_zip24, r_juso24, 
		memo24,	pay_method24, card_okno24, card_halbu24, card_kind24, 
		bank_kind24, bank_sender24, total_cash24, state24)
		VALUES('$no', $member_no, '$today', '$product_names', $product_nums, 
		'$o_name', '$o_tel', '$o_phone', '$o_email', '$o_zip', '$o_juso', 
		'$r_name', '$r_tel', '$r_phone', '$r_email', '$r_zip', '$r_juso', 
		'$memo', $pay_method, '$card_okno', $card_halbu, $card_kind, 
		$bank_kind, '$bank_sender', $total_price, 1);";
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	echo("<script>location.href='order_ok.php'</script>");