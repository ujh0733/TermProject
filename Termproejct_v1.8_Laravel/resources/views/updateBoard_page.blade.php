@extends('layout.app')

@section('head')
  <link rel="stylesheet" type="text/css" href="css/board.css">
  <style type="text/css">
    #context{
      height: 300px;
    }
    #example{
        width: 300px;
        height: 355px;
        margin-top: 5px;
      }
      #preview{
        margin-top: 5px;
      }
    
  </style>
  <script src="js/ckeditor/ckeditor.js"></script>
  <script type="text/javascript">
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
  </script>
@endsection

@section('content')

  <div class="jumbotron">
    <form action="updateBoard" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="board_num" value="{{$board_num}}">
      <div class="alert alert-primary" role="alert">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" value="{{$board_info->board_title}}">
      </div>

      <!--Value값은 사용자 아이디가 들어가야 함 -->
      <input type="hidden" name="writer" value="{{$board_writer}}">

      <input type="hidden" name="num" value="{{$board_num}}">

      <div class="alert"> <!--개최자 입력-->
        <label for="opener">Opener</label>
        <input type="text" class="form-control" id="opener" placeholder="Enter Opener" name="opener" value="{{$board_info->board_opener}}" required>
      </div>

   <!--공연 시작/종료 날짜-->
    <div class="alert">
        <p>공연 개시 일자</p>
            <div class="row">
              
              <div>
                <label for="start_year">Year</label>
                <select class="custom-select d-block w-100" id="start_year" name="start_year" required>
                  <option value="{{$start_year}}">{{$start_year}}</option>
                    @for($i = 2010; $i < 2020; $i++)
                      <option>{{$i}}</option>
                    @endfor
                </select>
                <div class="invalid-feedback">
                  Please select a valid Year.
                </div>
              </div>

              <div>
                <label for="start_month">Month</label>
                <select class="custom-select d-block w-100" id="start_month" name="start_month" required>
                  <option value="{{$start_month}}">{{$start_month}}</option>
                    @for($i = 1; $i < 13; $i++)
                      <option>{{$i}}</option>
                    @endfor
                </select>
                <div class="invalid-feedback">
                  Please provide a Month.
                </div>
              </div>

               <div>
                <label for="start_day">Day</label>
                <select class="custom-select d-block w-100" id="start_day" name="start_day" required>
                  <option value="{{$start_day}}">{{$start_day}}</option>
                    @for($i = 1; $i < 30; $i++)
                      <option>{{$i}}</option>
                    @endfor
                </select>
                <div class="invalid-feedback">
                  Please provide a valid Day.
                </div>
              </div>
          </div>  <!-- Start Day End-->

        <div class="end">
           <p>공연 종료 일자</p>
          <div class="row">
            <div>
                <label for="end_year">Year</label>
                <select class="custom-select d-block w-100" id="end_year" name="end_year" required>
                  <option value="{{$end_year}}">{{$end_year}}</option>
                    @for($i = 2010; $i < 2020; $i++)
                      <option>{{$i}}</option>
                    @endfor
                </select>
                <div class="invalid-feedback">
                  Please select a valid Year.
                </div>
              </div>

              <div>
                <label for="end_month">Month</label>
                <select class="custom-select d-block w-100" id="end_month" name="end_month" required>
                  <option value="{{$end_month}}">{{$end_month}}</option>
                    @for($i = 01; $i < 13; $i++)
                      <option>{{$i}}</option>
                    @endfor
                </select>
                <div class="invalid-feedback">
                  Please provide a Month.
                </div>
              </div>

               <div>
                <label for="end_day">Day</label>
                <select class="custom-select d-block w-100" id="end_day" name="end_day" required>
                  <option value="{{$end_day}}">{{$end_day}}</option>
                    @for($i = 1; $i < 30; $i++)
                      <option>{{$i}}</option>
                    @endfor
                </select>
                <div class="invalid-feedback">
                  Please provide a valid Day.
                </div>
              </div>
            </div><!-- End Day End-->
      </div>  <!-- row End-->   
      </div>

      <div id="genre_form">   <!-- 장르 -->
        <p>공연 장르</p>
        <select id="genre" name="genre" value="{{$board_info->board_genre}}" required>
          <option value="{{$board_info->board_genre}}">{{$board_genre}}</option>
          <option value="M">뮤지컬</option>
          <option value="C">콘서트</option>
          <option value="P">연극</option>
          <option value="E">전시</option>
          <option value="K">아동</option>
        </select>
      </div>

       <div id="place_form">
        <p>공연 장소</p>
        <input type="text" name="place" id="place" readonly required style="background-color:#bbb;" value="{{$board_info->board_place}}">
        <input type="button" name="theater" value="지도검색" onclick="open_maps();">
        <input type="hidden" name="theater_lat" id="theater_lat" value="{{$loc->theater_lat}}">
        <input type="hidden" name="theater_lng" id="theater_lng" value="{{$loc->theater_lng}}">
      </div>


      <div>
        <p>공연 시간</p>
        <input type="text" name="time" id="time" value="{{$board_info->board_performanceTime}}"required>
      </div>

      <div id="price_form">
        <p>입장 가격</p>
        <input type="text" name="price" id="price" value="{{$board_info->board_price}}"required>
      </div>

      <div id="viewingClass_form">
        <p>관람 등급</p>
        <select class="custom-select" id="viewingClass" name="viewingClass" required>
          <option value="{{$board_info->board_viewingClass}}"> {{$board_viewingClass}} </option>
          <option value="0">전체이용가</option>
          <option value="7">7세이상 이용가</option>
          <option value="12">12세이상 이용가</option>
          <option value="15">15세이상 이용가</option>
          <option value="19">청소년 관람 불가</option>
        </select>
      </div>

      <div>
          <label for="profile">Poster Select</label>
            <div id="imgSelect">

              <input type="hidden" name="no_select" value="{{$board_info->board_picture}}" readonly>
              <input type="file" id="profile_picture" name="board_picture" class="btn btn-primary" accept=".jpg, .jpeg, .png, .gif">
              <div id="preview">
                <label for="upload"><img src="img/{{$board_info->board_picture}}" id="example"></label>
              </div>
          </div>
      </div>

      <div class="from-group">
        <label for="">Context</label>
        <textarea id="editor" name="contents" value="">{{$board_info->board_context}}</textarea>
          <script>
          CKEDITOR.replace('editor',{
            filebrowserUploadUrl:'upload'
           });
          </script>
      </div>

      <div class="from-group">&nbsp</div>

      <input type="submit" class="btn btn-primary" value="수정 완료">
    </form>
  </div>
@endsection