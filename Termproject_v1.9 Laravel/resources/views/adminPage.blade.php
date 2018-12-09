@extends('layout.app')

@section('head')
	<link rel="stylesheet" type="text/css" href="css/adminPage.css">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script type="text/javascript">
		var temp = '';
		function changeBoard(type){
			if(temp)
				$("#"+temp).css('display', 'none');
			this.temp = type;
			$("#"+type).css('display', '');
			/*var form = $("#"+type).html();
			$("#pageViwing").html(' ');
			$("#pageViwing").html(form);*/
		}
		$(document).ready(function(){
			changeBoard('boardManage');

			$("#genre").change(function(){
				changeForm();
			});

			$("#sort").change(function(){
				changeForm();
			});

			/*$("#setList").change(function(){
				alert('갯수');
			});*/

			$(".userAuth").change(function(){
				alert('tt');
			});
		});	

		function changeForm(type){
				
				var genre = $("#genre").val();
				var sort = $("#sort").val();
				$.get('adminAjax', {genre:genre, sort:sort}, function(data){
					if(data){
						$("#boardManageFormTbody").html(' ');
						var rs = '';
						for(var i = 0; i < data.length; i++){
							rs += '<tr onclick="location.href=\'board_view?board_num='+data[i].board_num+'\'">';
							rs += '<td>'+data[i].board_title+'</td>';
							rs += '<td>'+data[i].board_posted+'</td>';
							rs += '<td>'+data[i].board_term_open+'</td>';
							rs += '<td>'+data[i].board_term_close+'</td>';
							rs += '<td>'+data[i].board_viewed+'</td>';
							rs += '<td>'+data[i].board_performanceTime+'</td>';
							rs += '<td>'+data[i].board_viewingClass+'</td>';
							rs += '<td>'+data[i].board_price+'</td>';
							rs += '</tr>';
						}
						$("#boardManageFormTbody").html(rs);
					}else{
						alert('데이터 호출 실패..');
					}
				});
			}

			function change(type){
				var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
				var ip = $("#banInput").val();
				$.post('adminPostAjax', {type:type, ip:ip, _token:CSRF_TOKEN}, function(data){
					if(data){
						var rs = "<tr><td>"+data.ip+"</td><td>"+data.date+"</td></tr>";
						$("#ipForm tbody").append(rs);

						alert("IP : "+data.ip+"밴 완료!");
					}else{
						alert('호출 실패..');
					}
				});
			}

	</script>
@endsection

@section('content')
	<div class="jumbotron" style="width: 90%; margin: 0 auto; display: flex;">
		<nav>
			<div id="navTitle">
				<strong>관리자 페이지</strong>
			</div>
			<div id="adminPageList">
				<div onclick="changeBoard('boardManage')">
					<strong>글 관리</strong>
				</div>
				<div onclick="changeBoard('memberManage')">
					<strong>회원 관리</strong>
				</div>
				<div onclick="changeBoard('ipManage')">
					<strong>IP 관리</strong>
				</div>
				<div onclick="changeBoard('questionManage')">
					<strong>문의 관리</strong>
				</div>
			</div>
		</nav>
		<div id="adminPage_body">
			<div id="adminPageTop">
				<div>
					<img src="img/page/adminPage_progress.png">
					<div>
						<span>현재 공연 수!</span>
						<p>{{$nowBoardCnt}}개</p>
					</div>
				</div>
				<div>
					<img src="img/page/myPage_ticket.png">
					<div>
						<span>누적 공연 수!</span>
						<p>{{$allBoardCnt}}개</p>
					</div>
				</div>
				<div>
					<img src="img/page/adminPage_user.png">
					<div>
						<span>현재 유저!</span>
						<p>{{$userCnt}}명</p>
					</div>
				</div>
			</div>
			<div id="adminPageForm">
				<!--
				<div id="pageViwing">

				</div>
			-->
				<!-- using ajax chage data -->
				<!-- board Management -->
				<div id="boardManage" style="display: none;">
					<div id="boardManageForm">
						<div style="align-items: center; margin: 0 auto;">
							<h4>글 관리</h4>
							<div style="float: right;">
								<select id="genre">
									<option value="All">All</option>
									<option value="Musical">뮤지컬</option>
									<option value="Concert">콘서트</option>
									<option value="Play">공연</option>
									<option value="Exibition">전시</option>
									<option value="Kids">아동</option>
								</select>
								<select id="sort">
									<option value="board_posted">작성일</option>
									<option value="board_term_open">개시일</option>
									<option value="board_term_close">종료일</option>
									<option value="board_viewed">조회수</option>
									<option value="board_performanceTime">시간</option>
									<option value="board_viewingClass">등급</option>
									<option value="board_price">가격</option>
								</select>
								<select id="setList">
									<option>5</option>
									<option>10</option>
									<option>15</option>
								</select>
							</div>
						</div>
						<div id="table">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>제목</th>
										<th>작성일</th>
										<th>개시일</th>
										<th>종료일</th>
										<th>조회</th>
										<th>시간</th>
										<th>등급</th>
										<th>가격</th>
									</tr>
								</thead>
								<tbody id="boardManageFormTbody">
									@foreach($boardList as $row)
										<tr onclick="location.href='board_view?board_num={{$row->board_num}}'">  
								            <td>{{$row->board_title}}</td>
								            <td>{{$row->board_posted}}</td>
								            <td>{{$row->board_term_open}}</td>
								            <td>{{$row->board_term_close}}</td>
								            <td>{{$row->board_viewed}}</td>
								            <td>{{$row->board_performanceTime}}</td>
								            <td>{{$row->board_viewingClass}}</td>
								            <td>{{$row->board_price}}</td>
								          </tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- member Management -->
				<div id="memberManage" style="display: none;">
					<div id="memberManageForm">
						<h4>회원 관리</h4>
						<div>
							<table class="table table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>email</th>
										<th>auth</th>
										<th>phone</th>
									</tr>
								</thead>
								<tbody>
									@foreach($memberList as $row)
										<tr>  
								            <td>{{$row->user_id}}</td>
								            <td>{{$row->email}}</td>
								            <td>
								            	<select class="userAuth">
								            		<option>{{$row->user_auth}}</option>
									            	<option>A</option>
									            	<option>B</option>
								            	</select>
								            </td>
								            <td>{{$row->user_phone}}</td>
								          </tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- IP Ban Management -->
				<div id="ipManage" style="display: none;">
					<div id="ipManageForm">
						<h4>IP 관리</h4>
						<div id="banForm">
							<input type="text" class="form-control" id="banInput" placeholder="밴할 IP를 입력해 주세요">
							<button class="btn btn-primary" onclick="change('ban')">확인</button>
						</div>
						<div id="ipForm">
							<table class="table table-hover">
								<thead>
									<tr>
										<th>IP</th>
										<th>Ban Date</th>
									</tr>
								</thead>
								<tbody>
									@foreach($ipList as $row)
										<tr>  
								        	<td>{{$row->ip_address}}</td>
								            <td>{{$row->ban_date}}</td>
								         </tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- User's Question Management -->
				<div id="questionManage" style="display: none">
					<div id="questionManageForm">
						<h4>문의 관리</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection