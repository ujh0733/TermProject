<?php
	require_once("../tools.php");

	session_start();

	$id = requestValue("id");
	$pwd = requestValue("pwd");

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
				location.href = "login_page.php";
			</script>
<?php
			exit();
		}
		
		$_SESSION["user_id"] = $id;
		$_SESSION["user_name"] = $memberCheck["user_name"];
		$_SESSION["user_profile"] = $memberCheck["user_profile"];
		$mdao->insertIP($id, $nowIP);
?>
		<script>
			location.href = "../board/main_page.php";
		</script>
<?php
	}else{
		backMainpage();
	}
?>