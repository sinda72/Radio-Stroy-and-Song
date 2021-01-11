<!-- write.php : 게시글 작성하는 코드-->
<!DOCTYPE html>
<html>
<head>
   <meta charset = 'utf-8'>
</head>
<body>
<form method = "get" action = "write_action.php">
<?php session_start(); ?>
<table  style="padding-top:50px" align = center width=1000 border=0 cellpadding=2 >
	<tr>
	<td height=20 align= center bgcolor=#ccc><font color=white> 글쓰기</font></td>
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
			<td><input type = "text" name = "bno" size=40> </td>
			</tr>
			<tr>
			<tr>
			<td>라디오 채널</td>
			<td><input type = "text" name = "rno" size=40> </td>
			</tr>

			<tr>
			<td>제목</td>
			<td><input type = "text" name = "b_title" size=70></td>
			</tr>

			<tr>
			<td>내용</td>
			<td><textarea name = "b_content" cols=85 rows=15></textarea></td>
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
				// 게시글을 작성하기 위한 신청곡을 해당 리스트를 불러옴
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
				// music 테이블에 입력된 튜플 값 출력
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
<input type = "submit" value="작성">
</center>

	</td>
	</tr>
</table>
</form>
<style>
        table.table2{
                border-collapse: separate;
                border-spacing: 1px;
                text-align: left;
                line-height: 1.5;
                border-top: 1px solid #ccc;
                margin : 20px 10px;
        }
        table.table2 tr {
                 width: 50px;
                 padding: 10px;
                font-weight: bold;
                vertical-align: top;
                border-bottom: 1px solid #ccc;
        }
        table.table2 td {
                 width: 100px;
                 padding: 10px;
                 vertical-align: top;
                 border-bottom: 1px solid #ccc;
        }
 
</style>
</body>
</html>