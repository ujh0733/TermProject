<?php
	$check = isset($_REQUEST["check"])?$_REQUEST["check"]:"";

	echo $check[1];
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="" method="POST">
		<input type="checkbox" name="check" value="남자">남자
		<input type="checkbox" name="check" value="여자">여자
	<input type="submit" name="submit" >
	</form>
</body>
</html>