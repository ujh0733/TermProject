<?php
	function pagination($url, $total, $page, $page_cut=10){
		echo "<ul>";

		$cel = reound($page_cut / 2);

		if($page < $cel){
			$start = 1;
			$end = $start + $page_cut;
		}else if($page == $cel){
			$start = 1;
			$end = $start + $page_cut;
		}else{
			$start = $page - $cel;
			$end = $start + $page_cut;
		}

		if($end > $total){
			$end = $total;
		}

		if($page > 1){
			echo "<li><a href='".$url."$page=1'>처음으로</a></li>";
			$prev = $page - 1;
			echo "<li><a href='".$url."$page=".$prev."'>이전으로</a></li>";
		}

		for($i = $start; $i <= $end; $i++){
			if($i == $page){
				if($total != 1){
					if($pge == $i){
						echo "<li class='active'><strong>".$i"</strong></li>";
					}
				}
			}else{
				echo "<li><a href='".$url."$page=".$i."'>".$i."</a></li>";
			}
		}

		if($page < $total){
			$next = $page + 1;
			echo "<li><a href='".$url."$page=".$next."'>다음</a></li>";
			echo "<li><a href='".$url."$page=".$total."'>마지막으로</a></li>";
		}

		echo "</ul>";
	}

	$qry = "select * from board 'document' where 'is_allow'='Y'";
	$res = mysql_query($qry);
	$num = mysql_num_rows($res);

	if(!isset($_GET[page])){
		$page = 1;
	}else{
		$page = $_GET[page];
	}

	$PageCut = 10;

	$StartPage = ($page * $PageCut) - $PageCut;
	$EndPage = $PageCut;
	$Total = intval($num / $PageCut) + 1;

	if($num == 0){
		echo "문서가 없습니다.";
	}else{}
?>