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
if(!isset($_COOKIE["breakfast"])){ //첫 세팅
	setcookie('breakfast', 0, time()+86400, '/');
}
if(!isset($_COOKIE["lunch"])){
	setcookie('lunch', 0, time()+86400, '/');
}
if(!isset($_COOKIE["dinner"])){
	setcookie('dinner', 0, time()+86400, '/');
}
include "commonpart.php";
$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "numeat");
$sqlloadb="SELECT num_eat from numeat WHERE meal='breakfast';";
$resultb=mysqli_query($conn, $sqlloadb);
$rowb=mysqli_fetch_array($resultb)['num_eat'];
$sqlloadl="SELECT num_eat from numeat WHERE meal='lunch';";
$resultl=mysqli_query($conn, $sqlloadl);
$rowl=mysqli_fetch_array($resultl)['num_eat'];
$sqlloadd="SELECT num_eat from numeat WHERE meal='dinner';";
$resultd=mysqli_query($conn, $sqlloadd);
$rowd=mysqli_fetch_array($resultd)['num_eat'];
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<?=$headpart?>
	</head>
	<body>
		<?=$navbar?>
		<p class="text-center choose">
			금일 식사하실 끼니를 선택해주세요.
		</p>
		<div class="d-flex justify-content-around p-3 bd-highlight">
			<form action="inquiry_process.php" method="POST">
				<input type="submit" value="조식" name="조식" class="inquiry_btn btn btn-sm" id="breakfast_btn"/>
				<p class="text-center"><?=$rowb?></p>
			</form>
			<form action="inquiry_process.php" method="POST">
				<input type="submit" value="중식" name="중식" class="inquiry_btn btn btn-sm" id="lunch_btn"/>
				<p class="text-center"><?=$rowl?></p>
			</form>
			<form action="inquiry_process.php" method="POST">
				<input type="submit" value="석식" name="석식" class="inquiry_btn btn btn-sm" id="dinner_btn"/>
				<p class="text-center"><?=$rowd?></p>
			</form>
<?php
//버튼 표시
if($_COOKIE["breakfast"]==1){
	echo '<script>$("#breakfast_btn").removeClass("btn-primary").addClass("btn-secondary");</script>';
}else{
	echo '<script>$("#breakfast_btn").removeClass("btn-secondary").addClass("btn-primary");</script>';
}
if($_COOKIE["lunch"]==1){
	echo '<script>$("#lunch_btn").removeClass("btn-primary").addClass("btn-secondary");</script>';
}elseif($_COOKIE["lunch"]==0){
	echo '<script>$("#lunch_btn").removeClass("btn-secondary").addClass("btn-primary");</script>';
}
if($_COOKIE["dinner"]==1){
	echo '<script>$("#dinner_btn").removeClass("btn-primary").addClass("btn-secondary");</script>';
}elseif($_COOKIE["dinner"]==0){
	echo '<script>$("#dinner_btn").removeClass("btn-secondary").addClass("btn-primary");</script>';
}
?>
		</div>
	</body>
</html>