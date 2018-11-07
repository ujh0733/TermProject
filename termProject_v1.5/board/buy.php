<?php
	require_once("../tools.php");
	session_start();

	$board_num = requestValue("num");

	$bdao = new BoardDAO();
	$board = $bdao->getBoard($board_num);
?>
<!DOCTYPE html>
<html>
<head>
	<title>티켓 예매</title>
	<?php require_once("../html_header.php")?>
</head>
<body>
	<?php require_once("../menu.php")?>

	<div class="jumbotron">
		<h3>티켓 예매</h3>
		<hr>
		<div class="info2">
			<img src="../img/<?= $board['board_picture']?>">
		</div>
	</div>

	<?php require_once("../footer.php")?>

</body>
</html>