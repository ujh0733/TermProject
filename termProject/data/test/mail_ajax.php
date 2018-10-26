<script type="text/javascript" src="../../jquery-3.3.1.min.js"></script>
<?php require_once("../../tools.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title></title>

</head>
<body>
     <div class="mb-3">
              <div id="result"></div>
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="your@example.com" name="user_email" required>
              <div class="invalid-feedback">
                Please Input Your Email.
              </div>
              <input type="button" value="메일 인증" class="btn btn-primary" name="mail_check" id="mail_check" onclick="open_window('../../mail_check_page.php')">
              <input type="text" name="email_result" id="email_result" value="tt" style="border: none; color: red;">
    </div>
</body>
</html>
    <script type="text/javascript">
      function change(rs){
        document.getElementById('email_result').val(rs);
      }
    </script>
<!--
    <script type="text/javascript" src="../jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      
      $('#mail_check').click( function() {    //메일인증 ajax
                $("#result").html('');
                $.ajax({
                    url:'ajaxServer.php',
                    dataType:'json',
                    type:'POST',
                    data:{'email':$('#email').val()},
                    success:function(result){
                      if(result['result'] == true){
                        $("#email_result").val(result['email']);
                      }   
                    }
                });
            })
  
    </script>