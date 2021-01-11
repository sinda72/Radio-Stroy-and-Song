<!-- view : 게시판 목록에서 제목을 누르면 해당 게시글이 보이는 화면 -->

<!DOCTYPE html>
<html>
<head>
        <meta charset = 'utf-8'>
</head>
<body>

<?php
	$connect = mysqli_connect('localhost', 'seonda', 'itdb2019itdb2019', 'seonda');
	$number = $_GET['bno'];

	session_start();
	// 게시판 목록에서 제목을 선택하면, 해당 번호와 일치하는 값을 출력하여 view로 보여주는 SELECT 쿼리
	$query = "select b_id, b_title, b_mno,b_content from board where bno =$number";
	$result = $connect->query($query);
	$rows = mysqli_fetch_assoc($result);
	?>

	<table class="view_table" align=center> 
	<tr>
	<td colspan="4" class="view_title"><?php echo $rows['b_title']?></td>
	</tr>
	<tr>
	<td class="view_id">작성자</td>
	<td class="view_id2"><?php echo $rows['b_id']?></td>
	<td class="view_mno">신청곡번호</td>
	<td class="view_mno2"><?php echo $rows['b_mno']?></td>
	</tr>
	<tr>
	<td colspan="4" class="view_content" valign="top">
	<?php echo $rows['b_content']?></td>
	</tr>
	</table>
 
 <!-- 목록보기 / 수정하기 / 삭제하기 기능을 버튼을 누르면 실행되도록 구현함 -->
	<div class="view_btn">
	<button class="view_btn1" onclick="location.href='index.php'">목록</button>
	<button class="view_btn1" onclick="location.href='modify.php?bno=<?=$number?>'">수정</button>
	<button class="view_btn1" onclick="location.href='delete.php?bno=<?=$number?>'">삭제</button>

 <style>
.view_table {
border: 1px solid #444444;
margin-top: 30px;
}
.view_title {
height: 30px;
text-align: center;
background-color: #cccccc;
color: white;
width: 1000px;
}
.view_id {
text-align: center;
background-color: #EEEEEE;
width: 30px;
}
.view_id2 {
background-color: white;
width: 60px;
}
.view_mno {
background-color: #EEEEEE;
width: 30px;
text-align: center;
}
.view_mno2 {
background-color: white;
width: 60px;
}
.view_content {
padding-top: 20px;
border-top: 1px solid #444444;
height: 500px;
}
.view_btn {
width: 700px;
height: 200px;
text-align: center;
margin: auto;
margin-top: 50px;
}
.view_btn1 {
height: 50px;
width: 100px;
font-size: 20px;
text-align: center;
background-color: white;
border: 2px solid black;
border-radius: 10px;
}
.view_comment_input {
width: 700px;
height: 500px;
text-align: center;
margin: auto;
}
.view_text3 {
font-weight: bold;
float: left;
margin-left: 20px;
}
.view_com_id {
width: 100px;
}
.view_comment {
width: 500px;
}
 </style>
 </body>
 