function _(x){
	return document.getElementById(x);
}
function ajaxObj(meth, url){
	var x;
	
	if (window.XMLHttpRequest){
		// code for IE7+, Firefox, Chrome, Opera, Safari
		x = new XMLHttpRequest();
	}else{
		// code for IE6, IE5
		x = new ActiveXObject("Microsoft.XMLHTTP");
	}
	x.open(meth, 	url, 		true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	return x;
}
function ajaxReturn(x){	
	if(x.readyState == 4 && x.status == 200){
		return true;
	}
}
