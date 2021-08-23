<?php
include "commonpart.php";
$conn = mysqli_connect("13.125.210.40", "shavit0423", "hyun0430!@my", "announcement","51648");
?>
<!DOCTYPE html>
<html lang="ko">
	<?=$headpart?>
	<body>
		<?=$navbar?>
		<ul class="nav justify-content-center">
			<li class="nav-item">
				<a class="nav-link active" aria-current="page" href="announcement.php">공지사항</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">메뉴</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="inquiry.php">식수조사</a>
			</li>
		</ul>
		<div class="container p-4">
			<form action="announce_create_process.php" method="POST">
				<div class="input-group input-group-sm">
					<span class="input-group-text" id="inputGroup-sizing-default">제목</span>
					<input
						type="text"
						class="form-control"
						aria-label="Sizing example input"
						aria-describedby="inputGroup-sizing-default"
						name="title"
					/>
				</div>
				<div class="form-floating mt-3">
					<textarea
						class="form-control"
						placeholder="Leave a comment here"
						id="floatingTextarea2"
						style="height: 100px;"
					></textarea>
					<label for="floatingTextarea2">내용</label>
				</div>
				<p class="text-end mt-3">
					<input class="btn btn-primary btn-sm" type="submit" value="작성" />
				</p>
			</form>
		</div>
	</body>
</html>