<?php
	require_once("../../tools.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>새로고침 테스트</title>
	<script type="text/javascript">
		var test = new Object();

		function tt(){
			//window.location.reload();
			//top.document.test.location.reload();
		}
	</script>
</head>
<body>
	새로고침
	<input type="button" id="test" name="" value="reload" onclick="tt();">
</body>
</html>