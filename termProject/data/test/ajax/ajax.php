<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
		function loadDoc() {
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
		    if (this.readyState == 4 && this.status == 200) {
		     document.getElementById("demo").innerHTML = this.responseText;
		    }
		  };
		  xhttp.open("GET", "ajax_info.txt", true);
		  xhttp.send();
		  $("#demo").find("h2").prepend("GET", "ajax_info.txt", true);
		  
		}
	</script>
</head>
<body>

<div id="demo">
  <h2>Let AJAX change this text</h2>
  <button type="button" onclick="loadDoc()">Change Content</button>
</div>

</body>
</html>