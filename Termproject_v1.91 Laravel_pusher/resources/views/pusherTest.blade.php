<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <style type="text/css">
  	div{
  		width: 100px;
  		height: 100px;
      margin: 5px;
  	}
  	.disable{
  		background-color: gray;
  	}
  	
  	.click{
  		background-color: red;
  		color: white;
  	}
  </style>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('ec792b864a013c22fe72', {
      cluster: 'ap3',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
    	//alert(JSON.stringify(data.message));
     	var num = JSON.stringify(data.message);
      //alert(num);
    	var length = num.length;
    	num = num.substr(1, length-2);

    	if($("#"+num).hasClass('disable')){
    		$("#"+num).toggleClass('click');
      	}else{
	    	$("#"+num).toggleClass('disable');
    	}
    });
  </script>
  
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
  <div id="1" class="disable">
  	Hello!
  </div>
  <div id="2" class="disable">
    Hello!
  </div>
</body>