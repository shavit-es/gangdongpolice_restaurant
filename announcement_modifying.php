<?php
include "commonpart.php";
$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "announcement");
$filtered_id=htmlspecialchars($_GET['id']); //보안(XSS) 공격 방지
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
		<div class="container p-4">
			<form action="announce_modify_process.php" method="POST" onsubmit="return confirm('글을 수정하시겠습니까?')">
				<?=$modtitle?>
				<?=$moddesc?>
				<p class="text-end mt-3">
					<input class="btn btn-primary btn-sm" type="submit" value="작성"/>
				</p>
			</form>
		</div>
	</body>
</html>