@extends('layout.app')

@section('head')
<link rel="stylesheet" type="text/css" href="css/board.css">
<style>
  .genreTitle{
    margin-top: 10px;
    color: #71c449;
  }
  #loading{
    position: relative;
    width: 100%;
    text-align: center;
  }
  #loading img{
    float: none;
    width: 100%;
    height: 500px;
    z-index: 1;
  }
</style>

<script>
    function colorChange(cnt){
      if($("#"+cnt).html() == "공연중"){
              $("#"+cnt).css({"background-color" : "gray", "color": "white"});
            }else if($("#"+cnt).html() == "공연종료"){
              $("#"+cnt).css({"background-color" : "red", "color": "white"});
            }else{
              $("#"+cnt).css({"background-color" : "green", "color": "white"});
            }
    }

  $(function(){
    $(".menu_list:nth-child(<?= $num ?>)").css({"color": "#7fd887", "border-bottom" : "solid 2px #7fd887"});
  })

  $(window).scroll(function() {
    var last_id = 8;
    if (Math.round($(window).scrollTop()) == $(document).height() - $(window).height()) {
      append_list();
    }
  });

  var start = 8;
  var list = 8;
  var genre = '{{$genre}}';
  var now = '{{$now}}';
  var cnt = 9;

  function append_list(){
    $.get("list_loadMoarData", {start:start, list:list, genre:genre}, function(data){
      if(data != 0){
        $("#loading").append("<img src='img/loading.gif' alt='loading'>");
        setTimeout(function(e){
        for(var i = 0; i < list; i++){
          if(data[i].board_term_open < now && now < data[i].board_term_close){
            var notice = "공연중";
          }else if(data[i].board_term_close < now){
            var notice = "공연종료";
          }else{
            var notice = "예매중";
          }

          $('#cont').append($('<div/>', {
              class: 'card',
              onclick: "location.href='board_view?board_num="+data[i].board_num+"'"
          }).append($('<div/>',{
              id: 'card_img'
            }).append($('<img/>',{
              class: 'card-img-top mini',
              src: 'img/'+data[i].board_picture,
              alt: 'None img...'
          }))).append($('<div/>',{
              class: 'card-body'
            }).append($('<h5/>',{
                clsss: 'card-title cardText',
            }).append($('<strong/>',{
                text: data[i].board_title
            }))).append($('<p/>',{
                class: 'card-title cardText',
                text: data[i].board_opener
            }).append($('<span/>',{
              style: 'float: right',
              id: cnt,  
              text: notice
            }))).append($('<p/>',{
              class: 'card-text cardText',
              text : data[i].board_term_open+" ~ "+data[i].board_term_close
            })).append($('<a/>',{
              class: 'btn btn-primary',
              href: 'board_view?board_num='+data[i].board_num,
              id: 'imgLink',
              text: '자세히보기'
            }))
            )
          );

          colorChange(cnt);
          cnt++;
        }
          $("#loading img").remove();
        },500);
        start += list;
      }else{
        $("#loading img").remove();
        alert('데이터가 없습니다.');
        return false;
      }
    });

  }
  colorChange();
</script>
@endsection

@section('content')
   
@if(!$genre)
<form action="deleteBoard" method="POST">
  @csrf
<div class="board">
 <h2 class="genreTitle">모든 공연</h2>


   <table class="table table-hover">  
      <thead style="background-color: skyblue">
        <tr>

          @if( Auth::user() && Auth::user()->user_auth == "TOP")
            <th>Sel</th>
          @endif

          <th>#</th>
          <th>Writer</th>
          <th>Title</th>
          <th>Date</th>
          <th>Viewd</th>
        </tr>
      </thead>

      <tbody>
      @foreach($board_info as $row)
        <?php if(Auth::user() != "" && Auth::user()->user_auth == "TOP") : ?>
          <tr>
            <td><input type="checkbox" name="check[]" value="<?= $row['board_num']."," ?>"></td>
            <td onclick="location.href='board_view?board_num={{$row->board_num}}&page={{$page}}'">{{$row->board_num}}</td>
            <td onclick="location.href='board_view?board_num={{$row->board_num}}&page={{$page}}'">{{$row->board_opener}}</td>
            <td onclick="location.href='board_view?board_num={{$row->board_num}}&page={{$page}}'">{{$row->board_title}}</td>
            <td onclick="location.href='board_view?board_num={{$row->board_num}}&page={{$page}}'">{{$row->board_posted}}</td>
            <td onclick="location.href='board_view?board_num={{$row->board_num}}&page={{$page}}'">{{$row->board_viewed}}</td>
          </tr>
      
        @else
          <tr onclick="location.href='board_view?board_num={{$row->board_num}}&page={{$page}}'">
            <td>{{$row->board_num}}</td>
            <td>{{$row->board_opener}}</td>
            <td>{{$row->board_title}}</td>
            <td>{{$row->board_posted}}</td>
            <td>{{$row->board_viewed}}</td>
          </tr>
        @endif
      </tbody>
      @endforeach  
    </table>

    {{$board_info->links()}}
    
    <div class="float-right" style="">

      @if( Auth::user() != "" && Auth::user()->user_auth == "TOP")
        <input type="submit" name="delete" value="삭제" class="btn btn-danger" onclick="return confirm('선택한 항목을 삭제하시겠습니까?')">
      @endif

      <a onclick="location.href='write_page'" class="btn btn-primary" style="color:white;">글쓰기</a>
    </div>
  <br>
</div>   
</form>

@else
  <div class="container">
    <h2 class="genreTitle">{{$pageGenre}}</h2>
    <div class="row" id="cont">
    @foreach($msgs as $val)
      @php
        if($val['board_term_open'] < $now && $now < $val['board_term_close']){
          $notice = "공연중";
        }else if($val['board_term_close'] < $now){
          $notice = "공연종료";
        }else{
          $notice = "예매중";
        }
      @endphp
          <div class="card" onclick="location.href='board_view?board_num={{$val->board_num}}&page={{$page}}'">
            <div id="card_img">
            <img class="card-img-top mini" src="img/{{$val->board_picture}}" alt="None Img..">
            </div>
            <div class="card-body">
              <h5 class="card-title cardText"><strong>{{$val->board_title}}</strong></h5>
              <p class="card-text cardText">{{$val->board_opener}}<span style="float: right;" id="{{$cnt}}">{{$notice}}</span></p>
              <p class="card-text cardText">{{$val->board_term_open." ~ ".$val->board_term_close}}</p>
              <a href="board_view?board_num={{$val->board_num}}" class="btn btn-primary" id="imgLink">자세히보기</a>
            </div>
          </div>

          <script>
            colorChange(<?= $cnt ?>);
          </script>
      @php $cnt++; @endphp
    @endforeach

      <div class="dummy1 card" style="display: none;">
        <div id="card_img">
           <img class="card-img-top mini dummyImg" src="" alt="None Img..">
        </div>
        <div class="card-body">
          <h5 class="card-title cardText"><strong>data[i].board_title</strong></h5>
          <p class="card-text cardText"><span style="float: right;" id=""></span></p>
          <p class="card-text cardText"></p>
          <a class="btn btn-primary" id="imgLink"></a>
        </div>
      </div>

    </div>

    <div id="loading">
      
    </div>

  </div>     
@endif

@endsection