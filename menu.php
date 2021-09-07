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
<?=$endpart?>