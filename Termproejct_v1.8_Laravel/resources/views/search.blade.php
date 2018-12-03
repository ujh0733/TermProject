@extends('layout.app')

@section('head')
  <link rel="stylesheet" type="text/css" href="css/board.css">
@endsection

@section('content')
  <div class="container">

  @if($search == NULL)
    <h1 style="text-align: center;">검색어를 입력해 주세요</h1>
  @else

    @if(sizeof($result))
    <h1 style="text-align: center;">'<span style="color:#7fd887">{{$search}}</span>'의 검색 결과</h1>
    	<div class="row">
    	    <div class="item">

    	@foreach($result as $val)
    	      <div class="card" onclick="location.href='board_view?board_num={{$val->board_num}}'">
              <div id="card_img">
    	        <img class="card-img-top mini" src="img/{{$val->board_picture}}" alt="None Img..">
              </div>
    	        <div class="card-body">
    	          <h5 class="card-title cardText"><strong>{{$val->board_title}}</strong></h5>
    	          <p class="card-text cardText">{{$val->board_opener}}</p>
    	          <p class="card-text cardText">{{$val->board_term_open." ~ ".$val->board_term_close}}</p>
    	          <a href="board_view?board_num={{$val->board_num}}" class="btn btn-primary" id="imgLink">자세히보기</a>
    	        </div>
    	      </div>
      @endforeach  

    @else
    		<h1 style="text-align: center;">'<span style="color:#7fd887">{{$search}}</span>'에 해당하는 결과 값이 없습니다. ㅜㅜ</h1>
    @endif

  @endif
  	  </div>
  	</div>
  </div>
@endsection