<?php
	require_once("../BoardDAO.php");
	$test = $_REQUEST['msg'];
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>AJAX TEST</h1>
	<h1><?= $test ?></h1>
</body>
</html>