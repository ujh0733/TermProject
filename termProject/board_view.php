<?php
			require_once("tools.php");
			session_start();
			
			$board_num = $_REQUEST['board_num'];

			$bdao = new BoardDao();
			$mdao = new MemberDao();

			$user_name = getSessionUname();
			$user_id = getSessionUid();

			if($user_name == ""){
				sessionFailed();
			}

			$user_profile = "img/".$_SESSION["user_profile"];

			$board = $bdao->getBoard($board_num);

			$board_title = $board['board_title'];
			$board_context = $board['board_context'];
			$board_viewingClass = $board['board_viewingClass'];

			$viewingClass = $bdao->getViewingClass("$board_viewingClass");

			
			$title = str_replace("<", "&lt", $board_title);
			$title = str_replace(">", "&gt", $board_title);
			$title = str_replace("  ", "&nbsp&nbsp", $board_title);
			$context = str_replace("<", "&lt", $board_context);
			$context = str_replace(">", "&gt", $board_context);
			$context = str_replace("\n", "<br>", $board_context);
			
?>
<!DOCTYPE html>
<html>
<head>
	<title>Document</title>
		<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<style>
  .information{
    vertical-align: middle;
    text-align: right;
    padding: 0.5px;
    background-color: #bbb;
  }
  #print{
    display:inline-block;
  }
  #profile{
    width: 40px;
    height: 40px;
  }

  .topdown{
    display: inline-block;
    float: right;
    position:fixed;
    width: 55px;
    left: 94%;
    top: 75%;
  }

  .topdown > a{
    width: 55px;
    font-size: 1px;
    margin: 0 auto;
    display: inline-block;
    text-decoration: none;
  }

  #main_logo{
    width: 120px;
    height: 120px;
    position: relative;
    left: 45%;
    margin-bottom: 5px;
  }
  #search{
    width:450px;
    left: 30%;
    margin-bottom: 5px;
  }
  .item{
    width: 1200px;
  }
  .mini{
    width: 100%;
    height: 65%;
  }

  .card{
    width: 250px;
    height: 520px;
    float: left;
    margin : 10px;
  }
  .card:hover{
    border: 2px solid red;
  }
  .cardText{
    width:100%;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  #imgLink{
    float: right;
  }

  h3{
    text-align: center;
  }
  #tmain{
    margin-top: 5px;
  }
		#right{
			text-align: right;
		}
		img{
			width: 300px;
			height: 350px;

		}
		.info2{
			display: inline-flex;
		}
		.info{
			margin-left: 50px;
		}
	</style>
</head>
<body>
	<div class="information" id="top">
      
      <p id="print">환영합니다.&nbsp<?= $user_name?>님</p>
      <img src="<?= $user_profile ?>" id="profile" style="cursor:pointer" onclick="open_img('<?= $user_profile ?>')">
      <input type="button" class="btn btn-primary" name="ChangeInfor" onclick="location.href='updateInformation_page.php'" id="change_button" value="정보변경">
      <input type="button" class="btn btn-red" name="logout" onclick="location.href='logout.php'" value="로그아웃">
      <img src="img/cart.png" style="width: 45px; height: 45px; margin-right:2px;" onclick="location.href='cart.php'">
</div>

<div id="tmain">
  <form action="search.php" method="POST">
    <img src="img/main1.png" id="main_logo" onclick="location.href='main_page.php'">
    <div class="input-group" id="search">
      <input type="text" class="form-control" placeholder="Search.." id="search_bar" name="search_bar">
      <div class="input-group-append">
        <input class="btn btn-primary" type="submit" value="검색" id="search_btn">
      </div>
    </div>
  </form>
</div>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="main_page.php">Main</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="board_page.php">Documentation</a>
      </li>   
    </ul>
  </div>  
</nav>

	<div class="jumbotron">
		<div class="alert alert-dark" role="alert">
			<h4><strong><?= $board_title ?></strong></h4>
			<span>글쓴이 : <?= $board['board_writer'] ?></span>
			<br>
			<span>주최자 : <?= $board['board_opener'] ?></span>

			<p id="right">작성일 / <?= $board['board_posted'] ?> <br> 조회수 : <?= $board['board_viewed'] ?></p>

			<hr>
			<div class="info2">
				<img src="img/<?= $board['board_picture']?>">

<div class="list-group info">


  <a class="list-group-item list-group-item-action active">
    공연 정보
  </a>
  <a class="list-group-item list-group-item-action">공연 장소 : <?= $board['board_place'] ?></a>
  <a class="list-group-item list-group-item-action">관람 등급 : <?= $viewingClass ?></a>
  <a class="list-group-item list-group-item-action">공연 기간 : <?= $board['board_term_open']." ~ ".$board['board_term_close'] ?></a>
  <a class="list-group-item list-group-item-action disabled">가격 : <?= $board['board_price'] ?>원</a>
  <a class="list-group-item list-group-item-action disabled">공연 시간 : <?= $board['board_performanceTime'] ?>분</a>
</div>
	</div>

		
			<hr>

			<p><?= $board_context?></p>
		</div>
		<a onclick="location.href='board_page.php'" class="btn btn-primary">Back</a>
		<a href="updateBoard_page.php?id=<?= $board['board_writer'] ?>&num=<?= $board['board_num'] ?>" class="btn btn-warning">Update</a>
		<a href="deleteBoard.php?id=<?= $board['board_writer'] ?>&num=<?= $board['board_num'] ?>" class="btn btn-danger" onclick="return confirm('삭제할래?')">Delete</a>
	</div>
</body>
</html>