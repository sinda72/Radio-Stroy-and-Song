<!-- login_action.php : 실제 로그인 작동하는 코드 (DB에서 값 받아와서 입력한 값과 비교) -->
<meta charset="utf-8">
<?php
// 로그인시 입력하는 ID 기억
session_start();

// DB실행
$connect = mysqli_connect("localhost", "seonda", "itdb2019itdb2019", "seonda") or die("fail");

// 입력 받은 id와 password
$id=$_GET['m_id'];
$pw=$_GET['m_pw'];

// 아이디가 있는지 검사하는 SELECT 쿼리 
$query = "select * from member where m_id='$id'";
$result = $connect->query($query);

// 아이디가 있다면 비밀번호 검사
if(mysqli_num_rows($result)==1) {
$row=mysqli_fetch_assoc($result);

// 비밀번호가 맞다면 세션 생성
if($row['m_pw']==$pw){
$_SESSION['userid']=$id;

if(isset($_SESSION['userid'])){
?>      <script>alert("로그인 되었습니다.");
				location.replace("index2.html");	</script>
<?php
}
// 입력한 비밀번호가 틀리면, 세션 생성하지 않음
else{
echo "session fail";
}
}
// 아이디 혹은 비밀번호를 잘못 입력한 경우, 오류 메시지 출력하고 이전 페이지로 돌아감
else {
?> <script>	alert("아이디 혹은 비밀번호가 잘못되었습니다.");
			history.back();</script>
<?php
}
}
else{
?>              <script>
alert("아이디 혹은 비밀번호가 잘못되었습니다.");
history.back();
</script>
<?php
}
?>
