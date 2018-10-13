<?php
	$name = "test.jpg";
	$cnt = 0;

	$name_cut = explode(".", $name);
	$cut_name = $name_cut[0];
	$ext = $name_cut[1];
	echo $cut_name.$cnt.".".$ext;
?>