<?php
include "commonpart.php";
$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "announcement");
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
		<div class="container p-4">
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
		</div>
	</body>
</html>