<?php
require_once('js/PHPMailer/PHPMailerAutoload.php');

	$mail = new PHPMailer(); 

		$mail->ContentType = "text/html";  

		//전송시 한글 깨짐 방지
		$mail->Charset = 'UTF-8'; 
		$mail->SMTPSecure = 'ssl'; 

		$mail->isSMTP(); 
		$mail->SMTPDebug = 2; 

		$subject = "Ticket Wave의 회원가입을 축하드립니다.";
		$mail_from  = "TicketWave@naver.com";
		$mail_to  = $user_email;

		//제목과 보내는 사람 이름 등등은 직접적으로 인코딩 변경
		$subject = "=?UTF-8?B?".base64_encode($subject)."?="."\r\n"; 
		$mail_from = "=?UTF-8?B?".base64_encode($mail_from )."?="."\r\n"; 
		$mail_to = "=?UTF-8?B?".base64_encode($mail_to)."?="."\r\n";

		$message =  "Ticket Wave의 회원가입을 축하드립니다!!\n 이제 다양한 티켓을 구매하실 수 있습니다!!";
		  
		$mail->Debugoutput = 'html'; 
		  
		$mail->Host = 'smtp.naver.com'; 
		  
		$mail->Port = 465; 
		$mail->SMTPAuth = true; 
		  
		$mail->Username = "ujh0733"; 
		  
		$mail->Password = "dnptmffl1!"; 
		  
		$mail->setFrom('ujh0733@naver.com', $mail_from); 
		  
		$mail->addReplyTo('ujh0733@naver.com', $mail_from); 
		  
		$mail->addAddress($user_email, $mail_to); 
		  
		//$mail->Subject = $subject; 
		  
		//$mail->msgHTML($message, dirname(__FILE__)); 
		  
		$mail->AltBody = 'This is a plain-text message body'; 
		  
		if (!$mail->send()) { 
		    echo "Mailer Error: " . $mail->ErrorInfo; 
		} else { 
		    echo "Message sent!"; 
		}
?>