@if(Session::has('alert'))
	<script>
		alert('{{Session::get("alert")}}');
	</script>
@endif
<!DOCTYPE html>
<html>
<head>
  <link rel="icon" href="img/main1.png">
  <title>Ticket Wave</title>
  <meta charset="utf-8">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>

  <script type="text/javascript">
  	function login_page(){
			var left = document.body.clientWidth/2+"px";
			var top = screen.height/2+"px";

			window.open("login_page", "", "width=500, height=700, left="+left+", top="+top+"");
		}
  </script>

	@yield('head')

</head>

<body>
	<div class="information" id="top" >
	  @if(!Auth::check())
	    <input type="button" name="login" onclick="login_page();" class="btn btn-primary" value="로그인">
	    <input type="button" name="signup" onclick="location.href='signUp_page'" class="btn btn-primary" value="회원가입">
	  @else
	  <div style="display: inline-flex;">
	  	<form action="{{ route('logout') }}" method="POST">
	  		<?= csrf_field(); ?>
	      <p id="print">환영합니다.&nbsp{{Auth::user()->user_name}}님</p>
	      <img src="img/{{Auth::user()->user_profile}}" id="profile" style="cursor:pointer" onclick="open_img('{{Auth::user()->user_profile}}')">
	      <input type="button" class="btn btn-primary" name="ChangeInfor" onclick="location.href='updateInformation_page'" id="change_button" value="정보변경">
	      <input type="button" class="btn btn-primary" onclick="location.href='myPage'" value="마이페이지">
	      <input type="submit" class="btn btn-red" value="로그아웃">
	  	</form>
	  </div>
	  @endif
	        <img src="img/cart.png" style="width: 45px; height: 45px; margin-right:2px;" onclick="location.href='cart'">
	</div>

	<div id="tmain">
	  <form action="search" method="POST">
	    @csrf
	    <img src="img/main1.png" id="main_logo" onclick="location.href='/'">
	    <div class="input-group" id="search">

	      <div>
	        <select class="btn btn-light" style="border: 1px solid black">
	          <option value="title">제목</option>
	          <option value="place">장소</option>
	          <option value="term">기간</option>
	        </select>
	      </div>

	        <input type="text" class="form-control" placeholder="Search.." id="search_bar" name="search_bar">
	     
	      <div class="input-group-append" >
	        <input class="btn btn-primary" type="submit" value="검색" id="search_btn">
	      </div>

	    </div>
	  </form>
	</div>

	<ul id="top_menu">
	  <li class="menu_list" onclick="location.href='/'">
	    <b>Main</b>
	  </li>
	  <li class="menu_list" onclick="location.href='board_page'">
	    <b>모든공연</b>
	  </li>
	  <li class="menu_list" onclick="location.href='board_page_list?genre=M'">
	    <b>뮤지컬</b>
	  </li>
	  <li class="menu_list" onclick="location.href='board_page_list?genre=C'">
	    <b>콘서트</b>
	  </li>
	  <li class="menu_list" onclick="location.href='board_page_list?genre=P'">
	    <b>연극</b>
	  </li>
	  <li class="menu_list" onclick="location.href='board_page_list?genre=E'">
	    <b>전시</b>
	  </li>
	  <li class="menu_list" onclick="location.href='board_page_list?genre=K'">
	    <b>아동</b>
	  </li>
	</ul>

		@yield('content')

	  <div class="topdown">
	    <a class="btn btn-secondary" href="#top">TOP</a>
	    <a class="btn btn-secondary" href="#down">DOWN</a>
	  </div>
	  <br>


	<hr id="down">

	<div style="margin-bottom:5%; height: 0; padding: 0; text-align: center">
	  <p>Copyright &copy; <strong>Make by Ryu.</strong><br> All Right Reserverd.</p>
	</div>
</body>
</html>