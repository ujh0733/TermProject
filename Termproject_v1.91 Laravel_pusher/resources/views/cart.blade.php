@extends('layout.app')

@section('head')
	<link rel="stylesheet" type="text/css" href="css/board.css">
	<link rel="stylesheet" type="text/css" href="css/cart.css">
	<script>
		function deleteCookie(){
			var date = new Date();
			date.setDate(date.getDate()-1);
			var userId = '{{$user_id}}';
			document.cookie = userId+'=; expires='+date.toGMTString()+";";
			alert('장바구니 항목을 모두 비웠습니다.');
			location.reload();
			location.reload();
		}
	</script>
@endsection

@section('content')
		<div id="cartForm">
				<div id="cartTop">
					<img src="img/page/cart.png">
					<h3>장바구니</h3>
				</div>
				<div id="cartBottom">
					<div id="cartData">
						
						<div id="cartDataForm">
							@if($cookie_board)
								@foreach($cart as $rows)
									<div id="cartRows" onclick="location.href='board_view'">
										<img src="img/{{$rows->board_picture}}"/>
										<div>{{$rows->board_title}}</div>
										<div>{{$rows->board_term_open}}</div>
										<div>{{$rows->board_term_close}}</div>
										<div>{{$rows->board_place}}</div>
										<div>{{$rows->board_price}}원</div>
									</div>
								@endforeach
							@else
								<p>장바구니에 담긴 상품이 없습니다.</p>
							@endif
						</div>
					</div>
					<div id="cartButton">
						<input type="button" name="buy" value="구매하기"" class="btn btn-primary"  onclick="alert('buy!!');">
						&nbsp;
						<input type="submit" name="delete" class="btn btn-danger" value="모두삭제" onclick="deleteCookie();">
					</div>
				</div>
		</div>
@endsection