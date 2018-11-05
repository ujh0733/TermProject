<?php
			require_once("../tools.php");
			session_start();
			
			$board_num = $_REQUEST['board_num'];

			$bdao = new BoardDao();
			$mdao = new MemberDao();
/*
			$user_name = getSessionUname();
			$user_id = getSessionUid();

			if($user_name == ""){
				sessionFailed();
			}*/

      $page = requestValue("page");

			//$user_profile = "../img/".$_SESSION["user_profile"];

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
	<?php require_once("../html_header.php") ?>
	<style>
  
	</style>
</head>
<body>
	<?php require_once("../menu.php") ?>

	<div class="jumbotron" id="board_body">
		<div class="alert alert-dark" role="alert">
			<h4><strong><?= $board_title ?></strong></h4>
			<span>글쓴이 : <?= $board['board_writer'] ?></span>
			<br>
			<span>주최자 : <?= $board['board_opener'] ?></span>

			<p id="right">작성일 / <?= $board['board_posted'] ?> <br> 조회수 : <?= $board['board_viewed'] ?></p>

			<hr>
			<div class="info2">
				<img src="../img/<?= $board['board_picture']?>">

				<div class="list-group info">

				  <a class="list-group-item list-group-item-action active">
				    공연 정보
				  </a>
				  <a class="list-group-item list-group-item-action">공연 장소 : <?= $board['board_place'] ?>&nbsp;&nbsp;<input type="button" name="maps" value="지도보기" onclick="open_Theater(<?= $board_num ?>);"></a>
				  <a class="list-group-item list-group-item-action">관람 등급 : <?= $viewingClass ?></a>
				  <a class="list-group-item list-group-item-action">공연 기간 : <?= $board['board_term_open']." ~ ".$board['board_term_close'] ?></a>
				  <a class="list-group-item list-group-item-action disabled">가격 : <?= $board['board_price'] ?>원</a>
				  <a class="list-group-item list-group-item-action disabled">공연 시간 : <?= $board['board_performanceTime'] ?>분</a>
				</div>
	</div>
<div style="float: right;">
	<form action="../member/login_page.php?board_num=<?= $board_num ?>&page=<?= $page ?>" method="POST">
	<?php if($user_id) : ?>
		<input type="button" name="buy" onclick="location.href='buy.php?num=<?= $board['board_num'] ?>'" class="btn btn-primary" value="예매하기">
		<input type="button" name="cart" onclick="location.href='cart.php?num=<?= $board['board_num'] ?>'" class="btn btn-primary" value="장바구니 담기">
	<?php else : ?>
		<input type="submit" name="buy" onclick="return confirm('예매를 위해서는 로그인을 해야 합니다.')" class="btn btn-primary" value="예매하기">
		<input type="button" name="cart" onclick="location.href='cart.php?num=<?= $board['board_num'] ?>'" class="btn btn-primary" value="장바구니 담기">
	<?php endif ?>
	</form>
</div>
		
			<hr>
			<h3>내용</h3>
			<p><?= $board_context?></p>
		</div>
		<a onclick="location.href='board_page.php?page=<?= $page ?>'" class="btn btn-primary">목록</a>
		<a href="updateBoard_page.php?id=<?= $board['board_writer'] ?>&num=<?= $board['board_num'] ?>" class="btn btn-warning">수정</a>
		<a href="deleteBoard.php?id=<?= $board['board_writer'] ?>&num=<?= $board['board_num'] ?>&page=<?= $page ?>" class="btn btn-danger" onclick="return confirm('삭제할래?')">삭제</a>
	</div>

<?php require_once("../footer.php") ?>

</body>
</html>