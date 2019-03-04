<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
  <script type="text/javascript"> 
    Pusher.logToConsole = true;

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var pusher = new Pusher('ec792b864a013c22fe72', {
      auth: {
        headers: {
          'X-CSRF-Token': CSRF_TOKEN,
        }
      },
      cluster: 'ap3',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
      channel.bind('my-event', function(data) {
        var num = JSON.stringify(data.message);
        var length = num.length;
        num = num.substr(1, length-2);

        if($("#"+num).hasClass('disable')){
          $("#"+num).toggleClass('click');
          }else{
          $("#"+num).toggleClass('disable');
        }
      });

    $(document).ready(function(){

      $(".btn").click(function(){
        var num = $(this).attr('id');
        
        $(function(){
          $.post("pusherAjaxTest", {num:num, _token:CSRF_TOKEN},
            function(data){
              if(data){
              }
          });
        });
      });
    });
  </script>
  <style type="text/css">
    div{
      width: 100px;
      height: 100px;
      background-color: gray;
      text-align: center;
      line-height: 100px;
      margin-top: 10px;
      display: inline-flex;
    }
    .disable{
      background-color: gray;
    }
    .click{
      background-color: red;
      color: white;
    }
  </style>
</head>
<body>
  <hr>
    <input type="submit" class="btn" name="send" id="send" value="푸셔!">

      <div class="btn disable" id="1">
        1
      </div>
      <div class="btn disable" id="2">
        2
      </div>
      <div class="btn disable" id="3">
        3
      </div>
</body>
</html>