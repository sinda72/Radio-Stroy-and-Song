<!-- index.php : 게시글 글 목록 보여주는 코드 -->

<!DOCTYPE html>
 
<html>
<head>
        <meta charset = 'utf-8'>
</head>

<body>
<?php
	// DB연결
	$connect = mysqli_connect('localhost', 'seonda', 'itdb2019itdb2019', 'seonda') or die ("connect fail");
	//$number = $_GET[bno];
	
	// 작성한 게시글이 저장된 board 테이블에서 해당 값을 불러옴 (이때, bno 정렬로 불러옴)
	$query ="select bno, b_title, b_id, b_date, b_mno from board order by bno desc";
	$result = $connect->query($query);
	// 게시글의 행 개수만큼 숫자로 변환해 total변수에 넣음
	$total = mysqli_num_rows($result);
	
	// 로그인할 때 입력한 ID를 받아옴
	session_start();
	if(isset($_SESSION['userid'])) {
	
		echo $_SESSION['userid'];?>님 안녕하세요
			<br/>
	<?php
			}
			// 로그인을 하지 않고, 목록을 보려고하는 경우, 로그인 먼저 시행함
			else {
	?>              <button onclick="location.href='login.php'">로그인</button>
	   
	<?php   }
	?>
	<!-- 게시판 디자인 -->
	<h2 align=center>게시판</h2>
	<table align = center>
	<thead align = "center">
	<tr>
	<td width = "100" align="center">사연번호</td>
	<td width = "500" align = "center">제목</td>
	<td width = "100" align = "center">작성자</td>
	<td width = "200" align = "center">작성일</td>
	<td width = "100" align = "center">신청곡</td>
	</tr>
	</thead>

	<tbody>
	<?php
	//DB에 저장된 데이터 수 (열 기준)
	while($rows = mysqli_fetch_assoc($result)){ 
		if($total%2==0){
	?>    <tr class = "even">
	<?php   }
		else{
	?>      <tr>
	<?php } ?>
			<td width = "50" align = "center"><?php echo $total?></td>
			<td width = "500" align = "center">
			<a href = "view.php?bno=<?php echo $rows['bno']?>">
			<?php echo $rows['b_title']?></td>
			<td width = "100" align = "center"><?php echo $rows['b_id']?></td>
			<td width = "200" align = "center"><?php echo $rows['b_date']?></td>
			<td width = "50" align = "center"><?php echo $rows['b_mno']?></td>
			</tr>
	<?php
			$total--;
			}
	?>
	</tbody>
	</table>
	<!-- 게시글글쓰기 : write.php -->
	<div class = text>
	<font style="cursor: hand"onClick="location.href='write.php'">글쓰기</font>
	</div>

 <style>
	table{
			border-top: 1px solid #444444;
			border-collapse: collapse;
	}
	tr{
			border-bottom: 1px solid #444444;
			padding: 10px;
	}
	td{
			border-bottom: 1px solid #efefef;
			padding: 10px;
	}
	table .even{
			background: #efefef;
	}
	.text{
			text-align:center;
			padding-top:20px;
			color:#000000
	}
	.text:hover{
			text-decoration: underline;
	}
	a:link {color : #57A0EE; text-decoration:none;}
	a:hover { text-decoration : underline;}
</style>
</body>
</html>
