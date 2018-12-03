<?php
	$tmp = 0;
		$upload_succecceded = false;
			if($_FILES['upload']["error"] == UPLOAD_ERR_OK){
				$temp_name = $_FILES['upload']["tmp_name"];
				$file_name = $_FILES['upload']["name"];
				$file_size = $_FILES['upload']["size"];
				$file_type = $_FILES['upload']["type"];

				$name_cut = explode(".", $file_name);//이름 나누기
				$cut_name = $name_cut[0];
				$ext = $name_cut[1];		 //배열중 뒷부분 확장자 저장

				

				if($ext != "jpeg" && $ext != "jpg" && $ext != "gif" && $ext != "png" ){
					echo "<script>alert('이미지만 업로드 가능합니다.');</script>";
					echo "<script>history.back();</script>";
				}

				if(file_exists("img/$file_name")){	//같은 이름의 파일이 있으면
					
					$tmp_name = $cut_name.$tmp.".".$ext;
					while(file_exists("img/$tmp_name")){
						$tmp++;
						$tmp_name = $cut_name.  $tmp.".".$ext;
					}
					$file_name = $tmp_name;	
				}

				$save_name = iconv("cp949", "utf-8", $file_name);	//한글저장

				$url = "img/".$save_name;

				if(move_uploaded_file($temp_name, "img/$save_name")){
					$upload_succecceded = true;
					echo '{"filename" : "'.$save_name.'", "uploaded" : 1, "url":"'.$url.'"}';
				}else{
					echo "<script>alert('업로드 실패');</script>";
				}
			}
?>