
var server = require('http').createServer(handler)
var io = require('socket.io')(server);
//var fs = require('fs');

var port=8080;


//server.listen(8080);
server.listen(port, function () {
  console.log('Server listening at port %d', port);
});

function handler (req, res) {
    res.writeHead(200);
    res.end("jiangjia");
}

io.on('connection', function (socket) {
  socket.emit('news', { hello: 'world' });
  socket.on('my other event', function (data) {
    console.log(data);
  });
  
  socket.on('new message', function (data) {
    // we tell the client to execute 'new message'
     socket.emit('new message');
  });
  
  
});





