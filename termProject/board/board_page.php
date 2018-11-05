<?php
  require_once("../tools.php");
  session_start();

  $mdao = new MemberDao();
  $bdao = new BoardDao();

  $board_info = $bdao->getBoardPage();

/*
  $user_name = getSessionUname();

  $user_id = getSessionUid();

  $auth = $mdao->authCheck($user_id);

  if($user_name == ""){
    sessionFailed();
  }
  $user_profile = "../img/".$_SESSION["user_profile"];*/


  //Pagenation
  $page = requestValue("page");

  define("NUM_LINES",      5);
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
  <?php require_once("../html_header.php") ?>

  <style>
  .menu_list:nth-child(3){
    color: #7fd887;
    border-bottom: solid 2px #7fd887;
  }
  </style>
</head>
<body>

  <?php require_once("../menu.php") ?>

<form action="deleteBoard.php" method="POST">
<div class="board">
  <?php if($numMsgs > 0) : ?>
   <table class="table table-hover">  
      <thead style="background-color: skyblue">
        <tr>

          <?php if($user_id != "" && $auth == "TOP") : ?>
            <th>Sel</th>
          <?php endif ?>

          <th>#</th>
          <th>Writer</th>
          <th>Title</th>
          <th>Date</th>
          <th>Viewd</th>
        </tr>
      </thead>

      <tbody>

      <?php foreach($msgs as $row) :?>
        <?php if($user_id != "" && $auth == "TOP") : ?>

          <tr>
            <td><input type="checkbox" name="check[]" value="<?= $row['board_num']."," ?>"></td>
            <td onclick="location.href='board_view_cnt.php?board_num=<?= $row['board_num']?>&page=<?= $page ?>'"><?= $row['board_num']?></td>
            <td onclick="location.href='board_view_cnt.php?board_num=<?= $row['board_num']?>&page=<?= $page ?>'"><?= $row['board_opener']?></td>
            <td onclick="location.href='board_view_cnt.php?board_num=<?= $row['board_num']?>&page=<?= $page ?>'"><?= $row['board_title']?></td>
            <td onclick="location.href='board_view_cnt.php?board_num=<?= $row['board_num']?>&page=<?= $page ?>'"><?= $row['board_posted']?></td>
            <td onclick="location.href='board_view_cnt.php?board_num=<?= $row['board_num']?>&page=<?= $page ?>'"><?= $row['board_viewed']?></td>
          </tr>
      
        <?php else : ?>
          <tr onclick="location.href='board_view_cnt.php?board_num=<?= $row['board_num']?>&page=<?= $page ?>'">
            <td><?= $row['board_num']?></td>
            <td><?= $row['board_opener']?></td>
            <td><?= $row['board_title']?></td>
            <td><?= $row['board_posted']?></td>
            <td><?= $row['board_viewed']?></td>
          </tr>
        <?php endif ?>
      </tbody>
      <?php endforeach ?>      
    </table>

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
          <a class="page-link" href="<?= bdUrl("board_page.php", 0, 1) ?>">첫 페이지</a>
        </li>
      <?php else : ?>
        <li class="page-item disabled">
          <a class="page-link">첫 페이지</a>
        </li>
      <?php endif ?>
      </ul>
    </div>

    
    <div class="float-right" style="">

      <?php if($user_id != "" && $auth == "TOP") : ?>
        <input type="submit" name="delete" value="삭제" class="btn btn-danger" onclick="return confirm('선택한 항목을 삭제하시겠습니까?')">
      <?php endif ?>

      <a onclick="location.href='write_page.php'" class="btn btn-primary" style="color:white;">글쓰기</a>
      <a onclick="location.href='main_page.php'" class="btn btn-primary" style="color:white;">메인페이지</a>
      
    </div>
  <br>
</div>   
</form>
<?php require_once("../footer.php"); ?>

</body>
</html>



 