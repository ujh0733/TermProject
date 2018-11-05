var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

app.get('/', function(req, res){
  //res.send('<h1>Hello world(안뇽)</h1>');
  res.sendFile(__dirname + '/index.html');
});

io.on('connection', function(socket){
  socket.on('chat message', function(msg){
    io.emit('chat message', msg);
  });
}); 


http.listen(3000, function(){   // 아마 두번째 줄 없이  app.listen으로 해도 동작할 거에요
  console.log('3000번 포트사용중!!');
});
