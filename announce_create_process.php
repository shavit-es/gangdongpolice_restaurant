<?php
// $conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "announcement");
$conn = mysqli_connect("146.56.146.249", "restandeat", "Knp7109!", "announcement");
$filtered = array(
'title'=>mysqli_real_escape_string($conn,$_POST['title']),
'description'=>mysqli_real_escape_string($conn,$_POST['description']),
	'created'=>mysqli_real_escape_string($conn,$_POST['created'])
);
$sql="
INSERT INTO announcement
(title, description, created)
VALUES(
'{$filtered['title']}','{$filtered['description']}',NOW()
)";
$result = mysqli_query($conn, $sql);
if($result === false){
	echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
	error_log(mysqli_error($conn));
} else {
header("Location: announcement.php");
}
?>