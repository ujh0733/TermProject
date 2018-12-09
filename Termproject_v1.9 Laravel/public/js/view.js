function deleteBoard(){
	var result = confirm("삭제 할래?");
	if(result){
		$("#deleteBoard").submit();
	}
}

function open_Theater(num){
    window.open('viewTheaterMaps?board_num='+num,"", "width=700, height=500");
}

function remainSeat(num){
	window.open("remainSeat?num="+num, "", "width=700, height=500");
}
