function begin_all_refresh(){
	window.setInterval("all_refresh()",2000);	
}
function all_refresh(){
	//alert("hello...");
}
function refresh_agent_list(){
	$.get(url, { tanpingStatus: "2", lastID: $("#win_lastID").val(), userName: name},
	   function(data){
		 
	   }
	);
}