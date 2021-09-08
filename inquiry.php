<script
  src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
  integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
  crossorigin="anonymous"></script>
<?php
date_default_timezone_set('Asia/Seoul');
if(!isset($_COOKIE["breakfasttoday"])){ //첫 세팅
	if(isset($_COOKIE["breakfasttomorrowalive"])){
		setcookie('breakfasttoday', $_COOKIE["breakfasttomorrowalive"], strtotime("today 23:59"), '/');
		header('Location:inquiry.php');
	}else{
		setcookie('breakfasttoday', 0, strtotime("today 23:59"), '/');
	}
}
if(!isset($_COOKIE["lunchtoday"])){
	if(isset($_COOKIE["lunchtomorrowalive"])){
		setcookie('lunchtoday', $_COOKIE["lunchtomorrowalive"], strtotime("today 23:59"), '/');
		header('Location:inquiry.php');
	}else{
		setcookie('lunchtoday', 0, strtotime("today 23:59"), '/');
	}
}
if(!isset($_COOKIE["dinnertoday"])){
	if(isset($_COOKIE["dinnertomorrowalive"])){
		setcookie('dinnertoday', $_COOKIE["dinnertomorrowalive"], strtotime("today 23:59"), '/');
		header('Location:inquiry.php');
	}else{
		setcookie('dinnertoday', 0, strtotime("today 23:59"), '/');
	}
}

if(!isset($_COOKIE["breakfasttomorrow"])){ //첫 세팅
	setcookie('breakfasttomorrow', 0, strtotime("today 23:59"), '/');
	setcookie('breakfasttomorrowalive', 0, strtotime("tomorrow 23:59"), '/');
}
if(!isset($_COOKIE["lunchtomorrow"])){
	setcookie('lunchtomorrow', 0, strtotime("today 23:59"), '/');
	setcookie('lunchtomorrowalive', 0, strtotime("tomorrow 23:59"), '/');
}
if(!isset($_COOKIE["dinnertomorrow"])){
	setcookie('dinnertomorrow', 0, strtotime("today 23:59"), '/');
	setcookie('dinnertomorrowalive', 0, strtotime("tomorrow 23:59"), '/');
}
include "commonpart.php";
$conn = mysqli_connect("146.56.146.249", "restandeat", "Knp7109!", "numeat");
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
	function buttonclass($cookiename, $btnid){
		if(isset($_COOKIE[$cookiename]) and $_COOKIE[$cookiename]==1){
		echo '<script>$("'.$btnid.'").removeClass("btn-primary").addClass("btn-secondary");</script>';
		}else{
			echo '<script>$("'.$btnid.'").removeClass("btn-secondary").addClass("btn-primary");</script>';
		}
	}
		
		
		buttonclass("breakfasttoday", "#breakfasttoday_btn");
		buttonclass("lunchtoday", "#lunchtoday_btn");
		buttonclass("dinnertoday", "#dinnertoday_btn");
		
		buttonclass("breakfasttomorrow" , "#breakfasttomorrow_btn");
		buttonclass("lunchtomorrow" ,"#lunchtomorrow_btn");
		buttonclass("dinnertomorrow" , "#dinnertomorrow_btn");
		
		echo $endpart;
?>