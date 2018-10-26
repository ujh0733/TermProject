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