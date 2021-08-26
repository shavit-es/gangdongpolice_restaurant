<?php
	include 'commonpart.php';
	$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "announcement");
	settype($_POST['id'],'integer');
	$filtered_id=mysqli_real_escape_string($conn, $_POST['id']);
	$sql = 'SELECT password from password;';
	$result = mysqli_query($conn,$sql);
	$adminpass = htmlspecialchars(mysqli_fetch_array($result)['password']);
	$passwordinputstr='<form method="POST"><div class="container p-4 text-center">
	<br>관리자만이 글을 삭제할 수 있습니다. <br>비밀번호를 입력해주세요.<div class="input-group mt-3 mb-1">
	  <span class="input-group-text" id="basic-addon1">비밀번호</span>
	  <input type="hidden" name="id" value="'.$filtered_id.'">
	  <input type="password" name="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1"></div><p class="text-end mt-3">
	<input class="btn btn-primary btn-sm" type="submit" value="작성"/></p></div>
	<p class="text-end mt-3"></p></div></form>';
?>


<!DOCTYPE html>
<html lang="ko">
	<?=$headpart?>
	<body>
		<?=$navbar?>
		<?php
	$inputpass= $_POST['password'];
	if (password_verify($inputpass, $adminpass)){
		settype($_POST['id'],'integer');
		$filtered_id=mysqli_real_escape_string($conn, $_POST['id']);
		$sql="
		DELETE FROM announcement WHERE id={$filtered_id};
		ALTER TABLE announcement AUTO_INCREMENT=1;
		SET @COUNT = 0;
		UPDATE announcement SET id = @COUNT:=@COUNT+1;";
		$result = mysqli_multi_query($conn, $sql);
		if($result === false){
			echo '삭제하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
			echo '<a href="announcement?id={$filtered_id}>돌아가기</a>"';
			error_log(mysqli_error($conn));
		} else {
			header("Location: announcement.php");
		}
	}else{
		if (isset($_POST['password'])){
			echo '<script>alert("비밀번호가 일치하지 않습니다.")</script>';
		}
	}
	?>
		<?=$passwordinputstr?>	
	</body>
</html>