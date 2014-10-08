// JavaScript Document
function _(x){
	return document.getElementById(x);
}

function ajaxObj(meth, url){
	var x = new XMLHttpRequest();
	x.open(meth, 	url, 		true);
	x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	return x;
}

function ajaxReturn(x){	
	if(x.readyState == 4 && x.status == 200){
		return true;
	}
}








	$(document).ready(function(e) {
        
		$('#un').blur(function(){
			
			if($(this).val() != ''){
				
				
				var ajax = new ajaxObj("POST", "validator.php");
				$('.ajaxloader').show();
				
				ajax.onreadystatechange = function(){
					
					if(ajaxReturn(ajax) == true){
						
						console.log(ajax.responseText );
						$('.ajaxloader').hide();
						$('span').show().text(ajax.responseText);
						
					}
					
				}
				
				
			}else{
				$('span').show().text("Must not empty");
			}
			
			
			ajax.send("checkUN="+$(this).val());
			
			
		});
		
    });