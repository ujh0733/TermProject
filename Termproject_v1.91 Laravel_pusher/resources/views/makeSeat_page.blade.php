@extends('layout.app')

@section('head')
	<link rel="stylesheet" type="text/css" href="css/board.css">
	<style type="text/css">
		td{
			width: 3%;
			height: 5%;
			text-align: center;
			background-color: white;
		}
		table{
			border-collapse: collapse;
		}
	</style>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#result").click(function(){
				var tableX = $("#inputSeatX").val();
				var tableY = $("#inputSeatY").val();
				alert(tableX+","+tableY);

				seatNum = 1;

				$("#our_table tbody").html(' ');

				for(var i = 0; i < tableY; i++){
					$("#our_table tbody").append("<tr id='row'>");
						for(var j = 0; j < tableX; j++){
							//alert(j);
							$("#our_table tbody").append("<td onclick='check("+seatNum+")' id="+seatNum+">"+seatNum+"</td>");
							seatNum++;
						}
					$("#our_table").append("</tr>");
				}
			});

			$("#test").click(function(){
				var x = $("#inputSeatX").val();
				var y = $("#inputSeatY").val();
				var arr = new Array();
				var rs = '[';

				var id = 1;
				var temp = 0;

				for(var i = 0; i < y; i++){
					arr[i] = [];
					rs += "[";
					for(var j = 0; j < x; j++){
						if(document.getElementById(id).style.backgroundColor == "gray"){
							arr[i][j] = 0;
						}else{
							arr[i][j] = 1;
							temp++;
						}
						id++;
						if(j < x-1){
							rs += arr[i][j]+",";
						}else{
							rs += arr[i][j];
						}
					}
					if(i < y-1){
						rs += "],";
					}else{
						rs += "]";
					}
				}
				rs += "]";
				alert('좌석갯수는 '+temp+'개입니다');
				if(temp == 0){
					alert('최소 하나 이상의 좌석을 지정해 주세요');
					return false;
				}
				$('#temp').val(rs);
			});

		});

		function check(num){
			var cont = document.getElementById(num);
			if(cont.style.background == 'gray'){
				cont.removeAttribute("style");
			}else{
				cont.style.background = 'gray';
			}
		}

	</script>

@endsection

@section('content')

	<form action="makeSeat" method="POST">
		@csrf
		<input type="hidden" name="board_num" value="{{$board_num}}">

		<div class="jumbotron" style="width: 85%; margin: 0 auto;">
			<h3>좌석 지정</h3>
			<div style="border: 1px solid black; width: 90%;  height: 120%; margin: 0 auto;">
				<div>
					<p>통로를 포함한 총 좌석 갯수를 입력 후 버튼을 누른 뒤 통로, 좌석배치를 결정해 주세요</p>
					<p>좌석은 각 날자별로 동일하게 적용됩니다.</p>
					<div style="float: right; margin-right: 30px;">
							<p>공연개시 : {{$openDay}}</p>
							<p>공연종료 : {{$closeDay}}</p>
					</div>
					<div>
						가로 : <input type="text" name="inputSeat" id="inputSeatX" placeholder="26"><br>
						세로 : <input type="text" name="inputSeat" id="inputSeatY" placeholder="18">
						<input type="button" name="result" id="result" value="확인" class="btn btn-primary" style="">

					</div>

				</div>

				<div style="border: 1px solid black; width: 90%; height: 80%; margin: 0 auto; margin-top: 5px;">
					<div>
					<p style="background-color: #ccc; margin: 0 auto; width: 35%; height: 18%;text-align: center; line-height: 110px;">STAGE</p>
					</div>

					<div style="margin: 0 auto; margin:0 auto; margin-top: 10px; width: 100%; height: 100%;">
						<table border="1" id="our_table">
							<tbody>
								<tr>
									<td>좌석 입력 란</td>
									<!-- Insert Seats-->
								</tr>
							</tbody>
						</table>	
					</div>

				</div>
	
				<div style="float: right; margin-top: 20px;">
					<input type="hidden" name="seat" id="temp">
					<input type="submit" class="btn btn-primary" value="작성완료" id="test">
				</div>
			</div>
		</div>
	</form>
	
@endsection