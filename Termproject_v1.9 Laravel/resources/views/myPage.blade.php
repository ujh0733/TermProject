@extends('layout.app')

@section('head')
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" type="text/css" href="css/myPage.css">
	<script>
		function drawBoard(type, data){
			var rs = '';
			if(type == 'myWrite'){
				for(var i in data)
					rs += '<div class="myWrite" onclick="location.href=\'board_view?board_num='+data[i].board_num+'\'"><img src="img/'+data[i].board_picture+'" class="myWriteImg"><span>'+data[i].board_title+'</span></div>';
			}else if(type == 'myBuy'){
				for(var i in data)
					rs += '<div class="myWrite" onclick="location.href=\'board_view?board_num='+data[i].board_num+'\'"><img src="img/'+data[i].board_picture+'" class="myWriteImg"><span>'+data[i].board_title+'</span><span>'+data[i].buy_seat+'</span></div>';
			}
			if(data.length == 0){
				rs = '<h3>구매한'+type+'없습니다.</h3>';
			}
			return rs;
		}

		var passCheck = false;
		var user = '{{$user}}';

		function changeBoard(type){
			$.get("myPageGet", {id:user, type:type}, function(data){
				if(data){
					var dataForm = '';
					if(type == 'myWrite'){
						dataForm = drawBoard(type, data);
					}else if(type == 'myBuy'){
						dataForm = drawBoard(type, data);
					}else if(type == 'admin'){
						dataForm = '<h3>'+data+'</h3>';
					}

					var form = $("#"+type).html();
					$("#pageViwing").html(' ');
					$("#pageViwing").append(dataForm);
				}else{
					alert('데이터 호출 실패');
				}
			});
		}

		function board(type){
			var form = $("#"+type).html();
			$("#pageViwing").html(' ');
			$("#pageViwing").html(form);
		}

		function withdrawal(){
			var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			if(confirm('정말 탈퇴하실 거에요??')){
				if(confirm('데이터는 복구되지 않습니다\n정말 탈퇴하십니까?')){
					$.post("withdrawal", {user:user, pass:$("#passInput").val(), _token:CSRF_TOKEN}, function(data){
						if(data){
							alert('탈퇴가 완료되었습니다.');
							location.href='/';
							return false;
						}
					});
				}
			}else{
				alert('감사합니다!');
			}
		}

		$(document).ready(function(){
			changeBoard('myWrite');
		});

	</script>
@endsection

@section('content')
	<div class="jumbotron" style="width: 90%; margin: 0 auto; display: flex;">
		<nav>
			<div id="navTitle">
				<strong>마이페이지</strong>
			</div>
			<div id="myPageList">
				<div onclick="location.href='updateInformation_page'">
					<strong>정보변경</strong>
				</div>
				<div onclick="changeBoard('myWrite')">
					<strong>내가 쓴 글</strong>
				</div>
				<div onclick="changeBoard('myBuy')">
					<strong>구매한 티켓</strong>
				</div>
				<div onclick="board('withdrawal')">
					<strong>회원 탈퇴</strong>
				</div>
				<div onclick="board('inquiry');">
					<strong>문의하기</strong>
				</div>
				@if(Auth::user()->user_auth == 'TOP' || Auth::user()->user_auth == 'A')
					<div onclick="location.href='adminPage'">
						<strong>관리자페이지</strong>
					</div>
				@endif
			</div>
		</nav>
		<div id="myPage_body">
			<div id="myPageTop">
				<div onclick="changeBoard('myWrite')">
					<img src="img/page/myPage_board.png">
					<div>
						<span>내가 쓴 글</span>
						<p>{{$boardCnt}}개</p>
					</div>
				</div>
				<div onclick="changeBoard('myBuy')">
					<img src="img/page/myPage_ticket.png">
					<div>
						<span>구매한 티켓</span>
						<p>{{$ticketCnt}}장</p>
					</div>
				</div>
			</div>
			<div id="myPageBottom">
				<div id="pageViwing">

				</div>
				<!-- using ajax chage data -->
				<!-- user writed board -->
				<div id="myWrite" style="display: none;">
					<h4>내가 쓴 글</h4>
				</div>
				<!-- user bought ticket -->
				<div id="myBuy" style="display: none;">
					<h4>내가 산 티켓</h4>
				</div>
				<!-- self destroy user -->
				<div id="withdrawal" style="display: none; margin: 0 auto;">
					<div id="withdrawalForm">
						<h4>회원탈퇴</h4>
						<div>
							<input type="password" class="form-control" id="passInput" placeholder="비밀번호를입력해주세요">
							<button class="btn btn-primary" onclick="withdrawal();">확인</button>
						</div>
						<p>회원 탈퇴를 하기 위해서 비밀번호를 입력해 주세요</p>
					</div>
				</div>
				<!-- doing inquiry -->
				<div id="inquiry" style="display: none">
					<div id="inquiryForm">
						<h4>문의하기</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection