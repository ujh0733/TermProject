@extends('layout.app')

@section('head')
	<link rel="stylesheet" type="text/css" href="css/board.css"/>
	<script src="js/view.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script>
	function createCookie(){
		var cookie = document.cookie;
			
		var userId = '{{$user_id}}';

		var cookieChk = cookie.indexOf(userId);

		if(cookieChk == -1){
			alert('쿠키없다');
			document.cookie = userId+"={{$board_num}}";
		}else{
			alert('쿠키있다');
			var num = 0;
			var cut = cookie.split(';');
			for(var i = 0; i < cut.length-1; i++){
				if(cut[i].indexOf(userId) == 1){
					num = i;
					i = cut.length;
				}
			}
			cookieplus = cut[num]+",{{$board_num}}";
			var date = new Date();
			date.setDate(date.getDate()-1);
			document.cookie = userId+'=; expires='+date.toGMTString()+";";
			document.cookie = cookieplus;
		}
			
		if(confirm("장바구니에 담았습니다.\n장바구니로 이동하시겠습니까?")){
			location.href="cart";
		}else{
			return false;
		}

	}

	function insertComment(){
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
		var id = '{{$user_id}}';
		if(id == 'guest'){
			alert('로그인을 하셔아 댓글을 쓸 수 있습니다.');
			return false;
		}
		var num = '{{$board_num}}';
		var name = '{{$user_name}}';
		var txt = $("#inputComment").val();
		$(function(){
			$.post("/comment", {num:num, id:id, name:name, txt:txt, _token:CSRF_TOKEN}, function(data){
				if(data){
					var rs = '<div style="width: 85%; border: 1px solid black; margin-left: 50px; display: inline-flex;"><div style="display: inline-flex;"><img src="img/'+data.profile+'" alt="not" style="width: 80px; height: 80px;"><div style="width: 70px;"><p>'+data.id+'</p></div></div><div style="width: 6%;"></div><div><p>'+data.txt+'</p><div><p>'+data.date+'</p></div></div></div>';
					$("#commentForm").prepend(rs);
					$("#inputComment").val('');
					alert('소중한 댓글 감사합니다.');
					$("#cnt").html(data.cnt);
				}else{
					alert('댓글 안써짐 ㄷㄷ;');
				}
			});
		});
	}
	</script>
@endsection

@section('content')
	<div class="jumbotron" id="board_body" style="width: 80%; margin: 0 auto;">
		<div class="alert alert-dark" role="alert">
			<h4><strong>{{$board_title}}</strong></h4>
			<span>글쓴이 : {{$board->board_writer}}</span>
			<br>
			<span>주최자 : {{$board->board_opener}}</span>

			<p id="right">작성일 / {{$board->board_posted}} <br> 조회수 : {{$board->board_viewed}}</p>

			<hr>
	<div style="display: inline-block;">	
			<div class="info2">
				<img src="img/{{$board['board_picture']}}">

				<div class="list-group info">

				  <a class="list-group-item list-group-item-action active">
				    공연 정보
				  </a>
				  <a class="list-group-item list-group-item-action">공연 장소 : {{$board->board_place}}&nbsp;&nbsp;<input type="button" name="maps" value="지도보기" onclick="open_Theater('{{$board_num}}');"></a>
				  <a class="list-group-item list-group-item-action">관람 등급 : {{$viewingClass}}</a>
				  <a class="list-group-item list-group-item-action">공연 기간 : {{$board->board_term_open." ~ ".$board->board_term_close}}</a>
				  <a class="list-group-item list-group-item-action disabled">가격 : {{$board->board_price}}원</a>
				  <a class="list-group-item list-group-item-action disabled">공연 시간 : {{$board->board_performanceTime}}분</a>
				</div>
	</div>
<div style="float: right; margin-left: 5px;">
	<form action="login_page?board_num={{$board_num}}&page={{$page}}" method="GET">
		<input type="hidden" name="board_num" value="{{$board_num}}">
		<input type="hidden" name="page" value="{{$page}}">
		
		<input type="button" name="remain" onclick="remainSeat('{{$board_num}}');" value="잔여좌석" class="btn btn-success">
	<?php if(Auth::user()) : ?>
		<input type="button" name="buy" onclick="location.href='buy_page?num={{$board_num}}'" class="btn btn-primary" value="예매하기">
	<?php else : ?>
		<input type="submit" onclick="return confirm('예매를 위해서는 로그인을 해야 합니다.')" class="btn btn-primary" value="예매하기">		
	<?php endif ?>
	<input type="button" name="cart" onclick="createCookie();" class="btn btn-info" value="장바구니 담기">
	</form>
</div>
</div>		
			<hr>
			<div style="width: 100%;">
			<h3>내용</h3>
				<div style="width: 100%;">
					<?= $board_context ?>
				</div>
			</div>
			<div style="display: flex;">
				<a onclick="location.href='board_page?page={{$page}}'" class="btn btn-primary">목록</a>
				<a href="updateBoard_page?id={{$board->board_writer}}&num={{$board->board_num}}" class="btn btn-warning">수정</a>
				<form action="deleteBoard" method="POST" id="deleteBoard">
					@csrf
					<input type="hidden" name="writer" value="{{$board->board_writer}}">
					<input type="hidden" name="num" value="{{$board->board_num}}">
					<input type="hidden" name="page" value="{{$page}}">
					<input type="button" class="btn btn-danger" value="삭제" onclick="deleteBoard();">
				</form>
			</div>
		</div>
		<div id="comment" style="border: 1px solid black; width: 100%; height: 500px;">
			<h3>공연 후기</h3>
				<div style="width: 80%; height: 70px; background-color: #d1d2d3; margin: 0 auto;">
					<div style="width: 85%; height:50px; background-color: blue; display: inline-flex; margin-left: 50px; margin-top: 10px;">
						@if(Auth::check())
							<img src="img/{{Auth::user()->user_profile}}" style="width: 50px; height: 50px;">
						@else
							<img src="img/base.jpg" style="width: 50px; height: 50px;">
						@endif
							<textarea placeholder="댓글입력" style="width: 900px; height: 100%;" id="inputComment"></textarea>
							<div style="width: 80px; height: 50px; background-color: gray; text-align: center; line-height: 50px; cursor: pointer;" onclick="insertComment();" id="insertComment">등록</div>
					</div>
				</div>
			<br>
			<div id="user_comment" style="margin: 0 auto; border: 1px solid black; width: 80%; height: 300px; overflow: scroll;">
				<p>총 댓글 수&nbsp;<span id="cnt">{{$commentCnt}}</span></p>
				<div id="commentForm">
					<?php foreach($comment as $rows) : ?>
						<div style="width: 85%; border: 1px solid black; margin-left: 50px; display: inline-flex;">
							<div style="display: inline-flex;">
								<!-- 댓글 유저 정보-->
								<img src="img/{{$rows->user->user_profile}}" alt='nn' style="width: 80px; height: 80px;">
								<div style="width: 70px;">
									<p>{{$rows->user->user_name}}</p>
								</div>
							</div>
							<div style="width: 6%;"></div>
							<div><!-- 댓글, 시간 출력-->
								<p>{{$rows->comment_txt}}</p>
								<div>
									<p>{{$rows->comment_date}}</p>				
								</div>					
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			
		</div>
	</div>
@endsection