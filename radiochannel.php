<!-- radiochannel.php : 라디오 채널 기능 => 기본 정렬 / DJ이름 정렬 / 선호하는 채널 선택 / 카테고리 지정 -->

<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
<title>MBC Radio List</title>
<div class="container"><nav><ul>
		<h1>MBC Radio List</h1>
        </ul></nav>
</div> 
</head>
<body>
<table border=1> <tr> <th>번호</th><th>시간</th><th>방송이름</th><th>DJ</th><th>주파수</th> </tr>

<form method="post">
    <input type="submit" name="basic" id="basic" value="BASIC" />
	<input type="submit" name="sorting" id="sorting" value="SORT" />
    <br/>
</form>

<?php
// 라디오번호를 순으로 리스트 출력
function basic()
{
	$db = new mysqli("localhost", "seonda", "itdb2019itdb2019", "seonda");
	mysqli_set_charset($db, "utf8");
	// radio 테이블에 넣어둔, 튜플 값을 모두 출력하는 SELECT 쿼리
	$q = "SELECT rno,r_time,r_name,dj,r_channel 
			FROM radio";
	$result = $db->query($q);
	$n = 1;
	while($row = mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>" .$row[0] ."</td>";
		echo "<td>" .$row[1] ."</td>";
		echo "<td>" .$row[2] ."</td>";
		echo "<td>" .$row[3] ."</td>";
		echo "<td>" .$row[4] ."</td>";
		echo "</tr>";
		$n++;
	}
}
// DJ이름 순으로 라디오 리스트 정렬을 위한 함수 
function sorting()
{
	$db = new mysqli("localhost", "seonda", "itdb2019itdb2019", "seonda");
	mysqli_set_charset($db, "utf8");
	// DJ이름으로 오름차순으로 정렬하는 SELECT 쿼리 
	$q = "SELECT rno,r_time,r_name,dj,r_channel 
		FROM radio
		order by dj asc";
	$result = $db->query($q);
	$n = 1;
	while($row = mysqli_fetch_array($result)){
		echo "<tr>";
		echo "<td>" .$row[0] ."</td>";
		echo "<td>" .$row[1] ."</td>";
		echo "<td>" .$row[2] ."</td>";
		echo "<td>" .$row[3] ."</td>";
		echo "<td>" .$row[4] ."</td>";
		echo "</tr>";
		$n++;
	}
}

if(array_key_exists('basic',$_POST)){
   basic();
}
if(array_key_exists('sorting',$_POST)){
   sorting();
}
?>

</table>
<!--구독을 위한 form으로 radio 테이블에 존재하는 라디오 채널 고유 번호를 SELECTBOX에 받아온다. 
사용자는 리스트를 통해 번호를 확인하고 구독버튼을 클릭한다. 
삽입을 위한 f_insert.php로 사용자가 선택한 값이 전송된다.
db에 favorite테이블에 값이 삽입된다.-->
<form name="s_select" action="f_insert.php"  method="get">
	<select id='favorite' name='favorite'>
		<?php
			$db = new mysqli("localhost", "seonda", "itdb2019itdb2019", "seonda");
			mysqli_set_charset($db, "utf8");
			$q="select rno from radio";
			$result = $db->query($q);
			while($row = mysqli_fetch_array($result)){
				echo "<option value=".$row[0].">" .$row[0]. "</option>";
			}
		?>
	</select>
	카테고리 : <input type="text" name="category">
<input type="submit" value="구독하기" />
</form> 

<form method="post">
    <input type="submit" name="f_list" id="f_list" value="구독 리스트 보기" />
    <br/>
</form>

<!--사용자의 구독 리스트 보기 위한 코드-->
<?php

function f_list()
{
	$db = new mysqli("localhost", "seonda", "itdb2019itdb2019", "seonda");
	mysqli_set_charset($db, "utf8");

	// 선호채널로 선택한 라디오 번호를 확인하는 SELECT 쿼리
	session_start();
	$id=$_SESSION['userid'];
	$q = "SELECT f_rno,f_category 
		FROM favorite where f_id='$id'" ;
	$result = $db->query($q);

		echo "나의 구독 채널 번호 :";
	while($row = mysqli_fetch_array($result)){
	
		echo "NO. " .$row[0] ." Category: ".$row[1]." , ";
	}
}
if(array_key_exists('f_list',$_POST)){
   f_list();
}
?>

</body>
</html>
