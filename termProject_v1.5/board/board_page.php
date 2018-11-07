<!DOCTYPE html>
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
  $genre = requestValue("genre");

  if(!$genre){
    changeColor(2);
  }
  if($genre){
    if($genre == 'M'){
      changeColor(3);
    }else if($genre == 'C'){
      changeColor(4);
    }else if($genre == 'P'){
      changeColor(5);
    }else if($genre == 'E'){
      changeColor(6);
    }else if($genre == 'K'){
      changeColor(7);
    }
  }

  function changeColor($num){
    ?>
      <script type="text/javascript">
        $(function(){
          $(".menu_list:nth-child(<?= $num ?>)").css({"color": "#7fd887", "border-bottom" : "solid 2px #7fd887"});
        })
      </script>
    <?php
  }

  define("NUM_LINES",      5);
  define("NUM_PAGE_LINKS", 5);

  $dao = new BoardDao();
  if($genre){
    $start = 0;
    $getCol = 8;
    $numMsgs = $dao->getGenreNumMsgs($genre);
/*
    if($numMsgs > 0){
      //전체 페이지 수 구하기
      $numPages = ceil($numMsgs / 8);

      if($page < 1){
        $page = 1;
      }
      if($page > $numPages){
        $page = $numPages;
      }
*/
      //리스트에 보일 게시글 데이터 읽기
      //$start = ($page - 1) * 8; //첫 줄의 레코드 번호
      $msgs = $dao->getGenreManyMsgs($start, $getCol, $genre);
/*
      //페이지네이션 컨트롤의 처음/마지막 페이지 링크 번호 계산
      $firstLink = floor(($page - 1) / NUM_PAGE_LINKS) * NUM_PAGE_LINKS + 1;
      $lastLink = $firstLink + NUM_PAGE_LINKS - 1;
      if($lastLink > $numPages){
        $lastLink = $numPages;
      }
    }*/
  }else{    //get으로 장르가 없을 떄
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
    }
?>


<html lang="en">
<head>
  <?php require_once("../html_header.php") ?>
  <!--
  <style>
  .menu_list:nth-child(2){
    color: #7fd887;
    border-bottom: solid 2px #7fd887;
  }
  </style>
-->
<style>
  .genreTitle{
    margin-top: 10px;
    color: #71c449;
  }
</style>
</head>
<script>
  $(window).scroll(function() {
    var last_id = <?= $start + $getCol ?>;
    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
      //alert('최하단');
      //$("#cont").append(test1);
      append_list();
    }
  });

  var start = 8;
  var list = 8;
  var genre = '<?= $genre ?>';

  function append_list(){
    $.post("loadMoreData.php", {start:start, list:list, genre:genre}, function(data){
      $("#cont").append(data);
      start += list;
    });
  }
</script>
<body>

  <?php require_once("../menu.php") ?>
   
<?php if(!$genre) : ?>
<form action="deleteBoard.php" method="POST">
<div class="board">
 <h2 class="genreTitle">모든 공연</h2>

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
      <div id="page" style="width: 420px; margin:0 auto;">
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
      <!--
      <a onclick="location.href='main_page.php'" class="btn btn-primary" style="color:white;">메인페이지</a>
      -->
    </div>
  <br>
</div>   
</form>
<?php else : ?>
  <div class="container">
    <h2 class="genreTitle"><?= $genre ?></h2>
    <div class="row" id="cont">
    <?php foreach($msgs as $val) :?>  
          <div class="card" onclick="location.href='board_view.php?board_num=<?= $val['board_num']?>'">
            <div id="card_img">
            <img class="card-img-top mini" src="../img/<?= $val['board_picture'] ?>" alt="None Img..">
            </div>
            <div class="card-body">
              <h5 class="card-title cardText"><strong><?= $val['board_title']?></strong></h5>
              <p class="card-text cardText"><?= $val['board_opener']?></p>
              <p class="card-text cardText"><?= $val['board_term_open']." ~ ".$val['board_term_close']?></p>
              <a href="board_view.php?board_num=<?= $val['board_num']?>" class="btn btn-primary" id="imgLink">자세히보기</a>
            </div>
          </div>
    <?php endforeach ?>
    </div>
  </div>     
<?php endif ?>

<?php require_once("../footer.php"); ?>

</body>
</html>