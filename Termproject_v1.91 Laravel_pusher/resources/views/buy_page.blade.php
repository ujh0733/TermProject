@extends('layout.app')

@section('head')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="css/board.css">
	<style type="text/css">
		.line {
            overflow: hidden;
        }
        .seat {
            margin: 2px;
            float: left;
            border-radius: 3px;
            font-size: 60%;
            text-align: center;
        }
        .enable {				/*공석*/
            background: gray;
        }
        .enable:hover {
            background: black;
            color: white;
        }
        .disable {				/*선택*/
            background: red;
        }
        .disable:hover{
        	background-color: brown;
        }
        .comeback {				/*통로*/
            background: white;
            pointer-events: none;
        }
        .complete{				/*예약된 자리*/
        	background-color: #ccc;
        	pointer-events: none;
        }
        .now{
        	background-color: green;
        	pointer-events: none;
        	color: white;
        }
        .fake{
			border: none;
			background-color: #eee;
			column-rule-style: none;
        }
	</style>
	<script src="js/view.js"></script>
	<script src="https://js.pusher.com/4.4/pusher.min.js"></script>
	<script>
		$(document).ready(function(){

			var num = <?= $board_num ?>;	//글 번호
			var pusherNow = true;

			Pusher.logToConsole = true;

		    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

		    var pusher = new Pusher('ec792b864a013c22fe72', {
		      auth: {
		        headers: {
		          'X-CSRF-Token': CSRF_TOKEN,
		        }
		      },
		      cluster: 'ap3',
		      forceTLS: true
		    });

		    var channel = pusher.subscribe('seat-channel');
		     	channel.bind(num, function(data) {

		    		var seatNum = data;
		    		if(pusherNow == true){
			    		$("#"+seatNum).toggleClass('now');
			    	}			    	
		      	});

			/*Pusher Realtime end*/

			var apt = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
			var boardHeight, boardWidth;

			function makeSeats(getSeat){
				var seats = <?= $seats ?>;
				var side = seats.length;
				var up = seats[0].length;

				if(getSeat){
					var reg = /[\{\}\[\]\/?.,;:|\)*~`!^\-_+<>@\#$%&\\\=\(\'\"]/gi;
					getSeat = getSeat.replace(reg, '');

					seats = new Array(side);
					count = 0;

					for(var i = 0; i < side; i++){
						seats[i] = new Array(up);
						for(var j = 0; j < up; j++){
							seats[i][j] = getSeat[count];
							count++;
						}
					}
				}

				var seatsCode = '';
				var seatsForm = "<div class='line'>";
				
	            for(var i = 0; i < seats.length; i++){
	            	boardHeight = seats.length;			//세로 의자 갯수
	            	seatsCode = apt[i];
	            	seatsForm += "<div>";
	            	for(var j = 0; j < seats[i].length; j++){
	            		boardWidth = seats[i].length;  //가로 의자 갯수

	            		if(seats[i][j] == 0){
	            			seatsForm += "<div class='seat comeback' id='"+seatsCode+j+"'></div>";
	            		}else if(seats[i][j] == 1){
	            			seatsForm += "<div class='seat enable' id='"+seatsCode+j+"'>"+seatsCode+j+"</div>";
	            		}else if(seats[i][j] == 2){
	            			seatsForm += "<div class='seat complete' id='"+seatsCode+j+"'></div>";
	            		}else if(seats[i][j] == 3){
	            			seatsForm += "<div class='seat now' id='"+seatsCode+j+"'>"+seatsCode+j+"</div>";
	            		}
	            	}
	            	seatsForm += "</div>";
	            }

	            seatsForm += "</div>";
	            var setWidth = Math.floor(500/boardWidth);	//500값에서 나누고 버림..

	            $('#seatsFrom').append(seatsForm);
	            $('#seatsFrom').css("width", (boardWidth*setWidth)+(4*boardWidth)+"px");		//좌석의 width길이를 좌석수에 따라 지정
	            $('#seatsFrom .seat').css({"width": setWidth+"px", "height": setWidth+"px"});
            //좌석 그리기 끝
}

            var cnt = 0;
            $("#cnt").html(cnt);
            var price = '{{$board->board_price}}';
            $("#price").html('0');

			function seatOption(){
	            $(".seat").click(function(){
	            	
	            	var clickSeatNum = $(this).html();
	            	var id = clickSeatNum+'sel';

	            	if($(this).hasClass('disable')){	// 선택 되있으면..
	            		var delId = $(this).attr('id')+'sel';
	            		$("#"+delId).remove();
	            		cnt--;
	            		$("#cnt").val(cnt);
		            	$("#price").val(cnt*price);
	            	}else{								//선택 안되있으면 선택한 좌석에 추가
		            	$("#userSelect").append('<input id="'+id+'" name="seat[]" class="fake" value="'+$(this).html()+'"readonly onmousedown="return false"></input>');
		            	cnt++;
		            	$("#cnt").val(cnt);
		            	$("#price").val(cnt*price);
	            	}

	            	pusherNow = false;
		            $(function(){
		            	$.post("pusherAjaxTest", {num:num, id:clickSeatNum, _token:CSRF_TOKEN},
		            		function(data){
		            			pusherNow = true;
		            		});
		            }); 

	            	$(this).toggleClass('disable');
	            });
			}
			makeSeats();
			seatOption();
		
            $("#result").click(function(){
				var arr = new Array();

				var rs = '[';

				for(var i = 0; i < boardHeight; i++){
					arr[i] = [];
					rs += "[";
					for(var j = 0; j < boardWidth; j++){
						if($("#"+apt[i]+j).hasClass('comeback')){
							arr[i][j] = 0;
						}else if($("#"+apt[i]+j).hasClass('complete')){
							arr[i][j] = 2;
						}else if($("#"+apt[i]+j).hasClass('disable')){
							arr[i][j] = 2;
						}else{
							arr[i][j] = 1;
						}
						/*arr[i][j] = ++c;
						console.log(arr[i][j]);*/
						if(j < boardWidth-1){
							rs += arr[i][j]+",";
						}else{
							rs += arr[i][j];
						}
					}
					if(i < boardHeight-1){
						rs += "],";
					}else{
						rs += "]";
					}
				}
				rs += "]";
				$('#modifySeat').val(rs);
			});

			$("#day").change(function(){
				change_seats();
				$("#userSelect").html('');
				$("#price").val('0');
			});

			function change_seats(){
			    $.get("buy_loadMoreData", {num:num, day:$("#day").val(), price:price, cnt:cnt}, function(data){
			    	$("#seatsFrom").html('');
			    	$("#seatsFrom").html(makeSeats(data));
			    	seatOption();
			    	$("#cnt").val(data['cnt']);    
			    });
			 }
		});

	</script>
@endsection

@section('content')
	<form action="buy" method="POST">
		@csrf
		<div class="jumbotron" style="width: 90%; margin: 0 auto;">
			<h3>티켓 예매</h3>
			<hr>
			<div class="info2" style="display:flex; justify-content: center;">
				<img src="img/{{$board->board_picture}}">

				<input type="hidden" name="board_num" value="{{$board_num}}">

				<div class="list-group info">
					<a class="list-group-item list-group-item-action active">
						공연 정보
					</a>
					<a class="list-group-item list-group-item-action">공연 장소 : {{$board->board_place}}&nbsp;&nbsp;<input type="button" name="maps" value="지도보기" onclick="open_Theater('{{$board_num}}');"></a>
					<a class="list-group-item list-group-item-action">관람 등급 : {{ $viewingClass }}</a>
					<a class="list-group-item list-group-item-action">공연 기간 : {{$board->board_term_open." ~ ".$board->board_term_close}}</a>
					<a class="list-group-item list-group-item-action disabled">가격 : {{$board->board_price}}원</a>
					<a class="list-group-item list-group-item-action disabled">공연 시간 : {{$board->board_performanceTime}}분</a>
				</div>
			</div>
			<hr>
			<div style="margin-left: 5%;">
				
			</div>
			<div style="display: flex; display:flex; margin: 0 auto; justify-content: center;">

				<div style="width: 600px; height: 900px; border: 1px solid black;" id="select">
					<p style="background-color: #ccc; margin: 0 auto; width: 200px; height: 110px; text-align: center; line-height: 110px;">STAGE</p>
					<div id="seatsFrom" style="margin: 0 auto; margin-top: 5px;">
						<!-- Input Seat Image Form-->
					</div> 
				</div>
				<div style="border: 1px solid black; width: 200px; height: 450px; margin-left: 50px;">
					<div>
						<select style="width: 110px; margin-bottom: 5px;" id="day" name="day">
							@for($i = 0; $i < $arrSize; $i++)
								<option>{{$info[$i]->board_day}}</option>
							@endfor
						</select>
					</div>
					<p style="text-align: center; background-color: #ccc;">선택한 좌석</p>
					<div id="userSelect" style="width: 100%; height: 290px; overflow: scroll; scroll-behavior: ">
						<!-- Input User select seats-->
					</div>
					<div>
						<div style="display: flex;">
							<p>선택한 좌석 - <input id="cnt" name="cnt" style="width: 20px;" value="0" class="fake"></input>석</p>
						</div>
						<div style="display: flex">
							<p>가격 - <input id="price" name="price" style="width: 80px;" value="0" class="fake"></input>원</p>
						</div>
					</div>
				</div>
			</div>
			<div style="margin: 0 auto; width: 50px; margin-top: 10px;">
				<input type="hidden" name="modifySeat" id="modifySeat">
				<input type="submit" class="btn btn-primary" value="구매확정" id="result">
			</div>
		</div>
	</form>
@endsection