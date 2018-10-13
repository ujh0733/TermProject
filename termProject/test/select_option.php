<?php
	$rs = $_REQUEST["genre"];

	echo "<script>alert('$rs');</script>";
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="" method="POST">
		<div id="genre_form">   <!-- 장르 -->
	        <p>공연 장르</p>
	        <select class="custom-select" id="genre" name="genre" required>
	          <option value=""> Choose...</option>
	          <option value="M">뮤지컬</option>
	          <option value="C">콘서트</option>
	          <option value="P">연극</option>
	          <option value="E">전시</option>
	          <option value="K">아동</option>
	        </select>
	      </div>
	      <input type="submit" name="">
      </form>
</body>
</html>