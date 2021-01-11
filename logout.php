<!-- logout.php : 로그아웃, session이 사라지면, 로그아웃됨 -->

<meta charset="utf-8">
<?php
 
        session_start();
        $result = session_destroy();
 
        if($result) {
?>
        <script>
                alert("로그아웃 되었습니다.");
                history.back();
        </script>
<?php   }
?>