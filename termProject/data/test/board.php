<?php
  require_once("../tools.php");

  $bdao = new BoardDao();

  $board_info = $bdao->getBoardPage();

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
</head>
<body>
  
<div id="main_board">
  <?php if($numMsgs > 0) : ?>
  
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
  
      <br>
      <div id="page" style="width: 301px; margin:0 auto;">
        <ul class="pagination">
        <?php if($firstLink > 1) : ?>   
          <li class="page-item">
            <input type="button" class="page-link" value="&laquo">
          </li>
        <?php endif ?>

        <?php if($page > 1) :?>
          <li class="page-item">
            <input type="button" class="page-link" value="&lt">
          </li>    
        <?php endif ?>

        <?php for($i = $firstLink; $i <= $lastLink; $i++) : ?>
          <?php if($i == $page) : ?>
            <li class="page-item">
              <input type="button" class="page-link" value="<?= $i ?>">
            </li>
          <?php else : ?>
            <li class="page-item">
              <input type="button" class="page-link" value="<?= $i ?>">
            </li>
          <?php endif ?>
        <?php endfor ?>


        <?php if($lastLink < $numPages) : ?>
          <li class="page-item">
           <input type="button" class="page-link" value="&gt">
          </li>
          <li class="page-item">
            <input type="button" class="page-link" value="&raquo">
          </li>
        <?php endif ?>

      <?php endif ?>
      </ul>
    </div>
   
   </div> 

    <div id="result3"></div>
    <input type="text" value="33" class="test">
    <br>
  <br>

</body>
        <script>
            $('.page-link').click( function() {
                $('#main_board').html('');
                $.ajax({
                    url:'ajaxTest.php',
                    dataType:'html',
                    type:'POST',
                    data:{'board_page':$('.test').val()},
                    success:function(data){
                        $("#main_board").html(data);
                    }
                });
            })
        </script>
</html>



 