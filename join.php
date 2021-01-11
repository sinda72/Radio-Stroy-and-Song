<!-- join.php : 회원가입 화면구현 -->

<!DOCTYPE html>
<html>
<head>
        <meta charset='utf-8'>
</head>
<body>

<div align="center">
<!-- 회원가입 기능을 실제로 구현 : DB로 값을 넘겨줌 -->
<p>회원가입</p>
	<form method='get' action='join_action.php'>

		<fieldset>
		<legend>♡ 회원가입을 위한 개인정보를 입력해주세요 ♡</legend>
		<br>이름 : <input type="text" name="m_name"><br>
		<br>아이디 : <input type="text" name="m_id"><br>
		<br>비밀번호 : <input type="text" name="m_pw"><br>
		<br>나이 : <input type="text" name="age"><br>
		<br>성별 : 
		<input type="radio" name="sex" value="male">남성
		<input type="radio" name="sex" value="female">여성 <br>
		<br>이메일 : <input type="email" name="m_email"><br><br>
		<br>핸드폰 번호 : <input type="text" name="m_tel"><br><br>
		</fieldset><br>	

	<input type="submit" value="회원가입">
	</form></div>
<footer class="footer">
<div>
<p><strong>DB Final Project</strong><br>
&copy IT 1716536 류서진 & 1713437 신다영<br>

</p></div>
</footer>
</body>
</html>
