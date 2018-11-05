<?php
  require_once("../tools.php");

  session_start();

  $user_name = getSessionUname();

  $board_num = requestValue("board_num");
  $page = requestValue("page");
  /*if(!($user_name == "")){
    sessionKeep();
  }*/

?>
<!doctype html>
<html lang="en">
  <head>
    <?php require_once("../html_header.php") ?>
    <link rel="stylesheet" type="text/css" href="signin.css">
  </head>

  <body class="text-center">
    <form class="form-signin" action="login.php" method="POST">

      <input type="hidden" name="board_num" value="<?= $board_num ?>">
      <input type="hidden" name="page" value="<?= $page ?>">

      <img class="mb-4" src="../img/main1.png" alt="" width="72" height="72">

      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

      <label for="inputID" class="sr-only">ID</label>
        <input type="text" id="inputID" class="form-control" placeholder="ID" required autofocus name="id">

      <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pwd" required>

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <button class="btn btn-lg black btn-block" onclick="location.href='signUp_page.php'">Sign Up</button>

      <p class="mt-5 mb-3 text-muted">Copyright &copy; <strong>Make by Ryu.</strong><br> All Right Reserverd.</p>
    </form>
  </body>
</html>