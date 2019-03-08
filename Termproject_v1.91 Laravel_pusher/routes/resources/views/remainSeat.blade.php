
	@if(count($info) == 0)
		<h3>등록된 좌석이 없습니다.</h3>
	@endif

	@foreach($info as $row)
		@php
			$maxSeat = 0;
			$notSeat = 0;
			$doneSeat = 0;
		@endphp
		<h1>{{$row->board_day}}</h1>
		@for($i = 0; $i < strlen($row['board_seat']); $i++)
			@switch ($row->board_seat[$i])
				@case(0)
					@php
						$maxSeat++;
						$notSeat++;
					@endphp
					@break;
				@case(1)
				@php
					$maxSeat++;
					@endphp
					@break;
				@case(2)
				@php
					$maxSeat++;
					$doneSeat++;
					@endphp
					@break;
				@default
					@break;
			@endswitch
		@endfor
		@php
			$rightiSeat = $maxSeat-$notSeat;	//통로 제외 모든 자리
			$emptySeat = $maxSeat-$notSeat-$doneSeat;	//통로, 예약 제외 남은자리
		@endphp
		<h3>{{$emptySeat."/".$rightiSeat}}</h3>
	@endforeach
