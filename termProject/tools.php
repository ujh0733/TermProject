<script type="text/javascript" src="../jquery-3.3.1.min.js"></script>
<?php
	require_once("member/MemberDAO.php");
	require_once("board/BoardDAO.php");

	define("MAIN_PAGE", "member/login_page.html");

	function getSessionUname(){				//세션에 등록된 유저 이름 리턴
		return isset($_SESSION["user_name"])?$_SESSION["user_name"]:"";
	}

	function getSessionUid(){				//세션에 등록된 유저 아이디 리턴
		return isset($_SESSION["user_id"])?$_SESSION["user_id"]:"";
	}

	function requestValue($val){			//값의 유무 유무여부 판단
		return isset($_REQUEST[$val])?$_REQUEST[$val]:"";
	}

	function backMainPage(){				//로그인 실패시 메인페이지
?>
	<script>
		alert("로그인에 실패했습니다.");
		location.href = "login_page.php";
	</script>
<?php
		exit();
	}

	function sessionFailed(){				//로그아웃 or 세션 만료시 메인페이접속 시 알림
?>
	<script>
		alert("세션이 만료되었습니다. \n다시 로그인 해 주세요.");
		location.href = "login_page.php";
	</script>
<?php	
		exit();
	}

	function sessionKeep(){
		if(!($_SESSION["user_id"]='')){
?>
	<script>
		alert("로그인 중입니다. \n메인페이지로 이동합니다.");
		location.href = "../board/main_page.php";
	</script>
<?php
		}
		exit();
	}

	function insertSuccess(){
?>
	<script>
		alert('성공적으로 가입이 완료되었습니다!\n다시 로그인 해 주세요!');
		location.href = "login_page.php";
	</script>
<?php
		exit();
	}

	function insertWrite(){
?>
	<script>
		alert('글쓰기 완료!');
		location.href = "board_page.php";
	</script>
<?php
	}

	function insertBoardBack(){
?>
	<script type="text/javascript">
		alert('해당 항목을 모두 채워주세요');
		history.back();
	</script>
<?php
	}

	function deleteBoard($page){
?>
	<script>
		alert('삭제 완료!');
		location.href = "board_page.php?page"+<?= $page ?>;
	</script>
<?php
	}
	function updateBoard(){
?>
	<script>
		alert('수정 완료!');
		location.href = "board_page.php";
	</script>
<?php
	}

	function saveImg($img){
		$tmp = 0;
		$upload_succecceded = false;
			if($_FILES[$img]["error"] == UPLOAD_ERR_OK){
				$temp_name = $_FILES[$img]["tmp_name"];
				$file_name = $_FILES[$img]["name"];
				$file_size = $_FILES[$img]["size"];
				$file_type = $_FILES[$img]["type"];

				$name_cut = explode(".", $file_name);//이름 나누기
				$cut_name = $name_cut[0];
				$ext = $name_cut[1];		 //배열중 뒷부분 확장자 저장

				if($ext != "jpeg" && $ext != "jpg" && $ext != "gif" && $ext != "png" ){
					echo "<script>alert('이미지만 업로드 가능합니다.');</script>";
					echo "<script>history.back();</script>";
				}

				if(file_exists("../img/$file_name")){	//같은 이름의 파일이 있으면
					
					$tmp_name = $cut_name.$tmp.".".$ext;
					while(file_exists("../img/$tmp_name")){
						$tmp++;
						$tmp_name = $cut_name.  $tmp.".".$ext;
					}
					$file_name = $tmp_name;	
				}

				$save_name = iconv("cp949", "utf-8", $file_name);	//한글저장

				if(move_uploaded_file($temp_name, "../img/$save_name")){
					$upload_succecceded = true;
				}
			}
		if($upload_succecceded == true)
			return urldecode($save_name);
	}

	function bdUrl($file, $num, $page){	//페이지네이션
		$join = "?";
		if($num){
			$file .= $join . "num=$num";
			$join = "&";
		}
		if($page){
			$file .= $join . "page=$page";
		}

		return $file;
	}
?>	 
	
	<script>
		//프로필사진 클릭시 새창에서 보여주기
		function open_img(url){
			var win = window.open(url, "", "width=500,height=500,cursor='pointer'");
			win.onclick = function(){
				this.close();
			}
		};

		//이미지 미리보기 script코드
		window.onload = function(){
			var image = document.getElementById("profile_picture").onchange = function(){
					readImg('profile_picture', 'example');		
				}
		};

		function readImg(inputId, outputId){
			var file = document.getElementById(inputId).files[0];
			var reader = new FileReader();
			reader.readAsDataURL(file);
			if(!file.type.match("image/*")){
				alert('이미지만 업로드 가능합니다.');
				var tmp = document.getElementById("profile_picture");
				exit();
			}
			reader.onload = function(){
				var output = document.getElementById(outputId);
				output.src = reader.result;
			}
			reader,onerror = function(e){
				alert("읽기 오류:" + e.target.error.code);
				return;
			}
		};
		
		function openDaumZipAddress() {			//주소 찾기 다음api
            new daum.Postcode({
                oncomplete:function(data) {
                    jQuery('#postcode1').val(data.postcode1);
                    jQuery('#postcode2').val(data.postcode2);
                    jQuery('#addr').val(data.address);
                    jQuery('#address_etc').focus();
                    console.log(data);
                }
            }).open();
        }

        function open_window(url){
        	var mail = $("#email").val();
        	if(mail == ""){
        		alert('메일 주소를 입력해 주세요.');
        		exit();
        	}
        	window.open(url+'?email='+mail, "", "width=500,height=500");
        };

        function stopwatch(){
			var timer = 20;			//시간초 지정
			 setInterval(function(){
			 	document.getElementById("date").innerHTML = "";
			 	document.getElementById("date").innerHTML += timer;
			 	if(timer == -1){
			 		alert("지정된 시간이 끝났습니다.\n다시 시도해 주세요");
			 		window.close();
			 	}
			 	timer--;
			 	console.log(timer);
			 }, 1000)
		}

</script>