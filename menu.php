<?php
include "commonpart.php";
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<?=$headpart?>
	</head>
	<body>
		<?=$navbar?>
		<div class="container">
			<p class="mt-3 text-center rows">이번주 메뉴</p>
			<img class="imgsize rounded mx-auto d-block" src="images/menu.png"/>
		<br>
		<a type="button" class="rounded float-end btn btn-primary" href="menu_upload.php">업로드</a>
		</div>

		
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
			crossorigin="anonymous"
		></script>
	</body>
</html>