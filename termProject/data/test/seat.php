<script src="jquery.min.js"></script>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

	<title>좌석예매 test</title>

	<style>
		td{
			width: 3%;
			height: 5%;
		}
		p{
			background-color: #bbb;
			text-align: center;
		}
		table{
			margin : 0 auto;
			border: 1px solid black;
			border-collapse: collapse;
			text-align: center;
		}
		table td.highlighted {
		  background-color: gray;
		}
		.turn{
			background-color: gray;
		}
		#our_table{
			text-align: center;
		}
		.theater{
			width: 50%;
			height: 600px;
			border: 1px solid black;
		}
		.st{
			width: 30%;
			height: 50%;
			border: 1px solid black;
			float: left;
			margin-left: 5px;
		}
		.backgray{
			background-color: gray;
		}
	</style>
	<script type="text/javascript">
		var cnt = 0;
		var seatNum = 1;
		var sideNum = 1;
		var sideCheckNum = 1;

		$(document).ready(function(){
			$("#create").click( function(){
				cnt = 0;
				document.getElementById("cnt").innerHTML = cnt;

				seatNum = 1;

				$("#our_table tbody").html('');
				var tableX = $("#tableX").val();
				var tableY = $("#tableY").val();

				//alert(tableX+","+tableY);

				for(var i = 0; i < tableY; i++){
					$("#our_table tbody").append("<tr id='row'>");
						for(var j = 0; j < tableX; j++){
							$("#our_table tbody").append("<td onclick='check(event)'>"+seatNum+"</td>");
							seatNum++;
						}
					$("#our_table tbody").append("</tr>");
				}
			});

			$("#send").click(function(){
				var chair = $("#our_table tbody").html();

				$(".st:nth-child("+sideNum+") table tbody").html(chair);
				sideNum++;
				cnt = 0;
			});

			$("#seatClear").click(function(){
				$(".st table tbody").html('');
				sideNum = 1;
			});

			$("#seatCheck").click(function(){
				for(var z = 0; z < sideCheckNum; z++){
					var seatArr = $(".st:nth-child("+sideCheckNum+") table tbody").html();
					alert(seatArr);
				}
			})

		});

		function check(event){
			var temp = document.elementFromPoint(event.pageX, event.pageY);
			console.log(event.pageX);
			console.log(event.pageY);
			var wid = $(temp).width();
			//alert(wid);
			if(temp.style.backgroundColor == "gray"){
				temp.removeAttribute("style");
				this.cnt--;
				if(this.cnt < 0)
					this.cnt = 0;
				document.getElementById("cnt").innerHTML = this.cnt;
				return;
			}else{
				this.cnt++;
				temp.setAttribute("text"," ");
				temp.setAttribute("style", "background-color: gray;");
				//temp.toggleClass("backgray");
			}
			document.getElementById("cnt").innerHTML = this.cnt;

			 $(document)
		    .mouseup(function () {
		      isMouseDown = false;
		    });
		}

	</script>
</head>
<body>
	<div>
		<h3>좌석 예매다!</h3>
	</div>
<div style="display: inline-flex; width: 100%">	<!-- start big-->
	<div class="theater">
		<div style="width: 100%; height: 5%;">
			<select id="tableX">
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
			</select>

			<select id="tableY">
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
				<option>6</option>
				<option>7</option>
				<option>8</option>
				<option>9</option>
				<option>10</option>
				<option>11</option>
			</select>

			<input type="button" name="create" id="create" value="생성">
		</div>


		<div style="border: 1px solid black; width: 100%; height: 78%;">
			<table border=1 id="our_table" style="width: 100%;">
				<tbody>
					<!-- inner HTML seat-->
				</tbody>
			</table>
		</div>

		<div style="width: 100%; height: 4%;">
			<span>공석을 체크해 주세요</span>
			<br>
			<span>선택한 좌석 수:</span><span id="cnt">0</span>
			<input type="button" id="send" value="좌석 입력">
		</div>
	</div>

	<div class="theater">

		<div style="display: inline-flex; width: 100%;">
			<h4>전체 좌석</h4>
			&nbsp;
			<input type="button" id="seatClear" value="좌석 초기화" style="height: 20px; margin-top: 22px;">
		</div>

		<div style="width: 100%;">
			<p>Screen</p>
		</div>

		<div style="margin-left: 5px; width: 100%;">

			<div class="st" style="width: 30%;">
				1번
				<table border="1" style="width: 100%;">
					<tbody></tbody>
				</table>
			</div>

			<div class="st" style="width: 30%;">
				2번
				<table border="1" style="width: 100%;">
					<tbody></tbody>
				</table>
			</div>

			<div class="st" style="width: 30%;">
				3번
				<table border="1" style="width: 100%;">
					<tbody></tbody>
				</table>
			</div>

		</div>


		<input type="button" id="seatCheck" value="좌석갯수확인">
		<span>좌석갯수:</span><span id="seatResult">0</span>
	</div>

</div>		<!-- end Big-->

	<script>


		$(function () {
		  var isMouseDown = false;
		  //var temp = document.elementFromPoint(event.pageX, event.pageY);
		  $("#our_table td")
		    .mousedown(function () {
		      isMouseDown = true;
		      $(this).toggleClass("turn");
		      return false; // prevent text selection
		    })
		    .mouseover(function () {
		      if (isMouseDown) {
		       $(this).toggleClass("turn");
		      }
		    });
		  
		  $(document)
		    .mouseup(function () {
		      isMouseDown = false;
		    });
		});

		
		
	</script>
</body>
</html>