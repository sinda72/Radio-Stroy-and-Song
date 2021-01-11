<!-- f_insert.php : favorite변수에 전송받은 값을 받는다. 
					정상적으로 삽입되면 구독완료 알림창을 띄워준다. -->
<meta charset="utf-8">
<?php
		// DB연결
        $connect = mysqli_connect('localhost', 'seonda', 'itdb2019itdb2019', 'seonda') or die("fail");
		// PHP 변수 설정
		$favorite = $_GET["favorite"]; 
		$category = $_GET["category"]; 
		
		// 로그인을 진행한 ID와 동일한 경우 (session_start로 해당 ID값 불러옴)
                session_start();
                $id=$_SESSION['userid'];
				
		// 카테고리 값을 favorite 테이블에 튜플을 삽입
		$query = "insert into favorite (f_id, f_rno,f_category)
					values ('$id', '$favorite','$category')";
		$result = $connect->query($query);
		// 삽입 정상 진행
		if($result) {
        ?>      <script>
                alert('구독완료!');
                </script>
 
<?php   }
		// 삽입 오류 발생
        else{
?>              <script>
                        
                        alert("fail");
                </script>
<?php   }
		// 화면에 선택한 favorite 값(구독한 채널) 출력함
		echo "$favorite";
?>