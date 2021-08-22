<?php
include "commonpart.php";
$conn = mysqli_connect("localhost", "shavit0423", "0430", "announcement");
$text='';
$filtered_id=mysqli_real_escape_string($conn, $_GET['id']);
if(isset($_GET['id'])){
	$dessql="SELECT * FROM announcement WHERE id={$_GET['id']};";
	$result = mysqli_query($conn, $dessql);
	$rowdes = mysqli_fetch_array($result);
	$desctitle = htmlspecialchars($rowdes['title']);
	$descdesc = htmlspecialchars($rowdes['description']);
	$text="<p>{$desctitle}</p>
	<p>{$descdesc}</p>";
	$update_link='<a href="update.php?id='.$_GET["id"].'">update</a>';
	$delete_link='<form action="process_delete.php" method="post">
	<input type="hidden" name="id" value="'.$_GET['id'].'">
	<input type="submit" value="delete">
	</form>
	';
	$write_btn='';
}else{
	$text='';
	$loadsql="SELECT * FROM announcement;";
	$result=mysqli_query($conn, $loadsql);
	$list='<table class="table table-striped"><thead>
		<tr>
			<th>번호</th>
			<th>제목</th>
			<th>날짜</th>
		</tr>
		</thead>
		<tbody>
		<tr>';
	$write_btn='<a class="btn btn-outline-secondary">글쓰기</a>';
	while($row = mysqli_fetch_array($result)){
		$escaped_id=htmlspecialchars($row['id']);
	$escaped_title=htmlspecialchars($row['title']);
	$escaped_created=htmlspecialchars($row['created']);
	$list = $list."<th>{$escaped_id}</th><th><a href='announcement.php?id={$row['id']}'>{$escaped_title}</a></th><th>{$escaped_created}</th></tr><tr>";
}
	$list = $list.'</tr>
			</tbody>
		</table>';
}
?>
<!DOCTYPE html>
<html lang="ko">
	<?=$headpart?>
	<body>
		<?=$navbar?>
		<ul class="nav justify-content-center">
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="announcement.php">공지사항</a>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">메뉴</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="inquiry.php">식수조사</a>
				</li>
		</ul>
		<div class="container">
			<?=$text?>
			<?=$list?>
			<?=$write_btn?>
		</div>
			 
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
			crossorigin="anonymous"
		></script>
	</body>
</html>