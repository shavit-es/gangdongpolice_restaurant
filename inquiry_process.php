<?php
include "commonpart.php";
$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "numeat");
//안눌러져 있는 상태에서 눌렀을 때
if(($_COOKIE["breakfasttomorrow"]==0) and (!empty($_POST['조식내일'])) and ( $_POST['조식내일'] == '조식' )) {
	$sql1 = "UPDATE inquiry SET breakfast=(breakfast+1) ORDER BY id DESC LIMIT 1;";
	$result=mysqli_query($conn, $sql1);
	echo $result;
	setcookie('breakfasttomorrow', 1, time() + 86400,'/');
}

if(($_COOKIE["lunchtomorrow"]==0)&&(!empty($_POST['중식내일'])) && ( $_POST['중식내일'] == '중식' )) {
	$sql2 = "UPDATE inquiry SET lunch=(lunch+1) ORDER BY id DESC LIMIT 1;";
	$result=mysqli_query($conn, $sql2);
	setcookie('lunchtomorrow', 1, time() + 86400,'/');

}
if( ($_COOKIE["dinnertomorrow"]==0)&&(!empty($_POST['석식내일'])) && ( $_POST['석식내일'] == '석식' )) {
	$sql3 = "UPDATE inquiry SET dinner=(dinner+1) ORDER BY id DESC LIMIT 1;";
	$result=mysqli_query($conn, $sql3);
	setcookie('dinnertomorrow', 1, time() + 86400,'/');
}

//눌러져 있는 상태에서 다시 눌러서 취소할 때
if( ($_COOKIE["breakfasttomorrow"]==1)&&(!empty($_POST['조식내일'])) && ( $_POST['조식내일'] == '조식' )) {
	$sql11 = "UPDATE inquiry SET breakfast=(breakfast-1) ORDER BY id DESC LIMIT 1;";
	$result=mysqli_query($conn, $sql11);
	setcookie('breakfasttomorrow', 0, time() + 86400,'/');
}

if( ($_COOKIE["lunchtomorrow"]==1)&&(!empty($_POST['중식내일'])) && ( $_POST['중식내일'] == '중식' )) {
	$sql22 = "UPDATE inquiry SET lunch=(lunch-1) ORDER BY id DESC LIMIT 1;";
	$result=mysqli_query($conn, $sql22);
	setcookie('lunchtomorrow', 0, time() + 86400,'/');
}
if( ($_COOKIE["dinnertomorrow"]==1)&&(!empty($_POST['석식내일'])) && ( $_POST['석식내일'] == '석식' )) {
	$sql33 = "UPDATE inquiry SET dinner=(dinner-1) ORDER BY id DESC LIMIT 1;";
	$result=mysqli_query($conn, $sql33);
	setcookie('dinnertomorrow', 0, time() + 86400,'/');
}

///////////////////////////////////////////////////////////////

if(($_COOKIE["breakfasttoday"]==0) and (!empty($_POST['조식오늘'])) and ( $_POST['조식오늘'] == '조식' )) {
	$sql1 = "UPDATE inquiry SET breakfast=(breakfast+1) WHERE date='".date('y-m-d')."';";
	$result=mysqli_query($conn, $sql1);
	echo $result;
	setcookie('breakfasttoday', 1, time() + 86400,'/');
}

if(($_COOKIE["lunchtoday"]==0)&&(!empty($_POST['중식오늘'])) && ( $_POST['중식오늘'] == '중식' )) {
	$sql2 = "UPDATE inquiry SET lunch=(lunch+1) WHERE date='".date('y-m-d')."';";
	$result=mysqli_query($conn, $sql2);
	setcookie('lunchtoday', 1, time() + 86400,'/');

}
if( ($_COOKIE["dinnertoday"]==0)&&(!empty($_POST['석식오늘'])) && ( $_POST['석식오늘'] == '석식' )) {
	$sql3 = "UPDATE inquiry SET dinner=(dinner+1) WHERE date='".date('y-m-d')."';";
	$result=mysqli_query($conn, $sql3);
	setcookie('dinnertoday', 1, time() + 86400,'/');
}

//눌러져 있는 상태에서 다시 눌러서 취소할 때
if( ($_COOKIE["breakfasttoday"]==1)&&(!empty($_POST['조식오늘'])) && ( $_POST['조식오늘'] == '조식' )) {
	$sql11 = "UPDATE inquiry SET breakfast=(breakfast-1) WHERE date='".date('y-m-d')."';";
	$result=mysqli_query($conn, $sql11);
	setcookie('breakfasttoday', 0, time() + 86400,'/');
}

if( ($_COOKIE["lunchtoday"]==1)&&(!empty($_POST['중식오늘'])) && ( $_POST['중식오늘'] == '중식' )) {
	$sql22 ="UPDATE inquiry SET lunch=(lunch-1) WHERE date='".date('y-m-d')."';";
	$result=mysqli_query($conn, $sql22);
	setcookie('lunchtoday', 0, time() + 86400,'/');
}
if( ($_COOKIE["dinnertoday"]==1)&&(!empty($_POST['석식오늘'])) && ( $_POST['석식오늘'] == '석식' )) {
	$sql33 ="UPDATE inquiry SET dinner=(dinner-1) WHERE date='".date('y-m-d')."';";
	$result=mysqli_query($conn, $sql33);
	setcookie('dinnertoday', 0, time() + 86400,'/');
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