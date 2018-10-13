<?php
	/*
		$upload_succeceded = false;
		if(웹서버가 클라이언트가 전송한 파일을 정상적으로 처리햇다면){
			$temp_name = 서버의 임시폴더에 저장된 클라이언트 전송 파일 이름;
			$file_name = 클라이언트가 전송한 파일 이름;
			$file_size = 클라이언트가 전송한 파일의 크기;
			$file_type = 클라이언트가 전송한 파일의 타입
			
			$save_name = 클라이언트가 전송할 파일 이름의 인코딩으 cp949로 변경한다.
						-윈도우 운영체제에서 한글 파일명이 깨지지 않도록 하는 작업.
					
			서버 컴퓨터의 임시 폴더에 저장된 클라이언트 전송 파일을 우리가 원하는 files폴더하위의 $save_name이란 이름으로 이동시킨다.
			
			만약 위의 작업이 성공하면  $upload_succeceded = true;
		*/
			$upload_succecceded = false;
			if($_FILES["upload"]["error"] == UPLOAD_ERR_OK){
				$temp_name = $_FILES["upload"]["tmp_name"];
				$file_name = $_FILES["upload"]["name"];
				$file_size = $_FILES["upload"]["size"];
				$file_type = $_FILES["upload"]["type"];
				
				$save_name = iconv("utf-8", "cp949", $file_name);
				
				if(move_uploaded_file($temp_name, "img/$save_name")){
					$upload_succecceded = true;
				}
			}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<title> Title </title>
</head>

<body>
	<?php if($upload_succecceded) : ?>
		업로드 성공<br>
		파일 이름 : <?= $file_name ?><br>
		파일 크기 : <?= $file_size ?>bytes<br>
		파일 타입 : <?= $file_type ?><br>
		임시파일 명 : <?= $temp_name ?><br>
		저장파일 명 : <?= $save_name ?><br>
	<?php else : ?>
		업로드 실패 <br>
	<?php endif ?>
</body>
</html>
