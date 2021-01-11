<!-- join_action.php : 회원가입 실제 작동 기능 구현 -->
<meta charset="utf-8">
<?php
	// DB연결
	$connect = mysqli_connect('localhost', 'seonda', 'itdb2019itdb2019', 'seonda') or die("fail");
	
	// PHP 변수 설정 (get으로 받아옴)
	$name = $_GET["m_name"]; 
	$id = $_GET["m_id"];
	$pw = $_GET["m_pw"];
	$age = $_GET["age"];
	$sex = $_GET["sex"]; 
	$email = $_GET["m_email"]; 
	$tel = $_GET["m_tel"];

	// 입력 받은 데이터를 DB에 저장할 때, INSERT 쿼리 입력
	$query = "insert into member (m_name, m_id, m_pw, age, sex, m_email, m_tel)
				values ('$name', '$id', '$pw', '$age', '$sex', '$email', '$tel')";
	$result = $connect->query($query);
		
	// 회원가입이 정상 진행되면 index.html로 이동함
	if($result) {
?>      <script>
		alert('가입 되었습니다.');
		location.replace("index.html");
		</script>

<?php   }
	// 회원가입 오류 발생
	else{
?>       <script> alert("fail"); </script>
<?php   }
        mysqli_close($connect);
?>
 
