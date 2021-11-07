<?php
include "commonpart.php";
$conn = mysqli_connect("ip", "아이디", "패스워드", "announcement");
$sql = 'SELECT password from password;';
$result = mysqli_query($conn,$sql);
$adminpass = htmlspecialchars(mysqli_fetch_array($result)['password']);
$passwordinputstr='<form method="POST"><div class="container p-4 text-center">
<br>관리자만이 글을 작성할 수 있습니다. <br>비밀번호를 입력해주세요.<div class="input-group mt-3 mb-1">
  <span class="input-group-text" id="basic-addon1">비밀번호</span>
  <input type="password" name="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1"></div><p class="text-end mt-3">
<input class="btn btn-primary btn-sm" type="submit" value="작성"/></p></div>
<p class="text-end mt-3"></p></div></form>';
?>
<script>
function checker(){
	if (fo.title.value == ""){
		alert('제목을 반드시 입력해야합니다.');
		return false;
	}else{
		return confirm('글을 작성하시겠습니까?');
	}
}
</script>
<!DOCTYPE html>
<html lang="ko">
	<?=$headpart?>
	<body>
		<?=$navbar?>
	<?php
	if(isset($_POST['password'])){
		$inputpass= $_POST['password'];
	}
	if (password_verify($inputpass, $adminpass)){
		$passwordinputstr='';
		echo '<div class="container p-4">
			<form name="fo" action="announce_create_process.php" method="POST" onsubmit="return checker();">
				<div class="input-group input-group-sm">
					<span class="input-group-text" id="inputGroup-sizing-default">제목</span>
					<input
						type="text"
						class="form-control"
						aria-label="title"
						aria-describedby="제목"
						name="title"
					/>
				</div>
				<div class="form-floating mt-3">
					<textarea
						class="form-control"
						placeholder="Leave a comment here"
						id="floatingTextarea2"
						style="height: 100px;"
							  name="description"
					></textarea>
					<label for="floatingTextarea2">내용</label>
				</div>
				<p class="text-end mt-3">
					<input class="btn btn-primary btn-sm" type="submit" value="작성"/>
				</p>
			</form>
		</div>';
	}else{
		if (isset($_POST['password'])){
			echo '<script>alert("비밀번호가 일치하지 않습니다.")</script>';
		}
	}
	?>
		<?=$passwordinputstr?>
	
		
	</body>
</html>
