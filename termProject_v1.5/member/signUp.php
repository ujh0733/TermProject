<?php
	require_once("../tools.php");
	require_once("MemberDAO.php");
	
	/*
	$mail_check = requestvalue("mail_result_check");
	if($mail_check == false){
?>
	<script>
		alert('메일 인증을 진행해 주세요.');
		history.back();
		exit();
	</script>
<?php
		exit();
	}*/

	$user_id = requestValue("user_id");
	$user_pwd = requestValue("user_pwd");
	$user_name = requestValue("user_name");
	$user_email = requestValue("user_email");
	$user_phone = requestValue("user_phone");

	$year = requestValue("year");
	$month = requestValue("month");
	$day = requestValue("day");
	$user_birth = $year."-".$month."-".$day;

	$postcode1 = requestValue("postcode1");
	$postcode2 = requestValue("postcode2");
	$postcode = $postcode1."-".$postcode2;

	$addr = requestValue("addr");
	$addr_etc = requestValue("addr_etc");
	$user_addr = $addr."~".$addr_etc;

	

	$mdao = new MemberDAO();

	if($mdao->getMember($user_id)){
?>
	<script>
		alert('아이디가 중복되었습니다.\n다시 입력해 주세요');
		history.back();
	</script>
<?php

	}else{
	$mdao->insertMember($user_id, $user_pwd, $user_name, $user_email, $user_phone, $user_birth, $postcode, $user_addr);
?>

	<div id="mailer">
		<?php require_once("../mail_send.php"); ?>
	</div>
	<script type="text/javascript">
		$("#mailer").html('');
	</script>
<?php
	insertSuccess();
	}
?>