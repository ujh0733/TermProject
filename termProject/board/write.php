<?php
	require_once('../tools.php');
	session_start();

	$bdao = new BoardDao();

	$cnt = $bdao->getBoardCnt();
	$count = intval($cnt);

	$board_title = requestValue("title");
	$board_context = requestValue("context");
	$board_writer = requestValue("writer");
	$board_opener = requestValue("opener");

	$start_year = requestValue("start_year");
	$start_month = requestValue("start_month");
	$start_day = requestValue("start_day");
	$start_term = $start_year."-".$start_month."-".$start_day;

	$end_year = requestValue("end_year");
	$end_month = requestValue("end_month");
	$end_day = requestValue("end_day");
	$end_term = $end_year."-".$end_month."-".$end_day;

	$board_genre = requestValue("genre");
	$board_place = requestValue("place");
	$board_time = requestValue("time");
	$board_price = requestValue("price");
	$board_viewingClass = requestValue("viewingClass");

	$board_picture = "board_picture";
	

	if($board_title && $board_context && $board_writer){
		$board_picture = saveImg($board_picture);
		$bdao->writeBoard($count+1, $board_title, $board_context, $board_writer, $board_opener, $start_term, $end_term, $board_place, $board_time, $board_genre, $board_price, $board_viewingClass, $board_picture);
		insertWrite();
	}else{
		insertBoardBack();
	}

?>