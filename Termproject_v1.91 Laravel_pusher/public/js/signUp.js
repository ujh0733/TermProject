//메일인증창 여러개 띄우기 방지
var overlapCheck = true;

function mailOverlap(){
    overlapCheck = false
}

function overlapChecked(){
    return overlapCheck;
}
      
function mailOver(){
    overlapCheck = true;
}

function openDaumZipAddress() {     //주소 찾기 다음api
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
}

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


