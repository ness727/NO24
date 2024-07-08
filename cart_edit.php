<?php
	$cart = $_COOKIE["cart"];
	$n_cart = $_COOKIE["n_cart"];
	
	$kind = $_REQUEST["kind"];
	$pos = $_REQUEST["pos"];
	$no = $_REQUEST["no"];
	$num = $_REQUEST["num"];
	$opts1 = $_REQUEST["opts1"];
	$opts2 = $_REQUEST["opts2"];

	if (!$n_cart) $n_cart=0;   // 제품개수 0으로 초기화
	
	switch ($kind) {
		case "insert":      // 장바구니 담기
		
		case "order":      // 바로 구매하기
			$n_cart++;
			$cart[$n_cart] = implode("^", array($no, $num, $opts1, $opts2));
			setcookie("cart[$n_cart]", $cart[$n_cart]);
			setcookie("n_cart", $n_cart);
			break;
			
		case "delete":      // 제품삭제
			$n_cart--;
			setcookie("cart[$pos]", "", 0);
			setcookie("n_cart", $n_cart);
			break;
			
		case "update":     // 수량 수정
			list($no, $num_temp, $opts1, $opts2) = explode("^", $cart[$pos]);
			$cart[$pos] = implode("^", array($no, $num, $opts1, $opts2));
			setcookie("cart[$pos]", $cart[$pos]);
			break;
			
		case "deleteall":    // 장바구니 전체 비우기
			for ($i = 1; $i <= $n_cart; $i++)
			{
				if ($cart[$i]) setcookie("cart[$i]", "", 0);
			}
			setcookie("n_cart", "", 0);
			break;
	}

	if ($kind == "order")
		echo("<script>location.href='order.php'</script>");
	else
		echo("<script>location.href='cart.php'</script>");
