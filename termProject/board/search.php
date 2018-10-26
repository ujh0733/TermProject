<?php
  session_start();

  require_once("../member/MemberDAO.php");
  require_once("../tools.php");

  $mdao = new MemberDao();
  $bdao = new BoardDao();

  $user_name = getSessionUname();

  $user_id = getSessionUid();

  if($user_name == ""){
    sessionFailed();
  }

  $user_profile = "../img/".$_SESSION["user_profile"];

  $search = requestValue('search_bar');

  if($search == "")
    $search = NULL;

  $result = $bdao->selectSearch($search);


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("../html_header.php") ?>
</head>
<body>

<?php require_once("../menu.php") ?>

<div class="container">

  <?php if($search == NULL) : ?>
    <h1 style="text-align: center;">검색어를 입력해 주세요</h1>
  <?php else :?>

<?php if($result) : ?>
<h1 style="text-align: center;">'<span style="color:#7fd887"><?= $search ?></span>'의 검색 결과</h1>
	<div class="row">
	    <div class="item">

	<?php foreach($result as $val) :?>  
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

<?php else : ?>
		<h1 style="text-align: center;">'<?= $search ?>'에 해당하는 결과 값이 없습니다. ㅜㅜ</h1>
<?php endif ?>
<?php endif ?>
	  </div>
	</div>
</div>	<!-- container End-->

<?php require_once("../footer.php") ?>

</body>
</html>