function openWindow(url,width,height,options,name) {
	width = width ? width : 500;
	height = height ? height : 450;
	options = options ? options : 'resizable=yes,scrollbars=yes';
	name = name ? name : 'DNC';
	return window.open(url,name,'screenX='+(screen.width-width)/2+',screenY='+(screen.height-height)/2+',width='+width+',height='+height+','+options,'_blank');

}