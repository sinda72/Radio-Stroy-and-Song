<!-- modify_action.php : 실제 수정을 진행하는 코드로 DB갱신 수행 -->

<meta charset = 'utf-8'>

<?php
	// DB연결 및 입력하는 값 변수로 정의
    $connect = mysqli_connect("localhost", "seonda", "itdb2019itdb2019", "seonda") or die ("connect fail");
    $number = $_GET[bno];
	$radio_no = $_GET[rno]; 
    $title = $_GET[b_title];
    $content = $_GET[b_content];
	$song = $_GET[b_mno];
    $date = date('Y-m-d H:i:s');
	
	// 게시물 중 수정한 내용을 지정하여 갱신하는 UPDATE 쿼리
    $query = "update board set rno='$radio_no', b_title='$title', b_content='$content', b_mno='$song' where bno=$number";
    $result = $connect->query($query);
	$URL = "index.php";
    if($result) {
?>
	<script>
		alert("수정되었습니다.");
		location.replace("<?php echo $URL?>");
	</script>
<?php    }
    else {
        echo "fail";
    }
?>
