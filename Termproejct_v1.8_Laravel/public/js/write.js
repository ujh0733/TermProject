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
  function open_maps(){
    window.open("theaterMaps","","width=700, height=500");
  }