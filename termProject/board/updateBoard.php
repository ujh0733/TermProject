<?php
	require_once('../tools.php');

	session_start();

	$board_num = requestValue('num');
	
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

	$bdao = new BoardDao();

	if($board_title && $board_context){

		$board_picture = saveImg($board_picture);
		if($board_picture == ""){
			$board_picture = requestValue("no_select");
		}

		$bdao->updateBoard($board_num, $board_title, $board_context, $board_writer, $board_opener, $start_term, $end_term, $board_place, $board_time, $board_genre, $board_price, $board_viewingClass, $board_picture);
			
		updateBoard();
	}else{
?>
	<script>
		alert("항목을 모두 채워 주세요");
		history.back();
	</script>
<?php
	}

?>