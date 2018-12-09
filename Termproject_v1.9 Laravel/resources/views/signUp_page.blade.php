<!doctype html>
<html lang="en">
  <head>
      <link rel="icon" href="img/main1.png">
  <title>Ticket Wave</title>
  <meta charset="utf-8">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
  

    <style type="text/css">
    *{
      margin : 0 auto;
    }
      .container {
       max-width: 960px;
      }
      .lh-condensed { line-height: 1.25; }
    </style>
    <script type="text/javascript">
      //$(document).ready(function(){
        function idCheck(){
          $.get("idCheck", {id:$("#user_id").val()}, function(data){
            if(data == 1){
              alert('중복된 아이디 입니다');
              $("#id_check").val('중복검사 미완료');
              $("#id_check").css('color', 'red');
            }else{
              alert('사용가능한 아이디 입니다.');
              $("#id_check").val('중복검사 완료!');
              $("#id_check").css('color', 'green');
            }
          });
       }
      //});
    </script>
    <script src="js/signUp.js"></script>
  </head>

  <body class="">

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="img/main1.png" alt="" width="72" height="72">
        <h2>Sign Up Page</h2>
        <p class="lead">아래 정보를 하나도 빠짐없이 입력해 주세요.</p>
      </div>

      <div class="row">

        <div class="col-md-8 order-md-1">
          <h4 class="mb-3">Information</h4>

          <form class="needs-validation" novalidate action="{{ route('register') }}" method="POST">

            @csrf

            <div class="mb-3">
              <label for="user_id">ID</label>
              <div class="input-group">
                <input type="text" class="form-control" id="user_id" placeholder="ID" name="user_id" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Please Input Your ID.
                </div>
              </div>
              <div>
                <input type="button" value="중복검사" class="btn btn-primary" onclick="idCheck();" style="margin-top: 5px;">
                <input type="text" id="id_check" value="중복검사 미완료" readonly style="border: none; color: red;">
              </div>
            </div>

            <div class="mb-3">
              <label for="user_pwd">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="user_pwd" placeholder="Password" name="password" required>
                <div class="invalid-feedback" style="width: 100%;">
                  Please Input Your Password.
                </div>
              </div>
            </div>

            <div class="mb-3">
               <label for="user_name">Name</label>
                <input type="text" class="form-control" id="user_name" placeholder="Name" value="" name="user_name" required>
                <div class="invalid-feedback">
                  Please Input Your Name
                </div> 
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="your@example.com" name="email" required>
              <div class="invalid-feedback">
                Please Input Your Email.
              </div>
              <div>
              <input type="button" value="메일 인증" class="btn btn-primary" name="mail_check" id="mail_check" onclick="open_window('mail_check_page');" style="margin-top: 5px;">
              <input type="text" id="email_result" value="메일인증 미완료" readonly style="border: none; color: red;">
              </div>
            </div>


            <div class="mb-3">
              <label for="address">PhoneNumber</label>
              <input type="text" class="form-control" id="address" placeholder="without '-'" name="user_phone" required>
              <div class="invalid-feedback">
                Please Input Your Phone Number
              </div>
            </div>

            <p>Birth Day</p>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="year">Year</label>
                <select class="custom-select d-block w-100" id="year" name="year" required>
                  <option value="">Choose...</option>
                  <option>1980</option>
                  <option>1981</option>
                  <option>1982</option>
                  <option>1983</option>
                  <option>1984</option>
                  <option>1985</option>
                  <option>1986</option>
                  <option>1987</option>
                  <option>1988</option>
                  <option>1989</option>
                  <option>1990</option>
                  <option>1991</option>
                  <option>1992</option>
                  <option>1993</option>
                  <option>1994</option>
                  <option>1995</option>
                  <option>1996</option>
                  <option>1997</option>
                  <option>1998</option>
                  <option>1999</option>
                  <option>2000</option>
                  <option>2001</option>
                  <option>2002</option>
                  <option>2003</option>
                  <option>2004</option>
                  <option>2005</option>
                  <option>2006</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid Year.
                </div>
              </div>

              <div class="col-md-3 mb-3">
                <label for="month">Month</label>
                <select class="custom-select d-block w-100" id="month" name="month" required>
                  <option value="">Choose...</option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                </select>

                <div class="invalid-feedback">
                  Please provide a Month.
                </div>
              </div>

               <div class="col-md-3 mb-3">
                <label for="day">Day</label>
                <select class="custom-select d-block w-100" id="day" name="day" required>
                  <option value="">Choose...</option>
                  <option>01</option>
                  <option>02</option>
                  <option>03</option>
                  <option>04</option>
                  <option>05</option>
                  <option>06</option>
                  <option>07</option>
                  <option>08</option>
                  <option>09</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>21</option>
                  <option>22</option>
                  <option>23</option>
                  <option>24</option>
                  <option>25</option>
                  <option>26</option>
                  <option>27</option>
                  <option>28</option>
                  <option>29</option>
                  <option>30</option>
                  <option>31</option>
                </select>

                <div class="invalid-feedback">
                  Please provide a valid Day.
                </div>
              </div>

            </div>

            <div class="mb-3">
              <label for="addr_btn">Address</label>
                <br>
                <div style="display: inline-flex;">
                 <input class="form-control" id="postcode1" name="postcode1" type="text" style="width:120px;" readonly required/>
                  &nbsp;-&nbsp;
                  <input class="form-control" id="postcode2" name="postcode2" type="text" style="width:120px;" readonly required/>&nbsp;
                  <input class="form-control btn-primary" type="button" onClick="openDaumZipAddress()" value="주소 찾기" id="addr_btn" />
                </div>
                <br>
                <br>
                <div style="display: inline-flex;">
                  <div>
                    <input class="form-control" type="text" id="addr" name="addr" value="" style="width:240px;" readonly required />
                    <div class="invalid-feedback">
                      Please provide a valid Day.
                    </div>
                  </div>
                  &nbsp;
                  <div>
                    <input class="form-control" type="text" id="addr_etc" name="addr_etc" value="" placeholder="나머지 주소"style = "width:200px;" required/>
                     <div class="invalid-feedback">
                      Please provide a your Address.
                    </div>
                 </div> 
                </div>

            </div>

            <hr class="mb-4">

            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="same-address">
              <label class="custom-control-label" for="same-address">Allowing e-mail receives</label>
            </div>
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="save-info">
              <label class="custom-control-label" for="save-info">Saving this information</label>
            </div>
            <hr class="mb-4">
   
            <button class="btn btn-primary btn-lg btn-block" type="submit" id="finish" onclick="return submit_check()">Sign Up</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">Copyright &copy; <strong>Make by Ryu.</strong><br> All Right Reserverd.</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Privacy</a></li>
          <li class="list-inline-item"><a href="#">Terms</a></li>
          <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="ja/jquery-3.3.1.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();

      function submit_check(){
        if($("#email_result").val() == "메일인증 미완료"){
          alert('이메일 인증을 진행해 주세요');
          return false;
        }else if($("#id_check").val() == "중복검사 미완료"){
          alert('아이디 중복 검사를 진행해 주세요');
          return false;
        }
      }
    </script>
  </body>
</html>
