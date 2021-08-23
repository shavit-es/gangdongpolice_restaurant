<?php
$conn = mysqli_connect("13.125.210.40", "shavit0423", "0430", "announcement");
$filtered = array(
'title'=>mysqli_real_escape_string($conn,$_POST['title']),
'description'=>mysqli_real_escape_string($conn,$_POST['description']),
	'created'=>mysqli_real_escape_string($conn,$_POST['created'])
);
$sql="
INSERT INTO announcement
(title, description, created)
VALUES(
'{$filtered['title']}','{$filtered['description']}',DATE(NOW())
)";
$result = mysqli_query($conn, $sql);
if($result === false){
	echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요.';
	error_log(mysqli_error($conn));
} else {
echo "<script> 
	document.location.href='announcement.php'; 
	</script>"; 
}
?>