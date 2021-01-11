<!-- delete.php : 게시글 삭제 -->

<meta charset="utf-8">

<?php
	// DB연결
    $connect = mysqli_connect("localhost", "seonda", "itdb2019itdb2019", "seonda") 
	or die ("connect fail");
    
	// PHP 변수 설정
	$number = $_GET[bno];
	
	// DELETE : 해당 게시물 번호와 일치하는 경우 board 테이블에서 찾아 튜플 전체를 삭제하는 쿼리
    $query = "delete from board where bno=$number";
    $result = $connect->query($query);
    
	if($result) {
	// 삭제 성공하면 성공 알림 후, index.php로 이동함
?>
        <script>
            alert("삭제되었습니다.");
            location.replace("index.php");
        </script>
<?php    }
	// 삭제 실패하면 fail 알림
    else {
        echo "fail";
    }
?>
