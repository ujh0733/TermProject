@extends('layout.app')
<head>
  <link rel="stylesheet" type="text/css" href="css/board.css">
  <style>
  .menu_list:nth-child(1){
    color: #7fd887;
    border-bottom: solid 2px #7fd887;
    margin-bottom: 0.1px;
  }
  </style>
</head>

  @section('content')

  <div class="container" style="margin-top:30px">
    <div id="demo" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#demo" data-slide-to="0" class="active"></li>
        <li data-target="#demo" data-slide-to="1"></li>
        <li data-target="#demo" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="img/banner1.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/banner2.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="img/banner3.jpg" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#demo" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#demo" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
  </div>


 <hr>
      <h3>인기 공연</h3>
  <div class="row">
    <div class="item">

@for($i = 0; $i < 4; $i++)
      <div class="card" onclick="location.href='board_view?board_num={{$board_info_viewed[$i]->board_num}}'">
        <div id="card_img">
          <img class="card-img-top mini" src="img/{{$board_info_viewed[$i]->board_picture}}" alt="None Img..">
        </div>
        <div class="card-body">
          <h5 class="card-title cardText"><strong>{{$board_info_viewed[$i]->board_title}}</strong></h5>
          <p class="card-text cardText">{{$board_info_viewed[$i]->board_opener}}</p>
          <p class="card-text cardText">{{$board_info_viewed[$i]->board_term_open." ~ ".$board_info_viewed[$i]->board_term_close}}</p>
          <a href="board_view?board_num={{$board_info_viewed[$i]->board_num}}" class="btn btn-primary" id="imgLink">자세히보기</a>
        </div>
      </div>
@endfor
  </div>
</div>

   <hr>
    <h3>최신 공연 공지</h3>
    <div class="row">
      <div class="item">

@for($i = 0; $i < 4; $i++)
      <div class="card" onclick="location.href='board_view?board_num={{$board_info[$i]['board_num']}}'">
        <div id="card_img">
          <img class="card-img-top mini" src="img/{{$board_info[$i]['board_picture']}}" alt="None Img..">
        </div>
        <div class="card-body">
          <h5 class="card-title cardText"><strong>{{$board_info[$i]->board_title}}</strong></h5>
          <p class="card-text cardText">{{$board_info[$i]->board_opener}}</p>
          <p class="card-text cardText">{{$board_info[$i]->board_term_open." ~ ".$board_info[$i]->board_term_close}}</p>
          <a href="board_view?board_num={{$board_info[$i]->board_num}}" class="btn btn-primary" id="imgLink">자세히보기</a>
        </div>
      </div>  
@endfor

  </div>
</div>

</div>  <!-- container End-->

@endsection