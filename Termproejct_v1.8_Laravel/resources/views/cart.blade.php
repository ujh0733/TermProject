@extends('layout.app')

@section('head')
	<link rel="stylesheet" type="text/css" href="css/board.css">
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
		<div style="width: 80%; height: 100%; margin: 0 auto; margin-top: 10px;">
			<div style="width: 95%; height: 100%; margin: 0 auto;">
				<div style="width: 95%; margin: 0 auto; border: 3px solid #bbb; padding: 10px;">
					<img src="../img/cart.png" style="width: 50px; height: 50px;">
					<h3 style="text-align: left;  float: left; line-height: 50px;">장바구니</h3>
				</div>
				<div style="width: 95%; height: 85%; background-color: #ccc; margin: 0 auto;">
					<div style="width: 95%; height: 60%; border: 2px ridge black; margin: 0 auto; margin-top: 20px;">
						
						<div style="margin: 0 auto; width: 95%; margin-top: 20px;">
							@if($cookie_board)
								@foreach($cart as $rows)
									<div style="display: flex; border: 1px solid black; margin-top: 2px;" onclick="location.href='board_view'">
										<img src="img/{{$rows->board_picture}}" style="width: 50px; height: 50px;">
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
					<div style="margin-left: 40%; margin-right: 60%; display: inline-flex;">
						<input type="button" name="buy" value="구매하기"" class="btn btn-primary"  onclick="alert('buy!!');">
						&nbsp;
						<input type="submit" name="delete" class="btn btn-danger" value="모두삭제" onclick="deleteCookie();">
					</div>
				</div>
			</div>
		</div>
@endsection