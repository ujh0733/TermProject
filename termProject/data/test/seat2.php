<script src="jquery.min.js"></script>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script>
		var seat = [
			[1,1,0,1,1,0,0,0,0,1,1,0,1,1],
			[1,1,0,1,1,1,1,1,1,1,1,0,1,1],
			[1,1,0,1,1,1,1,1,1,1,1,0,1,1],
			[1,1,0,1,1,1,1,1,1,1,1,0,1,1],
			[1,1,0,1,1,1,1,1,1,1,1,0,1,1],
			[1,1,0,1,1,1,1,1,1,1,1,0,1,1],
			[1,1,0,1,1,1,1,1,1,1,1,0,1,1],
			[1,1,0,1,1,1,1,1,1,1,1,0,1,1],
			[1,1,0,1,1,1,1,1,1,1,1,0,1,1],
			[1,1,0,1,1,1,1,1,1,1,1,0,1,1],
			[1,1,0,1,1,1,1,1,1,1,1,0,1,1],
		];
		function check(event){
			var temp = document.elementFromPoint(event.pageX, event.pageY);
			console.log(event.pageX);
			console.log(event.pageY);
			var wid = $(temp).width();
			//alert(wid);
			if(temp.style.backgroundColor == "gray"){
				temp.removeAttribute("style");
				this.cnt--;
				if(this.cnt < 0)
					this.cnt = 0;
				document.getElementById("cnt").innerHTML = this.cnt;
				return;
			}else{
				this.cnt++;
				temp.setAttribute("text"," ");
				temp.setAttribute("style", "background-color: gray;");
				//temp.toggleClass("backgray");
			}
			document.getElementById("cnt").innerHTML = this.cnt;

			 $(document)
		    .mouseup(function () {
		      isMouseDown = false;
		    });
		}
	</script>
	<style>
		.line{
			overflow: hidden;
		}
		.seat{
			margin: 2px;
			float: left;
			width: 30px;
			height: 30px;
			border-radius: 3px;
		}
		.enable{
			background: gray;
		}
		.enable:hover{
			background: black;
		}
		.disable{
			background: red;
		}
	</style>
</head>
<body>

</body>
</html>