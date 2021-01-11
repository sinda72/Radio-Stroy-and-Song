<!-- write_action.php : 작성버튼을 누르면, DB에 값이 넘어감-->

<!DOCTYPE html>

<html>
<head>
        <meta charset = 'utf-8'>
</head>
<body>
<?php
		$connect = mysqli_connect("localhost", "seonda", "itdb2019itdb2019", "seonda") or die("fail");
		
		$board_no = $_GET[bno];                        //사연 고유번호
		$radio_no = $_GET[rno];                        //라디오 고유번호
		session_start();
		$id=$_SESSION['userid'];
							 //Writer
		$title = $_GET[b_title];                  //Title
		$content = $_GET[b_content];              //Content
		$date = date('Y-m-d H:i:s');            //Date
		$song = $_GET[b_mno];              //신청곡
		$URL = 'index.php';                   //return URL
		
		// board 테이블에 입력한 게시글의 내용이 INSERT 되는 쿼리
		$query = "insert into board (bno, rno, b_id, b_title, b_content, b_date, b_mno) 
				values($board_no, '$radio_no', '$id', '$title', '$content', '$date', '$song')";

		$result = $connect->query($query);
		if($result){
?>                  <script>
                        alert("<?php echo "글이 등록되었습니다."?>");
                        location.replace("<?php echo $URL?>");
                    </script>
<?php
                }
                else{
                        echo "FAIL";
                }
 
                mysqli_close($connect);
?>
 </body>