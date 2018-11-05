<?php
  //ckditor의 이미지 업로드를 위한 부분
    if($_FILES["upload"]["error"] == UPLOAD_ERR_OK){
      $tnamePicture = $_FILES["upload"]["tmp_name"];
      $fnamePicture = $_FILES["upload"]["name"];
      $url = '../img/'.$fnamePicture;//경로 지정 중요
      $save_namePicture = iconv("utf-8","cp949",$fnamePicture);
      if(move_uploaded_file($tnamePicture,"files/$save_namePicture")){
        echo '{"filename" : "'.$fnamePicture.'", "uploaded" : 1, "url":"'.$url.'"}';
      }else{
        echo "<script>alert('오류');</script>";
      }
    }else{
      echo "<script>alert('오류');</script>";
    }
    //CKeditor4버전 이상 부터는 콜백 함수가 아닌 json으로 보내주기 때문에 성공했을시 다시 editor로 넘겨줄 것을 echo 에 찍혀 있는 것처럼 보내야 함
  
?>