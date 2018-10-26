<?php
require_once('PHPMailer/PHPMailerAutoload.php');
	
	function get_random_string($type = '', $len = 5) {		//랜덤변수 생성
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numeric = '0123456789';
    $special = '`~!@#$%^&*()-_=+\\|[{]};:\'",<.>/?';
    $key = '';
    $token = '';
    if ($type == '') {
        $key = $lowercase.$uppercase.$numeric;
    } else {
        if (strpos($type,'09') > -1) $key .= $numeric;
        if (strpos($type,'az') > -1) $key .= $lowercase;
        if (strpos($type,'AZ') > -1) $key .= $uppercase;
        if (strpos($type,'$') > -1) $key .= $special;
    }
    for ($i = 0; $i < $len; $i++) {
        $token .= $key[mt_rand(0, strlen($key) - 1)];
    }
    return $token;
	}

	$check = get_random_string('azAz09&');


	$mail = new PHPMailer(); 

		$mail->ContentType = "text/html";  

		//전송시 한글 깨짐 방지
		$mail->Charset = 'UTF-8'; 
		$mail->SMTPSecure = 'ssl'; 

		$mail->isSMTP(); 
		$mail->SMTPDebug = 2; 

		$subject = "Ticket Wave의 회원가입 이메일 인증 코드입니다.";
		$mail_from  = "ujh0733@naver.com";
		$mail_to  = $user_email;

		//제목과 보내는 사람 이름 등등은 직접적으로 인코딩 변경
		$subject = "=?UTF-8?B?".base64_encode($subject)."?="."\r\n"; 
		$mail_from = "=?UTF-8?B?".base64_encode($mail_from )."?="."\r\n"; 
		$mail_to = "=?UTF-8?B?".base64_encode($mail_to)."?="."\r\n";

		$message =  "해당 문자를 홈페이지에 입력해 주세요<br>$check";
		  
		$mail->Debugoutput = 'html'; 
		  
		$mail->Host = 'smtp.naver.com'; 
		  
		$mail->Port = 465; 
		$mail->SMTPAuth = true; 
		  
		$mail->Username = "ujh0733"; 
		  
		$mail->Password = "dnptmffl1!"; 
		  
		$mail->setFrom('ujh0733@naver.com', $mail_from); 
		  
		$mail->addReplyTo('ujh0733@naver.com', $mail_from); 
		  
		$mail->addAddress($user_email, $mail_to); 
		  
		$mail->Subject = $subject; 
		  
		$mail->msgHTML($message, dirname(__FILE__)); 
		  
		$mail->AltBody = 'This is a plain-text message body'; 
		  
		if (!$mail->send()) { 
		    echo "Mailer Error: " . $mail->ErrorInfo; 
		} else { 
		    echo "Message sent!"; 
		}
?>