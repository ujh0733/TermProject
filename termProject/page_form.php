<?php
  session_start();

  require_once("tools.php");

  $mdao = new MemberDao();
  $bdao = new BoardDao();

  $user_name = getSessionUname();

  $user_id = getSessionUid();

  if($user_name == ""){
    sessionFailed();
  }

  $user_profile = "img/".$_SESSION["user_profile"];

  $board_info = $bdao->getPrint();//메인페이지 기간순으로 뿌리기
  $board_info_viewed = $bdao->getPrintViewed();//메인페이지 인기순으로 뿌리기


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Website Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

  <style>

  /* Make the image fully responsive */
  .carousel-inner img {
      width: 100%;
      height: 100%;
  }
  #demo{    
    width: 800px;
    height: 60%;
    margin:0 auto;
    margin-bottom: 20px;
  }

  .fakeimg {
      height: 200px;
      background: #aaa;
  }
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
    widows: 300px;
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
  <a class="navbar-brand" href="#">Menu</a>
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
      <li class="nav-item">
        <a class="nav-link" href="#">Example</a>
      </li>    
    </ul>
  </div>  
</nav>



  <div class="topdown">
    <a class="btn btn-secondary" href="#top">TOP</a>
    <a class="btn btn-secondary" href="#down">DOWN</a>
  </div>


<hr id="down">

<div style="margin-bottom:5%; height: 0; padding: 0; text-align: center">
  <p>Copyright &copy; <strong>Make by Ryu.</strong><br> All Right Reserverd.</p>
</div>

</body>
</html>