<?php
	$test = "test1234";

	$rs = md5($test);

	echo "원래 문자 ".$test."<br>";
	echo "암호화한 뒤 문자".$rs;

?>