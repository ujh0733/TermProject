		//프로필사진 클릭시 새창에서 보여주기
		function open_img(url){
			var win = window.open(url, "", "width=500,height=500,cursor='pointer'");
			win.onclick = function(){
				this.close();
			}
		};

		function login_page(){
			var left = document.body.clientWidth/2+"px";
			var top = screen.height/2+"px";

			window.open("login_page", "", "width=500, height=700, left="+left+", top="+top+"");
		}

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

        //글쓰기에서 지도보기
        function open_maps(){
        	window.open("theaterMaps","","width=700, height=500");
        }
        //board_view에서 지도보기
        function open_Theater(num){
        	window.open('viewTheaterMaps?board_num='+num,"", "width=700, height=500");
        }

        function stopwatch(){
			var timer = 20;			//시간초 지정
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

		function remainSeat(num){
			window.open("remainSeat?num="+num, "", "width=700, height=500");
		}