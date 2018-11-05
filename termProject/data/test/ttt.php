<script src="jquery.min.js"></script>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		div{
			width: 50%;
			height: 500px;
			border: 1px solid black;
		}
	</style>
	<script type="text/javascript">
		$(document).ready(function(){
			$("table").click(function(){
				var cont = $("#cont").width();
				alert(cont);
				var x = document.getElementById("myTable").childElementCount;
				alert(x);
				var w = cont/x+"px";
				alert(w);
				for(var i = 0; i < x; i++){
					document.getElementsByTagName("td")[i].width = w;
				}
				//document.getElementsByTagName("td")[0].width = "50px";
				//document.getElementsByTagName("td")[1].width = "50px";
				//document.getElementsByTagName("td")[0].width = "50px";
				//document.getElementsByTagName("td")[1].width = "50px";
			});

		});
	</script>
</head>
<body>
	<div id="cont">
		<table border="1" id="tt1">
			<tbody id="tt2">
				<tr id="myTable">
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>	
					<td>&nbsp</td>
					<td>&nbsp</td>				
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>