<?php
	include "../common.php";

	$menu = $_REQUEST["menu"];
	$code = $_REQUEST["code"];
	$name = $_REQUEST["name"];
	$coname = $_REQUEST["coname"];
	$price = $_REQUEST["price"];
	$opt1 = $_REQUEST["opt1"];
	$opt2 = $_REQUEST["opt2"];
	$content = $_REQUEST["content"];
	$status = $_REQUEST["status"];
	$icon_new = $_REQUEST["icon_new"];
	$icon_hit = $_REQUEST["icon_hit"];
	$icon_sale = $_REQUEST["icon_sale"];
	$discount = $_REQUEST["discount"];
	$regday1 = $_REQUEST["regday1"];
	$regday2 = $_REQUEST["regday2"];
	$regday3 = $_REQUEST["regday3"];
	$image1 = $_REQUEST["image1"];
	$image2 = $_REQUEST["image2"];
	$image3 = $_REQUEST["image3"];
	
	$name = addslashes($name);
	$content = addslashes($content);
	
	if (!$icon_new) $icon_new = 0;
	else $icon_new = 1;
	if (!$icon_hit) $icon_hit = 0;
	else $icon_hit = 1;
	if (!$icon_sale) $icon_sale = 0;
	else $icon_sale = 1;
	
	$today = "";
	$today .= $regday1 . "-" . $regday2 . "-" . $regday3;
	//$today .= " " . date("H:i:s");
	
	$fname1="";
	if ($_FILES["image1"]["error"] == 0) 
	{
		$fname1=$_FILES["image1"]["name"];    
		if (!move_uploaded_file($_FILES["image1"]["tmp_name"],
			  "../product/" . $fname1)) exit("업로드 실패");
	}
	
	$fname2="";
	if ($_FILES["image2"]["error"] == 0) 
	{
		$fname2=$_FILES["image2"]["name"];    
		if (!move_uploaded_file($_FILES["image2"]["tmp_name"],
			  "../product/" . $fname2)) exit("업로드 실패");
	}
	
	$fname3="";
	if ($_FILES["image3"]["error"] == 0) 
	{
		$fname3=$_FILES["image3"]["name"];    
		if (!move_uploaded_file($_FILES["image3"]["tmp_name"],
			  "../product/" . $fname3)) exit("업로드 실패");
	}

	$query = "INSERT INTO product (menu24, code24, name24, coname24, price24, opt1, opt2, content24,
		status24, regday24, icon_new24, icon_hit24, icon_sale24, discount24, image1, image2, image3)
		VALUES ({$menu}, '{$code}', '{$name}', '{$coname}', {$price}, {$opt1}, {$opt2}, '{$content}',
		{$status}, '{$today}', {$icon_new}, {$icon_hit}, {$icon_sale}, {$discount}, '{$fname1}', '{$fname2}', '{$fname3}');";
	
	$result = mysqli_query($db, $query);
	if (!$result) exit("에러: $query");
	
	echo("<script>location.href='product.php'</script>");