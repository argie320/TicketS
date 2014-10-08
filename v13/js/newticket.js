
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
			
	var customerNameInput = $(".customername");
	
	
	customerNameInput.keyup(function(){
		
		var ajax = new ajaxObj("POST", "asset/suggest.php?company="+customerNameInput.val());
			
			ajax.onreadystatechange = function(){

				if(ajaxReturn(ajax) == true){

					if(ajax.responseText != "" ){
						console.log(ajax.responseText );
					var obj = ajax.responseText;
                    console.log(obj);
                        /*var json = JSON.parse(obj);

					console.log(json.customername);
					if(json.customername != ""){
						$("#suggest-data").show();
						$("#suggest-data").html('<table><tr><td><p>'+json.customername+'</p></td></tr></table>');
					}else{
						$("#suggest-data").hide();
					}
					*/
					}
					
					
				}
			}
			ajax.send();
		
	});		
	
var _validFileExtensions = ['txt','jpeg','pdf','doc','docx','pub','xls','xlsx','jpg','png','pps','ppt','pptx','psd','zip','7z'];

function Validate(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }

    return true;
}	
	
			
	//Functionality for adding rows
	var Inputs = ['#itemno','#unitbrand','#unitmodel','#serial','#partno','#qty'];
			
			
	$("#addRow").click(function(){
		$("#itemdetails2").append('<tr><td width="60px" id="tdtyle"><input type="text" id="itemno" name="itemno[]" value=""></td><td width="160px" id="tdtyle"><input type="text" id="unitbrand" name="unitbrand[]"></td><Td width="160px" id="tdtyle"><input type="text"  id="unitmodel" name="unitmodel[]" ></Td><Td width="130px" id="tdtyle"><input type="text" id="serial" name="serialno[]"></Td><td width="110px" id="tdtyle"><input type="text" id="partno"  name="partno[]"></td><td width="50px" id="tdtyle"><input type="text" id="qty"  name="qty[]"></td> <td width="150px" id="tdtyle"><select name="warranty[]"><option disabled>--Select Warranty</option><option value="Under Warranty">Under Warranty</option><option value="No Warranty">No Warranty</option></select></td></tr>');
			});
			
	$("#removeRow").click(function(){
				
		$("#itemdetails2 tr:last-child").remove();
				
	});
		

			
            
});