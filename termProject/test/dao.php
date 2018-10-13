<?php
	require_once('../tools.php');

	$bdao = new BoardDao();

	$board_info = $bdao->getBoard(1);

	foreach ($board_info as $row) {
		echo $row;
	}
?>
