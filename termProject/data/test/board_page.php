<?php
  require_once("../tools.php");

  session_start();

  $mdao = new MemberDao();
  $bdao = new BoardDao();

  $board_info = $bdao->getBoardPage();

  $user_name = getSessionUname();

  $user_id = getSessionUid();

  if($user_name == ""){
    sessionFailed();
  }

  $user_profile = "../img/".$_SESSION["user_profile"];

  //Pagenation
  $page = requestValue("page");

  define("NUM_LINES",      2);
  define("NUM_PAGE_LINKS", 2);

  $dao = new BoardDao();
  $numMsgs = $dao->getNumMsgs();

  if($numMsgs > 0){
    //전체 페이지 수 구하기
    $numPages = ceil($numMsgs / NUM_LINES);

    if($page < 1){
      $page = 1;
    }
    if($page > $numPages){
      $page = $numPages;
    }

    //리스트에 보일 게시글 데이터 읽기
    $start = ($page - 1) * NUM_LINES; //첫 줄의 레코드 번호
    $msgs = $dao->getManyMsgs($start, NUM_LINES);

    //페이지네이션 컨트롤의 처음/마지막 페이지 링크 번호 계산
    $firstLink = floor(($page - 1) / NUM_PAGE_LINKS) * NUM_PAGE_LINKS + 1;
    $lastLink = $firstLink + NUM_PAGE_LINKS - 1;
    if($lastLink > $numPages){
      $lastLink = $numPages;
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="img/main1.png">
  <title>Ticket Wave</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../board.css">

  <style>
  .menu_list:nth-child(3){
    color: #7fd887;
    border-bottom: solid 2px #7fd887;
  }
  </style>
</head>
<body>

<div class="information" id="top">
      <p id="print">환영합니다.&nbsp<?= $user_name?>님</p>
      <img src="<?= $user_profile ?>" id="profile" style="cursor:pointer" onclick="open_img('<?= $user_profile ?>')">
      <input type="button" class="btn btn-primary" name="ChangeInfor" onclick="location.href='updateInformation_page.php'" id="change_button" value="정보변경">
      <input type="button" class="btn btn-red" name="logout" onclick="location.href='logout.php'" value="로그아웃">
      <img src="../img/cart.png" style="width: 45px; height: 45px; margin-right:2px;" onclick="location.href='cart.php'">
</div>

<div id="tmain">
  <form action="search.php" method="POST">
    <img src="../img/main1.png" id="main_logo" onclick="location.href='main_page.php'">
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
  <li class="menu_list" onclick="location.href='main_page.php'">
    <b>Main</b>
  </li>
  <li class="menu_list">
    <b>Home</b>
  </li>
  <li class="menu_list" onclick="location.href='board_page.php'">
    <b>Documentation</b>
  </li>
</ul>



  <?php if($numMsgs > 0) : ?>
 <div class="main_board">
   <table class="table table-hover">  
      <thead style="background-color: skyblue">
        <tr>
          <th>#</th>
          <th>Writer</th>
          <th>Title</th>
          <th>Date</th>
          <th>Viewd</th>
        </tr>
      </thead>

      <tbody>

      <?php foreach($msgs as $row) :?>
        <tr onclick="location.href='board_view_cnt.php?board_num=<?= $row['board_num']?>&page=<?= $page ?>'">
          <td><?= $row['board_num']?></td>
          <td><?= $row['board_opener']?></td>
          <td><?= $row['board_title']?></td>
          <td><?= $row['board_posted']?></td>
          <td><?= $row['board_viewed']?></td>
        </tr>
      </tbody>
      <?php endforeach ?>      
    </table>
  </div>

      <br>
      <div id="page" style="width: 301px; margin:0 auto;">
        <ul class="pagination">
        <?php if($firstLink > 1) : ?>   
          <li class="page-item">
          <a class="page-link" href="<?= bdUrl("board_page.php", 0, $page - NUM_PAGE_LINKS) ?>">&laquo</a>&nbsp;
          </li>
        <?php else : ?>
          <li class="page-item disabled">
            <span class="page-link">&laquo</span>
          </li>
        <?php endif ?>

        <?php if($page > 1) :?>
          <li class="page-item">
            <a class="page-link" href="<?= bdUrl("board_page.php", 0, $page - 1) ?>">&lt;</a>
          </li>    
        <?php else : ?>
          <li class="page-item disabled">
            <span class="page-link">&lt;</span>
          </li>
        <?php endif ?>

        <?php for($i = $firstLink; $i <= $lastLink; $i++) : ?>
          <?php if($i == $page) : ?>
            <li class="page-item">
            <a class="page-link" href="<?= bdUrl("board_page.php", 0, $i) ?>"><b><?= $i ?></b></a>&nbsp;
            </li>
          <?php else : ?>
            <li class="page-item">
            <a class="page-link" href="<?= bdUrl("board_page.php", 0, $i) ?>"><?= $i ?></a>&nbsp;
            </li>
          <?php endif ?>
        <?php endfor ?>


        <?php if($lastLink < $numPages) : ?>
          <li class="page-item">
            <a class="page-link" href="<?= bdUrl("board_page.php", 0, $page + 1) ?>">&gt;</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="<?= bdUrl("board_page.php", 0, $page + NUM_PAGE_LINKS) ?>">&raquo</a>
          </li>
        <?php else :?>
          <li class="page-item disabled">
            <a class="page-link">&gt;</a>
          </li>
          <li class="page-item disabled">
            <a class="page-link">&raquo</a>
          </li>
        <?php endif ?>

      <?php endif ?>

      <?php if($page != 1) : ?>
        <li class="page-item">
          <a class="page-link">첫 페이지</a>
        </li>
      <?php else : ?>
        <li class="page-item disabled">
          <a class="page-link">첫 페이지</a>
        </li>
      <?php endif ?>
      </ul>
  
    
    <div class="float-right" style="">
      <a onclick="location.href='write_page.php'" class="btn btn-primary">Write</a>
      <a onclick="location.href='main_page.php'" class="btn btn-primary">Main</a>
      
    </div>
  <br>
</div>   

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
<script>
            $('.page-link').click( function() {
                $('#main_board').html('');
                $.ajax({
                    url:'ajaxTest.php',
                    dataType:'html',
                    type:'POST',
                    data:{'board_page':$('.page-link').val()},
                    success:function(data){
                        $("#main_board").html(data);
                    }
                });
            })
        </script>
</html>



 