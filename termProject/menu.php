<div class="information" id="top">
      <p id="print">환영합니다.&nbsp<?= $user_name?>님</p>
      <img src="<?= $user_profile ?>" id="profile" style="cursor:pointer" onclick="open_img('../img/<?= $user_profile ?>')">
      <input type="button" class="btn btn-primary" name="ChangeInfor" onclick="location.href='../member/updateInformation_page.php'" id="change_button" value="정보변경">
      <input type="button" class="btn btn-red" name="logout" onclick="location.href='../member/logout.php'" value="로그아웃">
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