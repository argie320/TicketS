
<html>

<head>
<meta charset="UTF-8" />
<style type="text/css">
#dialogoverlay{
 display: none;
 opacity: .8;
 position: fixed;
 top: 0px;
 left: 0px;
 background: #fff;
 width: 100%;
 z-index: 10;
}
#dialogbox{
  display: none;
  position: fixed;
  background: #ddd;
  border-radius: 2px;
  width: 350px;
  z-index: 10;
}
#dialogbox > div{ background: #fff; margin: 8px; }
#dialogbox > div > #dialogboxhead { background: #fff; font-size: 19px; padding: 10px; }
#dialogbox > div > #dialogboxbody { background: #eee; padding: 20px; color: #000000; }
#dialogbox > div > #dialogboxfoot { background: #fff; padding: 10px; text-align: right; }

</style>
<script type="text/javascript">
   function CustomAlert(){
         this.render = function(dialog){
           var winW = window.innerWidth;
           var winH = window.innerHeight;
           var dialogoverlay = document.getElementById('dialogoverlay');
           var dialogbox = document.getElementById('dialogbox');
           dialogoverlay.style.display = "block";
           dialogoverlay.style.height = winH + "px";
             dialogbox.style.left = (winW/2) - (350*.5) + "px" ;
             dialogbox.style.top = "100px";
             dialogbox.style.display = "block";

             document.getElementById('dialogboxhead').innerHTML ='<img src="images/empty.png" height="50px" width="50px"><center>Empty Report</center>';
             document.getElementById('dialogboxbody').innerHTML = dialog;
             document.getElementById('dialogboxfoot').innerHTML = '<button onclick=alert.ok()>OK</button>';
         }
         this.ok = function(){
              document.getElementById('dialogbox').style.display = "none";
              document.getElementById('dialogoverlay').style.display = "none";
	          window.location="myworkorder.php";
         }
   }
   var alert = new CustomAlert();
</script>
</head>

<body>
  <div id="dialogoverlay"></div>
  <div id="dialogbox">
    <div>
      <div id="dialogboxhead"></div>
      <div id="dialogboxbody"></div>
      <div id="dialogboxfoot"></div>
  </div>
 </div>

<h1></h1>
<h2></h2>

 <?php echo "<script>alert.render('SV number has no pulloutNO');</script>" ?> 
 
<h3></h3>

</body>

</html>