<?php
	require_once('MemberDAO.php');
	require_once('../tools.php');

	$mdao = new MemberDao();

	session_start();

	$nowId = getSessionUid();
	$mdao->insertIP($nowId, "");


	session_destroy();
?>

<meta http-equiv="refresh" content="0;url=../board/main_page.php" />