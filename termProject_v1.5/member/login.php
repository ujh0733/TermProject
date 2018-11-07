<?php
	require_once("../tools.php");

	session_start();

	$id = requestValue("id");
	$pwd = requestValue("pwd");

	$board_num = requestValue("board_num");
	$page = requestValue("page");

	$login_chk = getSessionUid();

	$mdao = new MemberDao();
	$memberCheck = $mdao->getMember($id);

	$memberIP = isset($memberCheck['user_ip'])?$memberCheck['user_ip']:"";

	$nowIP = $_SERVER['REMOTE_ADDR'];

	if($memberCheck && $memberCheck["user_pwd"] == $pwd){

		if($memberIP && $memberIP != $nowIP){
?>
			<script>
				alert('현재 로그인중인 회원입니다.');
				window.opener.document.close();
			</script>
<?php
			exit();
		}
		
		$_SESSION["user_id"] = $id;
		$_SESSION["user_name"] = $memberCheck["user_name"];
		$_SESSION["user_profile"] = $memberCheck["user_profile"];
		$mdao->insertIP($id, $nowIP);

		if($board_num && $page){
?>
		<script>
			alert('로그인 성공!');
			location.href="../board/board_view.php?board_num=<?= $board_num ?>&page=<?= $page ?>";
		</script>
<?php
		}
?>
		<script>
			alert('로그인 성공!');
			window.opener.parent.location.reload();
			window.close();
			
		</script>
<?php
	}else{
		backMainpage();
	}
?>