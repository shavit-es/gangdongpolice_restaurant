<?php
include "commonpart.php";
date_default_timezone_set('Asia/Seoul');
$conn = mysqli_connect("146.56.146.249", "restandeat", "Knp7109!", "numeat");
//안눌러져 있는 상태에서 눌렀을 때

function inquiryyes($meal ,$postvalue, $day){
	$korday="";
	$sqltime="";
	if($day=="tomorrow"){
		$korday="내일";
		$sqltime="ORDER BY id DESC LIMIT 1;";
	}elseif($day=="today"){
		$korday="오늘";
		$sqltime="WHERE date='".date('y-m-d')."';";
	}
	$postname=$postvalue.$korday;
	$cookie = $meal.$day;
	if(($_COOKIE[$cookie]==0) and (!empty($_POST[$postname])) and ( $_POST[$postname] == $postvalue )) {
		global $conn;
		$sql1 = "UPDATE inquiry SET ".$meal."=(".$meal."+1) ".$sqltime;
		$result=mysqli_query($conn, $sql1);
		setcookie($cookie, 1, strtotime("today 23:59") ,'/');
		setcookie($cookie.'alive', 1, strtotime("tomorrow 23:59") ,'/');
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
	}
}

function inquiryno($meal ,$postvalue, $day){
	$korday="";
	$sqltime="";
	if($day=="tomorrow"){
		$korday="내일";
		$sqltime="ORDER BY id DESC LIMIT 1;";
	}elseif($day=="today"){
		$korday="오늘";
		$sqltime="WHERE date='".date('y-m-d')."';";
	}
	$postname=$postvalue.$korday;
	$cookie = $meal.$day;
	if(($_COOKIE[$cookie]==1) and (!empty($_POST[$postname])) and ( $_POST[$postname] == $postvalue )) {
		global $conn;
		$sql1 = "UPDATE inquiry SET ".$meal."=(".$meal."-1) ".$sqltime;
		$result=mysqli_query($conn, $sql1);
		setcookie($cookie, 0, strtotime("today 23:59") ,'/');
		setcookie($cookie.'alive', 0, strtotime("tomorrow 23:59") ,'/');
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
	}
}

inquiryyes("breakfast", "조식", "today");
inquiryyes("lunch", "중식", "today");
inquiryyes("dinner", "석식", "today");

inquiryyes("breakfast", "조식", "tomorrow");
inquiryyes("lunch", "중식", "tomorrow");
inquiryyes("dinner", "석식", "tomorrow");

inquiryno("breakfast", "조식", "today");
inquiryno("lunch", "중식", "today");
inquiryno("dinner", "석식", "today");

inquiryno("breakfast", "조식", "tomorrow");
inquiryno("lunch", "중식", "tomorrow");
inquiryno("dinner", "석식", "tomorrow");

?>