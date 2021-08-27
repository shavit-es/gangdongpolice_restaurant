<?php
include "commonpart.php";
$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "announcement"); //mysql 서버 연결
$text='';
if(isset($_GET['id'])){ //id값이 존재한다면 ?id=*
	$filtered_id=htmlspecialchars($_GET['id']); //보안(XSS) 공격 방지
	$dessql="SELECT * FROM announcement WHERE id={$filtered_id};"; //id값에 해당하는 행 받아오기
	$result = mysqli_query($conn, $dessql);
	$rowdes = mysqli_fetch_array($result);
	$desctitle = htmlspecialchars($rowdes['title']);
	$descdesc = htmlspecialchars($rowdes['description']);
	$modify_link='<a class="btn btn-outline-secondary" href="announcement_modifying.php?id='.$filtered_id.'">수정</a>'; //수정 버튼
	$delete_link='<form action="announce_delete_process.php" method="post" onsubmit="return confirm(\'글을 삭제하시겠습니까?\');">
	<input type="hidden" name="id" value='.$filtered_id.'>
	<input class="btn btn-outline-secondary" type="submit" value="삭제">
	</form>'; //삭제 버튼
	$page=htmlspecialchars($_GET["page"]);
	$list_link='<a class="btn btn-outline-secondary" href="announcement.php?page='.$page.'">목록</a>';
	$text="<div class='ms-2 me-2'><p class='desctitle mt-3'>{$desctitle}</p>
	<p class='descdesc mt-1'>{$descdesc}</p>
	<div class='d-flex justify-content-between mt-5'><div>{$modify_link}</div><div>{$list_link}</div><div>{$delete_link}</div>
	</div>
	</div>"; //만약 id 값이 있을 때 출력할 게시글 제목 및 내용, 수정버튼과 삭제버튼
	$write_btn=''; //id 값이 있을 때는 글쓰기 버튼 없음.
}else{
	$text=''; //id 값이 없을 때는 글 내용이 없으므로 빈 칸.
	$table='<table class="table table-striped"><thead>
		<tr>
			<th class="text-center" scope="col">제목</th>
			<th class="text-center" scope="col">날짜</th>
		</tr>
		</thead>
		<tbody>
		<tr>'; //table 기본 뼈대
	if(isset($_GET['page'])){//페이지 값 확인
		$page= $_GET['page'];
	}else{
		$page=1;
	}
	$pagesql ="SELECT * FROM announcement;";
	$pageresult=mysqli_query($conn,$pagesql);
	$row_num = mysqli_num_rows($pageresult); //DB에 있는 데이터(행) 수
	$pagetextnum = 5; //한 페이지에 보여줄 개수
	$block_ct = 5; //페이지숫자를 한 블록에 몇 개 까지 보여줄 지
	$block_num = ceil($page/$block_ct); // 현재 페이지의 블록 구하기
	$block_start = (($block_num - 1) * $block_ct) + 1;
	$block_end = $block_start + $block_ct-1;// 블록의 마지막 페이지 수 구하기
	$total_page = ceil($row_num / $pagetextnum);
	if ($block_end > $total_page){
		$block_end=$total_page;
	}
	$total_block = ceil($total_page/$block_ct);
	$start_num = ($page-1) * $pagetextnum;
	$pagesql2 = "SELECT * FROM announcement order by id desc LIMIT $start_num, $pagetextnum";
	$pageresult2=mysqli_query($conn, $pagesql2);
	while($tablerow = mysqli_fetch_array($pageresult2)){
		$escaped_title=htmlspecialchars($tablerow['title']);
		$escaped_id=htmlspecialchars($tablerow['id']);
		$escaped_created=substr(htmlspecialchars($tablerow['created']),2,8);
		$table .= "<td class='text-center'><a href='announcement.php?page={$page}&id={$escaped_id}' class='link-secondary rows'>{$escaped_title}</a></td><td class='text-center' width='100px'><a href='announcement.php?id={$escaped_id}' class='link-secondary date'>{$escaped_created}</a></td></tr><tr>";
	}
	$table = $table.'</tr></tbody></table>';
	$write_btn='<a class="btn btn-outline-secondary mt-4" href="announcement_writing.php">글쓰기</a>';
	}
?>
<!DOCTYPE html>
<html lang="ko">
	<?=$headpart?>
	<body>
		<?=$navbar?>
		<div class="container">
			<?=$text?>
			<?=$table?>
			<div id="page_num">
			  <ul class="nav nav-pills justify-content-center">
				<?php
					if(isset($_GET['id'])==false){
					  if($page <= 1)
					  { //만약 page가 1보다 작거나 같다면
						echo '<a class="nav-link disabled" tabindex="-1" aria-disabled="true">처음</a>'; //처음 비활성화
					  }else{
						echo "<li class='nav_item'><a class='nav-link' href='announcement.php?page=1'>처음</a></li>"; //처음이 1번 페이지로 링크
					  }
					  if($page <= 1){//만약 page가 1보다 작거나 같다면 이전 버튼 비활성화
						  echo "<li class='nav_item'><a class='nav-link disabled'>이전</a></li>";
					  }else{
					  $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
						echo "<li class='nav_item'><a class='nav-link' href='announcement.php?page=$pre'>이전</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
					  }
					  for($i=$block_start; $i<=$block_end; $i++){ 
						//for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
						if($page == $i){ //만약 page가 $i와 같다면 
						  echo "<li class='nav_item'><a class='nav-link active'>$i</a></li>"; //현재 페이지에 해당하는 번호에 active
						}else{
						  echo "<li class='nav_item'><a class='nav-link' href='announcement.php?page=$i'>$i</a></li>"; //아니라면 $i
						}
					  }
					  if($page >= $total_page){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 disabled
						  echo "<li class='nav_item'><a class='nav-link disabled'>다음</a></li>";
					  }else{
						$next = $page + 1; //next변수에 page + 1을 해준다.
						echo "<li class='nav_item'><a class='nav-link' href='announcement.php?page=$next'>다음</a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
					  }
					  if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
						echo "<li class='nav_item'><a class='nav-link disabled' tabindex='-1' aria-disabled='true'>마지막</a></li>"; //마지막 글자에 긁은 빨간색을 적용한다.
					  }else{
						echo "<li class='nav_item'><a class='nav-link' href='announcement.php?page=$total_page'>마지막</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
					  }}
				?>
			  </ul>
			</div>
			<?=$write_btn?>
		</div>
			 
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
			crossorigin="anonymous"
		></script>
	</body>
</html>