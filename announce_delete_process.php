<?php
	$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "announcement");
	settype($_POST['id'],'integer');
	$filtered_id=mysqli_real_escape_string($conn, $_POST['id']);
	$sql="
	DELETE FROM announcement WHERE id={$filtered_id};";
	$result = mysqli_query($conn, $sql);
	if($result === false){
		echo '삭제하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
		echo '<a href="announcement?id={$filtered_id}>돌아가기</a>"';
		error_log(mysqli_error($conn));
	} else {
		header("Location: announcement.php");
	}
?>