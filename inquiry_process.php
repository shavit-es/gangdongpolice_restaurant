<?php
include "commonpart.php";
$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "numeat");
//안눌러져 있는 상태에서 눌렀을 때
if(($_COOKIE["breakfast"]==0) and (!empty($_POST['조식'])) and ( $_POST['조식'] == '조식' )) {
	$sql1 = "UPDATE numeat SET num_eat=(num_eat+1) WHERE meal='breakfast';";
	$result=mysqli_query($conn, $sql1);
	echo $result;
	setcookie('breakfast', 1, time() + 86400,'/');
}

if(($_COOKIE["lunch"]==0)&&(!empty($_POST['중식'])) && ( $_POST['중식'] == '중식' )) {
	$sql2 = "UPDATE numeat SET num_eat=(num_eat+1) WHERE meal='lunch';";
	$result=mysqli_query($conn, $sql2);
	setcookie('lunch', 1, time() + 86400,'/');

}
if( ($_COOKIE["dinner"]==0)&&(!empty($_POST['석식'])) && ( $_POST['석식'] == '석식' )) {
	$sql3 = "UPDATE numeat SET num_eat=(num_eat+1) WHERE meal='dinner';";
	$result=mysqli_query($conn, $sql3);
	setcookie('dinner', 1, time() + 86400,'/');
}

//눌러져 있는 상태에서 다시 눌러서 취소할 때
if( ($_COOKIE["breakfast"]==1)&&(!empty($_POST['조식'])) && ( $_POST['조식'] == '조식' )) {
	$sql11 = "UPDATE numeat SET num_eat=(num_eat-1) WHERE meal='breakfast';";
	$result=mysqli_query($conn, $sql11);
	setcookie('breakfast', 0, time() + 86400,'/');
}

if( ($_COOKIE["lunch"]==1)&&(!empty($_POST['중식'])) && ( $_POST['중식'] == '중식' )) {
	$sql22 = "UPDATE numeat SET num_eat=(num_eat-1) WHERE meal='lunch';";
	$result=mysqli_query($conn, $sql22);
	setcookie('lunch', 0, time() + 86400,'/');
}
if( ($_COOKIE["dinner"]==1)&&(!empty($_POST['석식'])) && ( $_POST['석식'] == '석식' )) {
	$sql33 = "UPDATE numeat SET num_eat=(num_eat-1) WHERE meal='dinner';";
	$result=mysqli_query($conn, $sql33);
	setcookie('dinner', 0, time() + 86400,'/');
}
if($result === false){
	echo '<!DOCTYPE html>
		<html lang="ko">
		<head>
		'.$headpart.'
		</head>
		<body>
		'.$navbar.'<p class="text-center"> 조사하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.</p>';
	error_log(mysqli_error($conn));
} else {
header("Location: inquiry.php");
}
?>