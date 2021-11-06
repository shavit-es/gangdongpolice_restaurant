<script>
function checker(){
	if (fo.title.value == ""){
		alert('제목을 반드시 입력해야합니다.');
		return false;
	}else{
		return confirm('글을 수정하시겠습니까?');
	}
}
</script>
<?php
include "commonpart.php";
$conn = mysqli_connect("ip", "아이디", "비밀번호", "announcement");
$filtered_id=htmlspecialchars($_GET['id']); //보안(XSS) 공격 방지
$sql = 'SELECT password from password;';
$result = mysqli_query($conn,$sql);
$adminpass = htmlspecialchars(mysqli_fetch_array($result)['password']);
$passwordinputstr='<form method="POST"><div class="container p-4 text-center">
<br>관리자만이 글을 수정할 수 있습니다. <br>비밀번호를 입력해주세요.<div class="input-group mt-3 mb-1">
  <span class="input-group-text" id="basic-addon1">비밀번호</span>
  <input type="password" name="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1"></div><p class="text-end mt-3">
<input class="btn btn-primary btn-sm" type="submit" value="작성"/></p></div>
<p class="text-end mt-3"></p></div></form>';
if(isset($_GET['id'])){ //id값이 존재한다면 ?id=*
	$dessql="SELECT * FROM announcement WHERE id={$filtered_id};"; //id값에 해당하는 행 받아오기
	$result = mysqli_query($conn, $dessql);
	$rowdes = mysqli_fetch_array($result);
	$escapedtitle = htmlspecialchars($rowdes['title']);
	$escapeddesc = htmlspecialchars($rowdes['description']);
	$modtitle='<input type="hidden" name="id" value='.$filtered_id.'>
		<div class="input-group input-group-sm">
			<span class="input-group-text" id="inputGroup-sizing-default">제목</span>
			<input
				type="text"
				class="form-control"
				aria-label="Sizing example input"
				aria-describedby="inputGroup-sizing-default"
				name="title"
				value="'.$escapedtitle.'"
			>
		</div>';
	$moddesc='<div class="form-floating mt-3">
					<textarea
						class="form-control"
						placeholder="Leave a comment here"
						id="floatingTextarea2"
						style="height: 100px;"
							  name="description"
					>'.$escapeddesc.'</textarea>
					<label for="floatingTextarea2">내용</label>
				</div>';
}
?>
<!DOCTYPE html>
<html lang="ko">
	<?=$headpart?>
	<body>
		<?=$navbar?>
		<?php
	$inputpass= $_POST['password'];
	if (password_verify($inputpass, $adminpass)){
		$passwordinputstr='';
		echo '<div class="container p-4">
			<form name="fo" action="announce_modify_process.php" method="POST" onsubmit="return checker();">
				'.$modtitle.'
				'.$moddesc.'
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
