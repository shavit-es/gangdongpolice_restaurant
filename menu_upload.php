<?php
include "commonpart.php";
$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "announcement");
$sql = 'SELECT password from password;';
$result = mysqli_query($conn,$sql);
$adminpass = htmlspecialchars(mysqli_fetch_array($result)['password']);
$passwordinputstr='<form method="POST"><div class="container p-4 text-center">
	<br>관리자만이 사진을 올릴 수 있습니다. <br>비밀번호를 입력해주세요.<div class="input-group mt-3 mb-1">
	<span class="input-group-text" id="basic-addon1">비밀번호</span>
	<input type="password" name="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1"></div><p class="text-end mt-3">
	<input class="btn btn-primary btn-sm" type="submit" value="입력"/></p></div>
	<p class="text-end mt-3"></p></div></form>';
?>
<script>

</script>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<?=$headpart?>
	</head>
	<body>
		<?=$navbar?>
	<?php
	if(isset($_POST['password'])){
		$inputpass= $_POST['password'];
	}
	if (password_verify($inputpass, $adminpass)){
		$passwordinputstr='';
		echo '
		<p class="mt-3 text-center rows">이번주 메뉴</p>
		<img class="imgsize rounded mx-auto d-block" src="images/menu.png"/>
		 <br>
		 <form class="text-end" method="post" action="menu_uploading.php" enctype="multipart/form-data"> 
		 <input class="form-label" type="file" name="menuimg"/><br>
		 <input class="btn btn-primary btn-sm me-3" type="submit" value="업로드" onclick="loading();" /></form>
			';
	}else{
		if (isset($_POST['password'])){
			echo '<script>alert("비밀번호가 일치하지 않습니다.")</script>';
		}
	}
	?>
		<?=$passwordinputstr?>
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
			crossorigin="anonymous"
		></script>
	</body>
</html>