<?php
include "commonpart.php";
$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "announcement");
$text='';
$filtered_id=mysqli_real_escape_string($conn, $_GET['id']);
if(isset($_GET['id'])){
	$dessql="SELECT * FROM announcement WHERE id={$_GET['id']};";
	$result = mysqli_query($conn, $dessql);
	$rowdes = mysqli_fetch_array($result);
	$desctitle = htmlspecialchars($rowdes['title']);
	$descdesc = htmlspecialchars($rowdes['description']);
	$update_link='<a href="update.php?id='.$_GET["id"].'>update</a>';
	$delete_link='<form action="announce_delete_process.php" method="post" onsubmit="return confirm(\'글을 삭제하시겠습니까?\');">
	<input type="hidden" name="id" value='.$_GET["id"].'>
	<input class="btn btn-outline-secondary" type="submit" value="삭제">
	</form>';
	$text="<p>{$desctitle}</p>
	<p>{$descdesc}</p>
	<p>{$delete_link}</p>";
	$write_btn='';
}else{
	$text='';
	$table='<table class="table table-striped"><thead>
		<tr>
			<th class="text-center">제목</th>
			<th class="text-center">날짜</th>
		</tr>
		</thead>
		<tbody>
		<tr>';
	if(isset($_GET['page'])){
		$page= $_GET['page'];
	}else{
		$page=1;
	}
		$pagesql ="SELECT * FROM announcement;";
		$pageresult=mysqli_query($conn,$pagesql);
		$row_num = mysqli_num_rows($pageresult); //게시글 총 수
		$pagetextnum = 10; //한 페이지에 보여줄 개수
		$block_ct = 5; //블록당 보여줄 페이지 개수
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
			$escaped_created=substr(htmlspecialchars($tablerow['created']),0,10);
			$table .= "<td class='text-center'><a href='announcement.php?id={$tablerow['id']}'>{$escaped_title}</a></td><td class='text-center' width='120px'>{$escaped_created}</td></tr><tr>";
		}
			$table = $table.'</tr>
					</tbody>
				</table>';
			$write_btn='<a class="btn btn-outline-secondary" href="announcement_writing.php">글쓰기</a>';
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
			<?=$table?>
			<!---페이징 넘버 --->
    <div id="page_num">
      <ul class="nav nav-pills justify-content-center">
        <?php
          if($page <= 1)
          { //만약 page가 1보다 작거나 같다면
            echo '<a class="nav-link disabled" tabindex="-1" aria-disabled="true">처음</a>'; //처음 비활성화
          }else{
            echo "<li class='nav_item'><a class='nav-link' href='announcement_copy0.php?page=1'>처음</a></li>"; //아니라면 처음글자에 1번페이지로 갈 수있게 링크
          }
          if($page <= 1){//만약 page가 1보다 작거나 같다면 비활성화
			  echo "<li class='nav_item'><a class='nav-link disabled'>이전</a></li>";
          }else{
          $pre = $page-1; //pre변수에 page-1을 해준다 만약 현재 페이지가 3인데 이전버튼을 누르면 2번페이지로 갈 수 있게 함
            echo "<li class='nav_item'><a class='nav-link' href='announcement_copy0.php?page=$pre'>이전</a></li>"; //이전글자에 pre변수를 링크한다. 이러면 이전버튼을 누를때마다 현재 페이지에서 -1하게 된다.
          }
          for($i=$block_start; $i<=$block_end; $i++){ 
            //for문 반복문을 사용하여, 초기값을 블록의 시작번호를 조건으로 블록시작번호가 마지박블록보다 작거나 같을 때까지 $i를 반복시킨다
            if($page == $i){ //만약 page가 $i와 같다면 
              echo "<li class='nav_item'><a class='nav-link active'>$i</a></li>"; //현재 페이지에 해당하는 번호에 active
            }else{
              echo "<li class='nav_item'><a class='nav-link' href='announcement_copy0.php?page=$i'>$i</a></li>"; //아니라면 $i
            }
          }
          if($page >= $total_page){ //만약 현재 블록이 블록 총개수보다 크거나 같다면 disabled
			  echo "<li class='nav_item'><a class='nav-link disabled'>다음</a></li>";
          }else{
            $next = $page + 1; //next변수에 page + 1을 해준다.
            echo "<li class='nav_item'><a class='nav-link' href='announcement_copy0.php?page=$next'>다음</a></li>"; //다음글자에 next변수를 링크한다. 현재 4페이지에 있다면 +1하여 5페이지로 이동하게 된다.
          }
          if($page >= $total_page){ //만약 page가 페이지수보다 크거나 같다면
            echo "<li class='nav_item'><a class='nav-link disabled' tabindex='-1' aria-disabled='true'>마지막</a></li>"; //마지막 글자에 긁은 빨간색을 적용한다.
          }else{
            echo "<li class='nav_item'><a class='nav-link' href='announcement_copy0.php?page=$total_page'>마지막</a></li>"; //아니라면 마지막글자에 total_page를 링크한다.
          }
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