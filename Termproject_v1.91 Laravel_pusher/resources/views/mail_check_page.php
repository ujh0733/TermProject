<script>
	window.onbeforeunload = function(){		//창 닫을시 실행
		window.opener.mailOver();
	}

	var now = window.opener.overlapChecked();
		if(now == false){
			alert('메일 인증이 진행중입니다....');
			window.close();
			exit();
		}

	window.opener.mailOverlap();

	function stopwatch(){
    var timer = 20;         //시간초 지정
    setInterval(function(){
    $("#date").html('');
    $("#date").html(timer);
    if(timer == -1){
        alert("지정된 시간이 끝났습니다.\n다시 시도해 주세요");
        window.close();
    }
    timer--;
    console.log(timer);
    }, 1000)
}
</script>
<script src="js/jquery-3.3.1.min.js"></script>
<?php
	$user_email = isset($_REQUEST['email'])?$_REQUEST['email']:"";
?>
<!DOCTYPE html>
<html>
<head>
	
	<style type="text/css">
	.container{
		display: inline-flex;
		margin: 0 auto;
		float: left;
	}
	#date{
		width: 30px;
		height: 40px;
		border: solid 1px black;
		color: red;
		text-align: center;
	}
	#main_logo{
    width: 120px;
    height: 120px;
    position: relative;
    left: 38%;
    margin-bottom: 5px;
  }
	</style>
</head>
<body onload="stopwatch();">
	
	<div id="mailer">
	
		<?php require_once('mail_send_signUp.php') ?>
	
	</div>
		<script>
			$("#mailer").html('');
		</script>
	
	<div>
	 <img src="img/page/main1.png" id="main_logo">
	 </div>
	<h1>메일로 발송된 코드를 입력해 주세요</h1>
		<div class="container">
			<input type="text" name="user_result" id="user_result">
			<input type="hidden" name="result" id="result" value="<?= $check ?>">
			<div id="date"></div>
			<input type="button" name="result" class="btn btn-primary" onclick="check_code();" value="인증하기">
		</div>
</body>
	<script type="text/javascript">

		function check_code(){
			var user_result = $("#user_result").val();
			var result = $("#result").val();
			var tmp = "메일인증 미완료";
			if(result == user_result){
				alert('인증이 완료되었습니다.');
				tmp = "메일인증 완료";
				change_check(tmp, "green");
			}else{
				alert('인증 번호가 틀립니다. \n 다시 시도해 주세요');
				change_check(tmp, "red");
			}
			window.close();
		}

		function change_check(txt, txtColor){
			window.opener.document.getElementById("email_result").value = txt;
			window.opener.document.getElementById("email_result").style = "color:"+txtColor+"; border:none;";
		}

		

	</script>
</html>