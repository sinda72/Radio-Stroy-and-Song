<!-- modify : 작성한 게시글 그대로 불러와서 수정  -->

   <meta charset = 'utf-8'>
   
   <?php
   // DB연결
	$connect = mysqli_connect("localhost", "seonda", "itdb2019itdb2019", "seonda" ) or die("connect fail");
	// 입력받은 값들 변수 설정
	//$id = $_GET[b_id];
	$number = $_GET[bno];
	
	// 이미 입력한 내용을 변수로 받아오기 위해 해당 부분을 SELECT하는 쿼리
	$query = "select bno, rno, b_id, b_title, b_content, b_date, b_mno from board where bno =$number";
	$result = $connect->query($query);
	$rows = mysqli_fetch_assoc($result);

	// 작성한 쿼리를 row에 저장해 필요한 정보를 변수로 재정의
	$radio_no = $rows['rno']; 
	$title = $rows['b_title'];
	$content = $rows['b_content'];       //Content
	$song = $rows['b_mno'];              //신청곡
	$usrid = $rows['b_id'];
	session_start();
	$URL = "index.php";

	// 입력한 ID와 동일한 경우
	if(!isset($_SESSION['userid'])) {
	?>  <script>
		alert("1. 권한이 없습니다.");
		location.replace("<?php echo $URL?>");</script>
	<?php   }
		   else{
	?>
	
	<!-- 수정 기능을 DB에서 데이터 갱신을 진행하는 modify_action.php 불러옴-->
	<form method = "get" action = "modify_action.php">
	<table  style="padding-top:50px" align = center width=700 border=0 cellpadding=2 >
		<tr>
		<td height=20 align= center bgcolor=#ccc><font color=white> 글수정</font></td>
		</tr>
		<tr>
		<td bgcolor=white>
		<table class = "table2">
		<tr>
		<td>작성자</td>
		<td><input type="hidden" name="b_id" value="<?=$_SESSION['userid']?>"><?=$_SESSION['userid']?></td>
		</tr>
		<tr>
		<td>사연 번호</td>
		<td><input type = "text" name = "bno" size=40 value="<?=$number?>"> </td>
		</tr>
		<tr>
		<tr>
		<td>라디오 채널</td>
		<td><input type = "text" name = "rno" size=40 value="<?=$radio_no?>"> </td>
		</tr>
		<tr>
		<td>제목</td>
		<td><input type = "text" name = "b_title" size=70 value="<?=$title?>"></td>
		</tr>
		<tr>
		<td>내용</td>
		<td><textarea name = "b_content" cols=85 rows=15><?=$content?></textarea></td>
		</tr>
		<td>작성일</td>
		<td><input type = "hidden" name = "b_date" title size=50></td>
		</tr>
		<tr>
		<td>신청곡</td>
		<td>
		<!--selectbox 코드-->
		<select id='b_mno' name='b_mno'>
		<?php
			$db = new mysqli("localhost", "seonda", "itdb2019itdb2019", "seonda");
			mysqli_set_charset($db, "utf8");

			$q="select mno from music";
			$result = $db->query($q);
			while($row = mysqli_fetch_array($result)){
				echo "<option value=".$row[0].">" .$row[0]. "</option>";
			}
			?>
			</select>
		<?php
		//신청곡 list 보여주기 위한 코드 
		 $db = new mysqli("localhost", "seonda", "itdb2019itdb2019", "seonda");
			mysqli_set_charset($db, "utf8");

			$q = "SELECT mno,m_song,m_singer 
			FROM music";
			$result = $db->query($q);

			$n = 1;
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>" .$row[0] ."</td>";
				echo "<td>" .$row[1] ."</td>";
				echo "<td>" .$row[2] ."</td>";
				echo "</tr>";

				$n++;
			}
			?>
			</td>
			</tr>
			</table>
			<center>
			<input type="hidden" name="bno" value="<?=$number?>">
			<input type = "submit" value="작성">
			</center>
			</td>
                </tr>
        </table>
        <?php   }	?>
 </form>
