<?php
	require_once('../tools.php');
	session_start();

	$bdao = new BoardDao();

	$board_num = requestValue('board_num');
	$page = requestValue("page");

	$bdao->increaseViewed($board_num);

?>
<script type="text/javascript">
	location.href = "board_view.php?board_num=<?= $board_num ?>&page=<?= $page ?>";
</script>