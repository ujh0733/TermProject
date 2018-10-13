<?php
	require_once('tools.php');


	session_start();
	$user_id = getSessionUid();
	$board_num = requestValue('num');
	$board_writer = requestValue('id');

	$bdao = new BoardDao();
	
	if($user_id == $board_writer){
			$bdao->deleteBoard($board_num);
			$bdao->sortBoard($board_num);

			deleteBoard();
	}else{
?>
	<script>
		alert('작성자만 삭제할 수 있습니다!');
		history.back();
	</script>
<?php
	}

?>