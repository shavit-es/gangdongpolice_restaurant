<?php
include "commonpart.php";
?>
<!DOCTYPE html>
<html lang="ko">
	<?=$headpart?>
	<body>
		<?=$navbar?>
		<ul class="nav justify-content-center">
			<li class="nav-item">
				<a class="nav-link" href="announcement.php">공지사항</a>
			</li>
			<li class="nav-item">
				<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">메뉴</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" aria-current="page" href="inquiry.php">식수조사</a>
			</li>
		</ul>
			<p class="text-center choose">
				금일 식사하실 끼니를 선택해주세요.
			</p>
		<div class="d-flex justify-content-around p-3 bd-highlight">
			<button type="button" class="btn btn-primary btn-sm">조식</button>
			<button type="button" class="btn btn-primary btn-sm">중식</button>
			<button type="button" class="btn btn-primary btn-sm">석식</button>
		</div>
		<script>
				src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
				integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
				crossorigin="anonymous"
			>
		</script>
	</body>
</html>