@if(Session::has('alert'))
  <script>
    alert('{{Session::get("alert")}}');
  </script>
@endif

<!doctype html>
<html lang="en">
  <head>
    <link rel="icon" href="/php2/termProject/img/main1.png">
    <title>Ticket Wave</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/signin.css">
  </head>

  <body class="text-center">

    <form class="form-signin" action="{{ route('login') }}" method="POST">
      @csrf

      @if(Session::has('board_num'))
         <input type="hidden" name="board_num" value="{{Session::get('board_num')}}">
      @endif

      <img class="mb-4" src="img/page/main1.png" alt="" width="72" height="72">

      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>

      <label for="inputID" class="sr-only">ID</label>
        <input type="text" id="inputID" class="form-control" placeholder="ID" required autofocus name="user_id">

      <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>


      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>

      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <button class="btn btn-lg black btn-block" onclick="location.href='signUp_page'">Sign Up</button>

      <p class="mt-5 mb-3 text-muted">Copyright &copy; <strong>Make by Ryu.</strong><br> All Right Reserverd.</p>
    </form>
  </body>
</html>