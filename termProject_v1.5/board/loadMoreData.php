<?php
	require('BoardDAO.php');

	$bdao = new BoardDao();

	$start = $_POST['start'];
	$list = $_POST['list'];
	$genre = $_POST['genre'];

	$msgs = $bdao->getGenreManyMsgs($start, $list, $genre);
?>
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