<?php
  require_once("../tools.php");

  session_start();
  $user_id = getSessionUid();
  $user_name = getSessionUname();

  $board_writer = requestValue('id');
  $board_num = requestValue('num');

  $bdao = new BoardDao();
  $mdao = new MemberDao();

  $user_profile = $mdao->getProfile($user_id);

  $board_info = $bdao->getBoard($board_num);

  if($user_id != $board_writer){
?>
  <script>
    alert('작성자만 수정할 수 있습니다!');
    history.back();
  </script>
<?php
  }

  $board_genre = $bdao->getBoardGenre($board_info['board_genre']);

  $start_term = $board_info['board_term_open'];
    $start = explode("-", $start_term);//날짜 나누기
      $start_year = $start[0];
      $start_month = $start[1];
      $start_day = $start[2];
  $end_term = $board_info['board_term_close'];
    $end = explode("-", $end_term);//날짜 나누기
      $end_year = $start[0];
      $end_month = $start[1];
      $end_day = $start[2];

  $board_viewingClass = $bdao->getBoardViewingClass($board_info['board_viewingClass']);


?>
<!DOCTYPE html>
<html>
<head>
  <?php require_once("../html_header.php") ?>

  <style type="text/css">
    #context{
      height: 300px;
    }
    #example{
        width: 300px;
        height: 355px;
        margin-top: 5px;
      }
      #preview{
        margin-top: 5px;
      }
    
  </style>
</head>
<body>
  <?php require_once("../menu.php") ?>

  <div class="jumbotron">
    <form action="updateBoard.php" method="POST" enctype="multipart/form-data">

      <div class="alert alert-primary" role="alert">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" value="<?= $board_info['board_title'] ?>">
      </div>

      <!--Value값은 사용자 아이디가 들어가야 함 -->
      <input type="hidden" name="writer" value="<?= $board_writer ?>">

      <input type="hidden" name="num" value="<?= $board_num ?>">

      <div class="alert"> <!--개최자 입력-->
        <label for="opener">Opener</label>
        <input type="text" class="form-control" id="opener" placeholder="Enter Opener" name="opener" value="<?= $board_info['board_opener'] ?>" required>
      </div>

   <!--공연 시작/종료 날짜-->
    <div class="alert">
        <p>공연 개시 일자</p>
            <div class="row">
              
              <div>
                <label for="start_year">Year</label>
                <select class="custom-select d-block w-100" id="start_year" name="start_year" required>
                  <option value="<?= $start_year ?>"><?= $start_year ?></option>
<?php
                    for($i = 2010; $i < 2020; $i++){
                      echo "<option>$i</option>";
                    }

?>
                </select>
                <div class="invalid-feedback">
                  Please select a valid Year.
                </div>
              </div>

              <div>
                <label for="start_month">Month</label>
                <select class="custom-select d-block w-100" id="start_month" name="start_month" required>
                  <option value="<?= $start_month ?>"><?= $start_month ?></option>
<?php
                    for($i = 1; $i < 13; $i++){
                      echo "<option>$i</option>";
                    }

?>
                </select>
                <div class="invalid-feedback">
                  Please provide a Month.
                </div>
              </div>

               <div>
                <label for="start_day">Day</label>
                <select class="custom-select d-block w-100" id="start_day" name="start_day" required>
                  <option value="<?= $start_day ?>"><?= $start_day ?></option>
<?php
                    for($i = 1; $i < 30; $i++){
                      echo "<option>$i</option>";
                    }

?>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid Day.
                </div>
              </div>
          </div>  <!-- Start Day End-->

        <div class="end">
           <p>공연 종료 일자</p>
          <div class="row">
            <div>
                <label for="end_year">Year</label>
                <select class="custom-select d-block w-100" id="end_year" name="end_year" required>
                  <option value="<?= $end_year ?>"><?= $end_year ?></option>
<?php
                    for($i = 2010; $i < 2020; $i++){
                      echo "<option>$i</option>";
                    }

?>
                </select>
                <div class="invalid-feedback">
                  Please select a valid Year.
                </div>
              </div>

              <div>
                <label for="end_month">Month</label>
                <select class="custom-select d-block w-100" id="end_month" name="end_month" required>
                  <option value="<?= $end_month ?>"><?= $end_month ?></option>
<?php
                    for($i = 01; $i < 13; $i++){
                      echo "<option>$i</option>";
                    }

?>
                </select>
                <div class="invalid-feedback">
                  Please provide a Month.
                </div>
              </div>

               <div>
                <label for="end_day">Day</label>
                <select class="custom-select d-block w-100" id="end_day" name="end_day" required>
                  <option value="<?= $end_day ?>"><?= $end_day ?></option>
<?php
                    for($i = 1; $i < 30; $i++){
                      echo "<option>$i</option>";
                    }

?>
                </select>
                <div class="invalid-feedback">
                  Please provide a valid Day.
                </div>
              </div>
            </div><!-- End Day End-->
      </div>  <!-- row End-->   
      </div>

      <div id="genre_form">   <!-- 장르 -->
        <p>공연 장르</p>
        <select id="genre" name="genre" value="<?= $board_info['board_genre'] ?>" required>
          <option value="<?= $board_info['board_genre'] ?>"><?= $board_genre ?></option>
          <option value="M">뮤지컬</option>
          <option value="C">콘서트</option>
          <option value="P">연극</option>
          <option value="E">전시</option>
          <option value="K">아동</option>
        </select>
      </div>

      <div id="place_form">
        <p>공연 장소</p>
        <input type="" name="place" id="place" value="<?= $board_info['board_place'] ?>" required>
      </div>

      <div>
        <p>공연 시간</p>
        <input type="text" name="time" id="time" value="<?= $board_info['board_performanceTime'] ?>"required>
      </div>

      <div id="price_form">
        <p>입장 가격</p>
        <input type="text" name="price" id="price" value="<?= $board_info['board_price'] ?>"required>
      </div>

      <div id="viewingClass_form">
        <p>관람 등급</p>
        <select class="custom-select" id="viewingClass" name="viewingClass" required>
          <option value="<?= $board_info['board_viewingClass'] ?>"> <?= $board_viewingClass ?> </option>
          <option value="0">전체이용가</option>
          <option value="7">7세이상 이용가</option>
          <option value="12">12세이상 이용가</option>
          <option value="15">15세이상 이용가</option>
          <option value="19">청소년 관람 불가</option>
        </select>
      </div>

      <div>
          <label for="profile">Poster Select</label>
            <div id="imgSelect">

              <input type="hidden" name="no_select" value="<?= $board_info['board_picture']?>" readonly>
              <input type="file" id="profile_picture" name="board_picture" class="btn btn-primary" accept=".jpg, .jpeg, .png, .gif">
              <div id="preview">
                <label for="upload"><img src="../img/<?= $board_info['board_picture'] ?>" id="example"></label>
              </div>
          </div>
          <!--
              <div>
                <label for="profile">Profile Select</label>
                <div id="imgSelect">
                  <input type="file" id="profile" name="user_profile" class="btn btn-primary" accept=".jpg, .jpeg, .png, .gif">
                  <div id="preview">
                    <label for="upload"><img src="../img/<?= $user_profile ?>" id="example"></label>
                  </div>
               </div>
              </div>
            -->
      </div>

      <div class="from-group">
        <label for="context">Context</label>
        <textarea id="context" class="form-control" name="context"><?= $board_info['board_context'] ?></textarea>
      </div>
      <div class="from-group">&nbsp</div>

      <input type="submit" class="btn btn-primary" value="수정 완료">
    </form>
  </div>
</body>
</html>