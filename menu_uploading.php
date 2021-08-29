<?php 
include "commonpart.php";
$uploads_dir = './images';
$allowed_ext = array('jpg','jpeg','png');
//$_FILES에 담긴 배열 정보 구하기.
$error = $_FILES['menuimg']['error'];
$name = $_FILES['menuimg']['name'];
$ext = array_pop(explode('.', $name));
$uppart='<!DOCTYPE html>
<html lang="ko">
	<head>
		<?=$headpart?>
	</head>
	<body>
		<?=$navbar?>';

// 오류 확인
if( $error != UPLOAD_ERR_OK ) {
	switch( $error ) {
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			echo $uppart."<p class='text-center'>파일이 너무 큽니다. ($error)</p>";
			break;
		case UPLOAD_ERR_NO_FILE:
			echo $uppart."<p class='text-center'>파일이 첨부되지 않았습니다. ($error)</p>";
			break;
		default:
			echo $uppart."<p class='text-center'>파일이 제대로 업로드되지 않았습니다. ($error)";
	}
	exit;
}


 
// 확장자 확인
if( !in_array($ext, $allowed_ext) ) {
	echo "허용되지 않는 확장자입니다. 사진파일만 가능합니다.(jpg, jpeg, png)";
	exit;
}
 
// 파일 이동
move_uploaded_file( $_FILES['menuimg']['tmp_name'], "$uploads_dir/menu.png");
header("Location:menu_upload.php")
?>