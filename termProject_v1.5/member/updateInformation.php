<?php
	require_once("../tools.php");

	session_start();
	
	$session_uid = getSessionUid();

	$user_id = requestValue("user_id");
	$user_pwd = requestValue("user_pwd");
	$user_name = requestValue("user_name");
	$user_email = requestValue("user_email");
	$user_phone = requestValue("user_phone");
	$user_profile = "user_profile";

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

	if($session_uid != $user_id){
?>
	<script>
		alert('잘못된 접근입니다!');
		history.back();
	</script>
<?php
	exit();
	}

	$user_profile = saveImg($user_profile);

	if($user_profile == ""){
		$user_profile = requestValue("no_select");
	}

	$mdao->updateMember($user_id, $user_pwd, $user_name, $user_email, $user_phone, $user_birth, $user_profile, $postcode, $user_addr);

	$_SESSION["user_name"] = $user_name;
	$_SESSION["user_profile"] = $user_profile;
?>
<script>
	alert('회원 정보 변경 완료!');
	location.href = "../board/main_page.php";
</script>
<?php
	exit();
?>