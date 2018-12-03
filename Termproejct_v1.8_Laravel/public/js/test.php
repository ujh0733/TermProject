<?php
  function cardDraw($msgs, $page, $cnt){
    foreach($msgs as $val){
          if($val['board_term_open'] < $now && $now < $val['board_term_close']){
            $notice = "공연중";
          }else if($val['board_term_close'] < $now){
            $notice = "공연종료";
          }else{
            $notice = "예매중";
          }
?>
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
              if($("#<?= $cnt ?>").html() == "공연중"){
                $("#<?= $cnt ?>").css({"background-color" : "gray", "color": "white"});
              }else if($("#<?= $cnt ?>").html() == "공연종료"){
                $("#<?= $cnt ?>").css({"background-color" : "red", "color": "white"});
              }else{
                $("#<?= $cnt ?>").css({"background-color" : "green", "color": "white"});
              }
            </script>
<?php
      $cnt++;
    }
  }
?>