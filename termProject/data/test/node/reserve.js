//영화 예매
src="http://code.jquery.com/jquery-1.10.2.js"
$(document).ready(function(){


var socketio = require('socket.io');
var app = require('express')();
var http = require('http');
var fs = require('fs');

var seats = [       // 0 빈 공간, 1 예약가능 좌석, 2 예약이 완료된 좌석
    [1, 1, 0, 1, 1, 0, 0, 0, 0, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1],
    [1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1],
];
//웹 서버 생성
//var app = express();
//라우트 수행
app.get('/', function (request, response, next) {
    fs.readFile('HTMLPage.html', function (error, data) {
        response.send(data.toString());
    });
    console.log('접속!');
});
app.get('/seats', function (request, response, next) {
    response.send(seats);
});
//웹서버를 실행
var server = http.createServer(app)
server.listen(8000, function () {
    console.log('Server running at http://127.0.0.1:8000');
});
//소켓 서버를 생성 및 실행합니다.
var io = socketio.listen(server);
io.sockets.on('connection', function (socket) {
    socket.on('reserve', function (data) {
        seats[data.y][data.x] = 2;
        io.sockets.emit('reserve', data);
        console.log('좌석 예약!');
    });
});

});