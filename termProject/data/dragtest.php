<script src="../jquery-3.3.1.min.js"></script>
<!DOCTYPE html>
<html>
<head>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script type="text/javascript" src="//code.jquery.com/ui/1.9.2/jquery-ui.js"></script>


  <title></title>

  <style type="text/css">

td{
      width: 50px;
      height: 50px;
    }
    #check{
      background-color: red;
      color: blue;
    }
    #myDiv{
      background-color: #ddd;
    }
    p{
      background-color: #bbb;
      text-align: center;
    }
    table{
      margin : 0 auto;
    }
 
 #sel-table .ui-selecting td {
   background-color: #FECA40;
 }
 
 #sel-table .ui-selected td {
   background-color: #F39814;
   color: white;
 }

  table td.highlighted {
      background-color: gray;
    }
  </style>

  <script type="text/javascript">
    /* 
    $(window).load(function(){
      
      $("#sel-table tbody").selectable();


    });*/
  </script>
</head>
<body>

<table border=1 id="our_table">
  <tbody>
      <tr>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
      </tr>
      <tr>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
      </tr>
      <tr>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
      </tr>
      <tr>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
        <td onclick="check(event);"></td>
      </tr>
    </tbody>
  </table>
  <span>선택한 좌석 수:</span><span id="cnt">0</span>

  <script>

    $(function () {
      var isMouseDown = false;
      $("#our_table td")
        .mousedown(function () {
          isMouseDown = true;
          $(this).toggleClass("highlighted");
          return false; // prevent text selection
        })
        .mouseover(function () {
          if (isMouseDown) {
            $(this).toggleClass("highlighted");
          }
        });
      
      $(document)
        .mouseup(function () {
          isMouseDown = false;
        });
    });

    var cnt = 0;
    function check(event){
      var temp = document.elementFromPoint(event.pageX, event.pageY);
      if(temp.style.backgroundColor == "gray"){
        temp.removeAttribute("style");
        temp.setAttribute("style", "background-color: white;");
        this.cnt--;
        if(this.cnt < 0)
          this.cnt = 0;
        document.getElementById("cnt").innerHTML = this.cnt;
        return;
      }else{
        this.cnt++;
        temp.setAttribute("style", "background-color: gray;");
      }
      document.getElementById("cnt").innerHTML = this.cnt;

       $(document)
        .mouseup(function () {
          isMouseDown = false;
        });
    }
  </script>

</body>
</html>