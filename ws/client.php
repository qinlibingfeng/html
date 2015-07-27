<html>
<script src="/socket.io/node_modules/socket.io-client/socket.io.js""></script>


<script>
 	var socket = io('http://172.17.1.90:8081');	
 	
	socket.on('outbound', function (data) {
	    console.log(data);
	    alert("out:" + data.phone);
	  }); 	
 	socket.on('inbound', function (data) {
	    console.log(data);
	    alert("in:" + data.phone);
	  }); 	
	  
	function sd($agentid){		
		$agentid = document.getElementById('phone').value;
	  socket.emit('agent', $agentid);
	}
	
//mangage interface

	socket.on('list_res', function (data) {
	   
	   	$context  = "";
	   	data.forEach(function(e){  
    	      $context += e + "\n";
			});
	   	document.getElementById('output').value = $context;
	   
	});
  
	function get_agents_list(){		
	  socket.emit('list', "");
	  
	  
	}	
	
	
	
</script>
<body>
	<div>
	<input type='text' id='phone' />
	<input type='button' onClick='sd()' value="Sign in" />
	</div>
	
	<div>
	<input type='button' onClick='get_agents_list()' value="Agents list" />
	
	</div>
	
	<div>
	<textarea name="output" id="output" cols ="50" rows = "30"></textarea>
	</div>
</body>
</html>