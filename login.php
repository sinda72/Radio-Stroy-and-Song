<!-- login.php : login 기능 구현 -->

<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
	<title>☆★ 로그인 ★☆</title>
</head>

<body>
<header class="header">
<div class="container"><nav><ul>
	<h1 align='center'>☆★서진 & 다영 DB 프로젝트 : 라디오★☆</h1>
</ul></nav>
  </div> 
</header>

	<div align='center'>
	<h2>로그인</h2>
	<!-- login 실제 작동하는 php 코드 실행 -->
	<form method='get' action='login_action.php'>
	<p>ID: <input name="m_id" type="text"></p>
	<p>PW: <input name="m_pw" type="password"></p>
	<input type="submit" value="로그인"><br/>		
	</form></div>

 <footer class="footer">
<div>
<p><strong>DB Final Project</strong><br>
&copy IT 1716536 류서진 & 1713437 신다영<br></p></div>
</footer>
</body>
</html>