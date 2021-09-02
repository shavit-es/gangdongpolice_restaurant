<script
  src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
  integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
  crossorigin="anonymous"></script>
<script>
	src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js';
	integrity = 'sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj';
	crossorigin = 'anonymous';
</script>
<?php
if(!isset($_COOKIE["breakfasttoday"])){ //첫 세팅
	setcookie('breakfasttoday', 0, time()+86400, '/');
}
if(!isset($_COOKIE["lunchtoday"])){
	setcookie('lunchtoday', 0, time()+86400, '/');
}
if(!isset($_COOKIE["dinnertoday"])){
	setcookie('dinnertoday', 0, time()+86400, '/');
}

if(!isset($_COOKIE["breakfasttomorrow"])){ //첫 세팅
	setcookie('breakfasttoday', 0, time()+86400, '/');
}
if(!isset($_COOKIE["lunchtomorrow"])){
	setcookie('lunchtoday', 0, time()+86400, '/');
}
if(!isset($_COOKIE["dinnertomorrow"])){
	setcookie('dinnertoday', 0, time()+86400, '/');
}
include "commonpart.php";
$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "numeat");
$sqli = "SELECT * FROM inquiry order by id desc LIMIT 2";
$resulti=mysqli_query($conn, $sqli);
$meals = mysqli_fetch_array($resulti);
$resultbtomorrow=htmlspecialchars($meals['breakfast']);
$resultltomorrow=htmlspecialchars($meals['lunch']);
$resultdtomorrow=htmlspecialchars($meals['dinner']);
$meals = mysqli_fetch_array($resulti);
$resultbtoday=htmlspecialchars($meals['breakfast']);
$resultltoday=htmlspecialchars($meals['lunch']);
$resultdtoday=htmlspecialchars($meals['dinner']);
date_default_timezone_set('Asia/Seoul');
$todaytime = strtotime("Now");
$today=date("m/d", $todaytime);
$tommorowtime =strtotime("+1 days");
$tomorrow = date("m/d", $tommorowtime);
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<?=$headpart?>
	</head>
	<body>
		<?=$navbar?>
		<p class="text-center choose">
			금일(<?=$today?>) 식사하실 끼니를 선택해주세요.
		</p>
		<div class="d-flex justify-content-around p-3 m-3 bd-highlight border-bottom">
			<form action="inquiry_process.php" method="POST">
				<input type="submit" value="조식" name="조식오늘" class="inquiry_btn btn btn-sm" id="breakfasttoday_btn"/>
				<p class="text-center"><?=$resultbtoday?></p>
			</form>
			<form action="inquiry_process.php" method="POST">
				<input type="submit" value="중식" name="중식오늘" class="inquiry_btn btn btn-sm" id="lunchtoday_btn"/>
				<p class="text-center"><?=$resultltoday?></p>
			</form>
			<form action="inquiry_process.php" method="POST">
				<input type="submit" value="석식" name="석식오늘" class="inquiry_btn btn btn-sm" id="dinnertoday_btn"/>
				<p class="text-center"><?=$resultdtoday?></p>
			</form>
		</div>
		<br>
		<p class="text-center choose">
			내일(<?=$tomorrow?>) 식사하실 끼니를 선택해주세요.
		</p>
		<div class="d-flex justify-content-around p-3 m-3 bd-highlight border-bottom">
			<form action="inquiry_process.php" method="POST">
				<input type="submit" value="조식" name="조식내일" class="inquiry_btn btn btn-sm" id="breakfasttomorrow_btn"/>
				<p class="text-center"><?=$resultbtomorrow?></p>
			</form>
			<form action="inquiry_process.php" method="POST">
				<input type="submit" value="중식" name="중식내일" class="inquiry_btn btn btn-sm" id="lunchtomorrow_btn"/>
				<p class="text-center"><?=$resultltomorrow?></p>
			</form>
			<form action="inquiry_process.php" method="POST">
				<input type="submit" value="석식" name="석식내일" class="inquiry_btn btn btn-sm" id="dinnertomorrow_btn"/>
				<p class="text-center"><?=$resultdtomorrow?></p>
			</form>
		</div>
<?php
//버튼 표시 오늘
if(isset($_COOKIE["breakfasttoday"]) and $_COOKIE["breakfasttoday"]==1){
	echo '<script>$("#breakfasttoday_btn").removeClass("btn-primary").addClass("btn-secondary");</script>';
}else{
	echo '<script>$("#breakfasttoday_btn").removeClass("btn-secondary").addClass("btn-primary");</script>';
}
if(isset($_COOKIE["lunch"]) and $_COOKIE["lunch"]==1){
	echo '<script>$("#lunchtoday_btn").removeClass("btn-primary").addClass("btn-secondary");</script>';
}else{
	echo '<script>$("#lunchtoday_btn").removeClass("btn-secondary").addClass("btn-primary");</script>';
}
if(isset($_COOKIE["dinner"]) and $_COOKIE["dinner"]==1){
	echo '<script>$("#dinnertoday_btn").removeClass("btn-primary").addClass("btn-secondary");</script>';
}else{
	echo '<script>$("#dinnertoday_btn").removeClass("btn-secondary").addClass("btn-primary");</script>';
}

if(isset($_COOKIE["breakfasttomorrow"]) and $_COOKIE["breakfasttomorrow"]==1){
	echo '<script>$("#breakfasttomorrow_btn").removeClass("btn-primary").addClass("btn-secondary");</script>';
}else{
	echo '<script>$("#breakfasttomorrow_btn").removeClass("btn-secondary").addClass("btn-primary");</script>';
}
if(isset($_COOKIE["lunch"]) and $_COOKIE["lunch"]==1){
	echo '<script>$("#lunchtomorrow_btn").removeClass("btn-primary").addClass("btn-secondary");</script>';
}else{
	echo '<script>$("#lunchtomorrow_btn").removeClass("btn-secondary").addClass("btn-primary");</script>';
}
if(isset($_COOKIE["dinner"]) and $_COOKIE["dinner"]==1){
	echo '<script>$("#dinnertomorrow_btn").removeClass("btn-primary").addClass("btn-secondary");</script>';
}else{
	echo '<script>$("#dinnertomorrow_btn").removeClass("btn-secondary").addClass("btn-primary");</script>';
}
?>
	</body>
</html>