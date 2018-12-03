<?php
	foreach($info as $row){
		$maxSeat = 0;
		$notSeat = 0;
		$doneSeat = 0;
		echo $row->board_day.'<br>';
		for($i = 0; $i < strlen($row['board_seat']); $i++){
			switch ($row->board_seat[$i]) {
				case '0':
					$maxSeat++;
					$notSeat++;
					break;
				case '1':
					$maxSeat++;
					break;
				case '2':
					$maxSeat++;
					$doneSeat++;
					break;
				default:
					break;
			}
		}
		$rightiSeat = $maxSeat-$notSeat;	//통로 제외 모든 자리
		$emptySeat = $maxSeat-$notSeat-$doneSeat;	//통로, 예약 제외 남은자리
		echo $emptySeat."/".$rightiSeat.'<br>';
		
	}
?>