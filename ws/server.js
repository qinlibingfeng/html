var server = require('http').createServer(handler)
var io = require('socket.io')(server);
var url = require("url");
var fs = require('fs');
//var log4js = require('log4js');  

//io.set('transports', ['websocket','flashsocket', 'htmlfile', 'xhr-polling', 'jsonp-polling']);


var port=8081;
server.listen(port, function () {
  console.log('%s: Server listening at port %d', CurentTime(), port);
});


function handler (req, res) {
				
		var pathname = url.parse(req.url, true).pathname;  //pathname => select  
		if(pathname == '/'){
			pathname = '/index.html';
		}

		//console.log("getfile:"+pathname);
		
		
		if(pathname == '/outbound')
		{								
			var $params = url.parse(req.url, true).query;//解释url参数部分name=zzl&email=zzl@sina.com				
			var $agent = $params.agent;
			var $phone = $params.phone;
			
			if($agent == undefined || $phone == undefined){
				 res.writeHead(500);
				return res.end('Error loading ');;
			}
			console.log("%s: outbount request: %s --> %s", CurentTime(), $agent, $phone);
	
			if($agents[$agent] == undefined){		
				console.log("%s: Error agent: %s not connected", CurentTime(), $agent);
				res.writeHead(500);
				return res.end('Error agent:'+ $agent + ' not connected ');;
			}
			$agents[$agent].emit('outbound', $phone);
			res.writeHead(200);
   	 	return res.end('ok');
		}

		if(pathname == '/inbound')
		{						
		
			var $params = url.parse(req.url, true).query;//解释url参数部分name=zzl&email=zzl@sina.com				
			var $agent = $params.agent;
			//var $phone = $params.phone;
			
			//if($agent == undefined || $phone == undefined){
			if($agent == undefined){
				 res.writeHead(500);
				return res.end('Error loading ');;
			}
			//console.log("%s: inbount request: %s --> %s", CurentTime(), $agent, $phone);
			console.log("%s: inbount request: %s", CurentTime(), $agent);
	
			if($agents[$agent] == undefined){		
				console.log("%s: Error agent: %s not connected", CurentTime(), $agent);
				res.writeHead(500);
				return res.end('Error agent:'+ $agent + ' not connected ');;
			}
			$agents[$agent].emit('inbound', $agent);
			res.writeHead(200);
   	 	return res.end('ok');
		}	
		
		
		if(pathname == '/ready')
		{						
		
			var $params = url.parse(req.url, true).query;//解释url参数部分name=zzl&email=zzl@sina.com				
			var $agent = $params.agent;
	//		var $phone = $params.phone;
			
			if($agent == undefined){
				 res.writeHead(500);
				return res.end('Error loading ');;
			}
			console.log("%s: ready request: %s ", CurentTime(), $agent);
	
			if($agents[$agent] == undefined){		
				console.log("%s: Error agent: %s not connected", CurentTime(), $agent);
				res.writeHead(500);
				return res.end('Error agent:'+ $agent + ' not connected ');;
			}
			$agents[$agent].emit('ready', $agent);
			res.writeHead(200);
   	 	return res.end('ok');
		}			
		if(pathname == '/pause')
		{						
		
			var $params = url.parse(req.url, true).query;//解释url参数部分name=zzl&email=zzl@sina.com				
			var $agent = $params.agent;
	//		var $phone = $params.phone;
			
			if($agent == undefined){
				 res.writeHead(500);
				return res.end('Error loading ');;
			}
			console.log("%s: pause request: %s ", CurentTime(), $agent);
	
			if($agents[$agent] == undefined){		
				console.log("%s: Error agent: %s not connected", CurentTime(), $agent);
				res.writeHead(500);
				return res.end('Error agent:'+ $agent + ' not connected ');;
			}
			$agents[$agent].emit('pause', $agent);
			res.writeHead(200);
   	 	return res.end('ok');
		}		
		if(pathname == '/logout')
		{						
		
			var $params = url.parse(req.url, true).query;//解释url参数部分name=zzl&email=zzl@sina.com				
			var $agent = $params.agent;
	//		var $phone = $params.phone;
			
			if($agent == undefined){
				 res.writeHead(500);
				return res.end('Error loading ');;
			}
			console.log("%s: login request: %s ", CurentTime(), $agent);
	
			if($agents[$agent] == undefined){		
				console.log("%s: Error agent: %s not connected", CurentTime(), $agent);
				res.writeHead(500);
				return res.end('Error agent:'+ $agent + ' not connected ');;
			}
			$agents[$agent].emit('logout', $agent);
			res.writeHead(200);
   	 	return res.end('ok');
		}		
		if(pathname == '/login')
		{						
		
			var $params = url.parse(req.url, true).query;//解释url参数部分name=zzl&email=zzl@sina.com				
			var $agent = $params.agent;
			var $pass = $params.pass;
			var $campaign = $params.campaign;
			
	//		var $phone = $params.phone;
			
			if($agent == undefined || $pass == undefined || $campaign == undefined){
				 res.writeHead(500);
				return res.end('Error loading ');;
			}
			console.log("%s: logout request: %s ", CurentTime(), $agent);
	
			if($agents[$agent] == undefined){		
				console.log("%s: Error agent: %s not connected", CurentTime(), $agent);
				res.writeHead(500);
				return res.end('Error agent:'+ $agent + ' not connected ');;
			}
			$agents[$agent].emit('login', {"user":$agent,"pass":$pass,"campaign":$campaign});
			res.writeHead(200);
   	 	return res.end('ok');
		}	
		if(pathname == '/recordlist')
		{						
		
			var $params = url.parse(req.url, true).query;//解释url参数部分name=zzl&email=zzl@sina.com				
			var $agent = $params.agent;
	//		var $phone = $params.phone;
			
			if($agent == undefined){
				 res.writeHead(500);
				return res.end('Error loading ');;
			}
			console.log("%s: recordlist request: %s ", CurentTime(), $agent);
	
			if($agents[$agent] == undefined){		
				console.log("%s: Error agent: %s not connected", CurentTime(), $agent);
				res.writeHead(500);
				return res.end('Error agent:'+ $agent + ' not connected ');;
			}
			$agents[$agent].emit('recordlist', $agent);
			res.writeHead(200);
   	 	return res.end('ok');
		}				
		if(pathname == '/messagelist')
		{						
		
			var $params = url.parse(req.url, true).query;//解释url参数部分name=zzl&email=zzl@sina.com				
			var $agent = $params.agent;
	//		var $phone = $params.phone;
			
			if($agent == undefined){
				 res.writeHead(500);
				return res.end('Error loading ');;
			}
			console.log("%s: messagelist request: %s ", CurentTime(), $agent);
	
			if($agents[$agent] == undefined){		
				console.log("%s: Error agent: %s not connected", CurentTime(), $agent);
				res.writeHead(500);
				return res.end('Error agent:'+ $agent + ' not connected ');;
			}
			$agents[$agent].emit('messagelist', $agent);
			res.writeHead(200);
   	 	return res.end('ok');
		}					
		fs.readFile(__dirname+pathname,
		  function (err, data) {
		    if (err) {
		      res.writeHead(500);
		      return res.end('Error loading '+pathname);
		    }
		   	res.writeHead(200);
		    res.end(data);
	  });

				
}

var $agents = {};
	
io.on('connection', function (socket) {
	
	print_agents($agents);  
  socket.on('agent', function (agentid) {
		console.log("%s: add agent:%s", CurentTime(), agentid);  
		socket.username = agentid;	
  	$agents[agentid] = socket;
    print_agents($agents);
  	
  });
  
  
  
  socket.on('list', function () { 
  
  	var  $agents_list  = getObjectKeys($agents);
 
		print_agents($agents);
		socket.emit('list_res', $agents_list);
  	
  });  
  
  
  
  
  //断开连接时  删除坐席
 	socket.on('disconnect', function () {

		if($agents[socket.username] != undefined){
			delete $agents[socket.username];		
			console.log("%s: remove agent:%s", CurentTime(), socket.username);  
			print_agents($agents);	
		}else{
			console.log("%s: remove agent:%s not found", CurentTime(), socket.username);  
			print_agents($agents);	
		}
	});  
  
});


function print_agents(arr){
	console.log("%s: cur agents:", CurentTime());  
	for(var key in arr){
			console.log(key);
	}
	console.log("");  	
}

function getObjectKeys(object) 
{
    var keys = [];
    for (var property in object)
      keys.push(property);
    return keys;
}


function CurentTime()
    { 
        var now = new Date();
       
        var year = now.getFullYear();       //年
        var month = now.getMonth() + 1;     //月
        var day = now.getDate();            //日
       
        var hh = now.getHours();            //时
        var mm = now.getMinutes();          //分
       
        var clock = year + "-";
       
        if(month < 10)
            clock += "0";
       
        clock += month + "-";
       
        if(day < 10)
            clock += "0";
           
        clock += day + " ";
       
        if(hh < 10)
            clock += "0";
           
        clock += hh + ":";
        if (mm < 10) clock += '0'; 
        clock += mm; 
        return(clock); 
    } 


