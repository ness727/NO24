<?php
	include "main_top.php"; 
	include "common.php";
?>

<!-------------------------------------------------------------------------------------------->	
<!-- 시작 : 다른 웹페이지 삽입할 부분                                                       -->
<!-------------------------------------------------------------------------------------------->	

			<!--  현재 페이지 자바스크립  -------------------------------------------->
			<script language="javascript">
				function FindZip(zip_kind) 
				{
					window.open("zipcode.php?zip_kind="+zip_kind, "", "scrollbars=no,width=500,height=250");
				}
				function Check_Value() {
					if (form2.pwd1.value != form2.pwd2.value) {
						alert("암호가 일치하지 않습니다.");	
						form2.pwd1.focus();	return;
					}
					if (!form2.name.value) {
						alert("이름이 잘못되었습니다.");	form2.name.focus();	return;
					}
					if (!form2.birthday1.value || !form2.birthday2.value || !form2.birthday3.value) {
						alert("생일이 잘못되었습니다.");	form2.birthday1.focus();	return;
					}
					if (!form2.tel1.value || !form2.tel2.value || !form2.tel3.value) {
						alert("전화번호가 잘못되었습니다.");	form2.tel1.focus();	return;
					}
					if (!form2.phone1.value || !form2.phone2.value || !form2.phone3.value) {
						alert("핸드폰 번호가 잘못되었습니다.");	form2.phone1.focus();	return;
					}
					if (!form2.zip.value) {
						alert("우편번호가 잘못되었습니다.");	form2.zip.focus();	return;
					}
					if (!form2.juso.value) {
						alert("주소가 잘못되었습니다.");	form2.juso.focus();	return;
					}
					if (!form2.email.value) {
						alert("이메일이 잘못되었습니다.");	form2.email.focus();	return;
					}

					form2.submit();
					alert("정보가 수정되었습니다.");	
				}
			</script>
			<div class="min content wing_content">
				<!---- 화면 우측(로그인) S -------------------------------------------------->	
				<table border="0" cellpadding="0" cellspacing="0" width="747">
					<tr><td height="13"></td></tr>
					<tr>
						<td height="30" align="center">
							<p><img src="images/login_title.gif" width="747" height="30" border="0"></p>
						</td>
					</tr>
					<tr><td height="13"></td></tr>
				</table>

				<table border="0" cellpadding="0" cellspacing="0" width="685" class="cmfont">
					<tr>
						<td><img src="images/member_edit.gif" border="0"></td>
					</tr>
					<tr><td height="10"></td></tr>
				</table>

				<table border="0" cellpadding="5" cellspacing="1" width="685" bgcolor="cccccc">

					<!-- form2 시작 -->
					<form name="form2" method="post" action="member_update.php">
					<tr>
						<td align="center" bgcolor="efefef">
							<table border="0" cellpadding="0" cellspacing="5" width="100%" bgcolor="white">
								<tr>
									<td align="center">
										<table border="0" cellpadding="0" cellspacing="0" width="635" class="cmfont">
										<?php
											$cookie_no = $_COOKIE["cookie_no"];
											
											$query = "SELECT * FROM member WHERE no24 = {$cookie_no};";
											$result = mysqli_query($db, $query);
											if(!$result) exit("에러: $query");
											
											$row = mysqli_fetch_array($result);
											
											$pwd = $row['pwd24'];
											$name = $row['name24'];
											$birthday1 = trim(substr($row['birthday24'], 0, 4));
											$birthday2 = trim(substr($row['birthday24'], 5, 2));
											$birthday3 = trim(substr($row['birthday24'], 8, 2));
											$sm = $row['sm24'];
											$tel1 = trim(substr($row['tel24'], 0, 3));
											$tel2 = trim(substr($row['tel24'], 3, 4));
											$tel3 = trim(substr($row['tel24'], 7, 4));
											$phone1 = trim(substr($row['phone24'], 0, 3));
											$phone2 = trim(substr($row['phone24'], 3, 4));
											$phone3 = trim(substr($row['phone24'], 7, 4));
											$zip = $row['zip24'];
											$juso = $row['juso24'];
											$email = $row['email24'];
											
											echo("
												<tr>
													<td width='127' height='30'>
														<img align='absmiddle' src='images/i_dot.gif' border='0'><font color='898989'><b>아이디</b></font>
													</td>
													<td>나의아이디</td>
												</tr>
												<tr>
													<td width='127' height='30'>
														<img align='absmiddle' src='images/i_dot.gif' border='0'><font color='898989'><b>비밀번호</b></font>
													</td>
													<td>{$pwd}</td>
												</tr>
												<tr>
													<td width='127' height='30'>
														<img align='absmiddle' src='images/i_dot.gif' border='0'><font color='898989'><b>새비밀번호</b></font>
													</td>
													<td>
														<input type='password' name='pwd1' maxlength='10' size='20' class='cmfont1'> &nbsp; 비밀번호 변경시에만 입력하세요.
													</td>
												</tr>
												<tr>
													<td width='127' height='30'>
														<img align='absmiddle' src='images/i_dot.gif' border='0'><font color='898989'><b>새비밀번호 확인</b></font>
													</td>
													<td>
														<input type='password' name='pwd2' maxlength='10' size='20' class='cmfont1'>
													</td>
												</tr>
												<tr><td colspan='2' height='10'></td></tr>
												<tr><td colspan='2' bgcolor='E6DDD5'></td></tr>
												<tr><td colspan='2' height='10'></td></tr>
											</table>
											<table border='0' cellpadding='0' cellspacing='0' width='635' class='cmfont'>
												<tr>
													<td width='127' height='30'>
														<img align='absmiddle' src='images/i_dot.gif' border='0'><font color='898989'><b>이 름</b></font>
													</td>
													<td>
														<input type='text' name='name' maxlength='10' value='{$row['name24']}' size='20' class='cmfont1'>
													</td>
												</tr>
												<tr>
													<td width='127' height='30'>
														<img align='absmiddle' src='images/i_dot.gif' border='0'><font color='898989'><b>생년월일</b></font>
													</td>
													<td>
														<input type='text' name='birthday1' size='4' maxlength='4' value='{$birthday1}' class='cmfont1'><font color='898989'>년</font> 
														<input type='text' name='birthday2' size='2' maxlength='2' value='{$birthday2}' class='cmfont1'><font color='898989'>월</font> 
														<input type='text' name='birthday3' size='2' maxlength='2' value='{$birthday3}' class='cmfont1'><font color='898989'>일</font>
													");
													if ($sm = 0)
														echo("
															<input type='radio' name='sm' value='0' checked><font color='898989'>양력</font> 
															<input type='radio' name='sm' value='1' ><font color='898989'>음력</font></td>
														");
													else
														echo("
															<input type='radio' name='sm' value='0' ><font color='898989'>양력</font> 
															<input type='radio' name='sm' value='1' checked><font color='898989'>음력</font></td>
														");
													echo("
												</tr>
												<tr><td colspan='2' height='10'></td></tr>
												<tr><td colspan='2' bgcolor='E6DDD5'></td></tr>
												<tr><td colspan='2' height='10'></td></tr>
											</table>
											<table border='0' cellpadding='0' cellspacing='0' width='635' class='cmfont'>
												<tr>
													<td width='127' height='30'>
														<img align='absmiddle' src='images/i_dot.gif' border='0'><font color='898989'><b>전화 번호</b></font>
													</td>
													<td>
														<input type='text' name='tel1' size='3' maxlength='3' value='{$tel1}'   class='cmfont1'><font color='898989'>-</font>
														<input type='text' name='tel2' size='4' maxlength='4' value='{$tel2}' class='cmfont1'><font color='898989'>-</font>
														<input type='text' name='tel3' size='4' maxlength='4' value='{$tel3}' class='cmfont1'>
													</td>
												</tr>
												<tr>
													<td width='127' height='30'>
														<img align='absmiddle' src='images/i_dot.gif' border='0'><font color='898989'><b>핸드폰 번호</b></font>
													</td>
													<td>
														<input type='text' name='phone1' size='3' maxlength='3' value='{$phone1}'  class='cmfont1'><font color='898989'>-</font>
														<input type='text' name='phone2' size='4' maxlength='4' value='{$phone2}' class='cmfont1'><font color='898989'>-</font>
														<input type='text' name='phone3' size='4' maxlength='4' value='{$phone3}' class='cmfont1'>
													</td>
												</tr>
												<tr>
													<td width='127' height='50'>
														<img align='absmiddle' src='images/i_dot.gif' border='0'><font color='898989'><b>주 소</b></font>
													</td>
													<td>
														<input type='text' name='zip' size = '5' maxlength = '5' value = '{$zip}' class='cmfont1'>
														<a href='javascript:FindZip(0)'><img align='absmiddle' src='images/b_zip.gif' border='0'></a><br>
														<input type='text' name='juso' size = '50' maxlength = '200' value = '{$juso}' class='cmfont1'><br>
													</td>
												</tr>
												<tr>
													<td width='127' height='50'>
														<img align='absmiddle' src='images/i_dot.gif' border='0'><font color='898989'><b>E-Mail</b></font>
													</td>
													<td>
														<input type='text' name='email' size='50' maxlength='50' value='{$email}' class='cmfont1'>
													</td>
												</tr>
												<tr><td colspan='2' height='10'></td></tr>
												<tr><td colspan='2' bgcolor='E6DDD5'></td></tr>
												<tr><td colspan='2' height='10'></td></tr>
												");
											?>
										</table>
				
									</td>
								</tr>
							</table>
						</td>
					</tr>
					</form>
					<!-- form2 끝 -->
				</table>
				
				<div width="685" height="45" align="right" style="display: block; margin-top: 30px; margin-right: 135px;">
					<a href="javascript:Check_Value();"><img src="images/b_edit.gif" border="0"></a> &nbsp;&nbsp
							<a href="javascript:form2.reset();"><img src="images/b_reset.gif" border="0"></a>
				</div>
			</div>
<!-------------------------------------------------------------------------------------------->	
<!-- 끝 : 다른 웹페이지 삽입할 부분                                                         -->
<!-------------------------------------------------------------------------------------------->	

<?php include "main_bottom.php"; ?>