<?php
	require_once('../tools.php');

	session_start();
	$bdao = new BoardDao();

	$check = requestValue("check");

	if($check){
		$size = sizeof($check);
		$size -= 1;
		$check[$size] = (int)preg_replace("/[^0-9.]/", "", $check[$size]);	//마지막 문자에 쉼표 지우기
		$lastNum = $check[$size];

		$num = "";	//sql in문에 넣기 위함

		foreach($check as $row){
			$num = $num.$row;

		}

		$bdao->manyDeleteBoard($num);
		$bdao->sortBoard($lastNum);
?>
		<script type="text/javascript">
			alert('해당 항목들을 삭제하였습니다!');
			location.href="board_page.php";
			exit();
		</script>
<?php
	}


	$page = requestValue("page");

	$user_id = getSessionUid();
	$board_num = requestValue('num');
	$board_writer = requestValue('id');

	
	
	if($user_id == $board_writer){
			$bdao->deleteBoard($board_num);
			$bdao->sortBoard($board_num);

			deleteBoard($page);
	}else{
?>
	<script>
		alert('작성자만 삭제할 수 있습니다!');
		history.back();
	</script>
<?php
	}

?>