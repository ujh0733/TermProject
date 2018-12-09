@extends('layout.app')

@section('head')
  <link rel="stylesheet" type="text/css" href="css/board.css">
	<style>
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
      .row{
        display: inline-flex;
      }
      .row div{
        margin-left: 5px;

      }
	</style>
  <script src="js/ckeditor/ckeditor.js"></script>
  <script type="text/javascript" src="js/write.js"></script>
@endsection

@section('content')
	<div class="jumbotron">
		<form action="write" method="POST" enctype="multipart/form-data" id="postForm">
     @csrf
			<!--Value값은 사용자 아이디로 작성자로 사용 -->
			<input type="hidden" name="writer" value="{{Auth::user()->user_name}}">

			<div class="alert alert-primary" role="alert">
				<label for="title">Title</label>
				<input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" required>
			</div>

			<div class="alert">	<!--개최자 입력-->
				<label for="opener">Opener</label>
				<input type="text" class="form-control" id="opener" placeholder="Enter Opener" name="opener" required>
			</div>

	 <!--공연 시작/종료 날짜-->
		<div class="alert">
        <p>공연 개시 일자</p>
            <div class="row">
              
              <div>
                <label for="start_year">Year</label>
                <select class="custom-select d-block w-100" id="start_year" name="start_year" required>
                  <option value="">Choose...</option>
                    @for($i = 2018; $i < 2020; $i++)
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
                  <option value="">Choose...</option>
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
                  <option value="">Choose...</option>
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
                  <option value="">Choose...</option>
                    @for($i = 2018; $i < 2020; $i++)
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
                  <option value="">Choose...</option>
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
                  <option value="">Choose...</option>
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
        <select id="genre" name="genre" required>
          <option value=""> Choose...</option>
          <option value="M">뮤지컬</option>
          <option value="C">콘서트</option>
          <option value="P">연극</option>
          <option value="E">전시</option>
          <option value="K">아동</option>
        </select>
      </div>

      <div id="place_form">
        <p>공연 장소</p>
        <input type="text" name="place" id="place" readonly required style="background-color:#bbb;">
        <input type="button" name="theater" value="지도검색" onclick="open_maps();">
        <input type="hidden" name="theater_lat" id="theater_lat">
        <input type="hidden" name="theater_lng" id="theater_lng">
      </div>

      <div>
        <p>공연 시간</p>
        <input type="text" name="time" id="time" required>분
      </div>

      <div id="price_form">
        <p>입장 가격</p>
        <input type="text" name="price" id="price" required>원
      </div>

      <div id="viewingClass_form">
        <p>관람 등급</p>
        <select class="custom-select" id="viewingClass" name="viewingClass" required>
          <option value="0">전체이용가</option>
          <option value="7">7세이상 이용가</option>
          <option value="12">12세이상 이용가</option>
          <option value="15">15세이상 이용가</option>
          <option value="19">청소년 관람 불가</option>
        </select>
      </div>

			<div>
        <label for="profile">Poster Select</label>	<!--공연 포스터-->
          <div id="imgSelect">
            <input type="file" id="profile_picture" name="board_picture" class="btn btn-primary" accept=".jpg, .jpeg, .png, .gif">
            <div id="preview">
            <label for="upload"><img src="img/noimage.gif" id="example"></label>
          </div>
        </div>
      </div>

			<div class="from-group">
				<label for="">Context</label>
        <textarea id="editor" name="context"></textarea>
          <script>
           CKEDITOR.replace('editor',{
            filebrowserUploadUrl: '/ckUpload?_token={{csrf_token()}}&type=image',height:'300px',
           });     
          </script>
			</div>

			<div class="from-group">&nbsp</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>


 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();

    </script>

@endsection