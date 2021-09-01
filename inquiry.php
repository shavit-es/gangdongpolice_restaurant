<script
  src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
  integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
  crossorigin="anonymous"></script>
<?php
include "commonpart.php";
$conn = mysqli_connect("localhost", "shavit0423", "hyun0430!@my", "numeat");
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    if ( !empty($_POST['조식']) && ( $_POST['조식'] == '조식' ) ) {
        $sql = "UPDATE numeat SET num_eat=(num_eat+1) WHERE meal='breakfast';";
        $result=mysqli_query($conn, $sql);
    }
	if ( !empty($_POST['중식']) && ( $_POST['중식'] == '중식' ) ) {
        $sql = "UPDATE numeat SET num_eat=(num_eat+1) WHERE meal='lunch';";
        $result=mysqli_query($conn, $sql);
    }
	if ( !empty($_POST['석식']) && ( $_POST['석식'] == '석식' ) ) {
        $sql = "UPDATE numeat SET num_eat=(num_eat+1) WHERE meal='dinner';";
        $result=mysqli_query($conn, $sql);
    }
}
$sqlloadb="SELECT num_eat from numeat WHERE meal='breakfast';";
$resultb=mysqli_query($conn, $sqlloadb);
$rowb=mysqli_fetch_array($resultb)['num_eat'];
$sqlloadl="SELECT num_eat from numeat WHERE meal='lunch';";
$resultl=mysqli_query($conn, $sqlloadl);
$rowl=mysqli_fetch_array($resultl)['num_eat'];
$sqlloadd="SELECT num_eat from numeat WHERE meal='dinner';";
$resultd=mysqli_query($conn, $sqlloadd);
$rowd=mysqli_fetch_array($resultd)['num_eat'];
?>
<!DOCTYPE html>
<html lang="ko">
	<head>
		<?=$headpart?>
	</head>
	<body>
		<?=$navbar?>
		<p class="text-center choose">
			금일 식사하실 끼니를 선택해주세요.
		</p>

		<div class="d-flex justify-content-around p-3 bd-highlight">
			<!-- <button type="button" class="btn btn-primary btn-sm" onclick="breakfast()">조식</button> -->
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
				<input type="submit" value="조식" name="조식" class="inquiry_btn btn btn-primary btn-sm" />
				<p class="text-center"><?=$rowb?></p>
			</form>
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
				<input type="submit" value="중식" name="중식" class="inquiry_btn btn btn-primary btn-sm" />
				<p class="text-center"><?=$rowl?></p>
			</form>
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
				<input type="submit" value="석식" name="석식" class="inquiry_btn btn btn-primary btn-sm" />
				<p class="text-center"><?=$rowd?></p>
			</form>
		</div>
		<script>
			src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js';
			integrity = 'sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj';
			crossorigin = 'anonymous';
		</script>
	</body>
</html>