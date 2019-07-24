<?php
error_reporting(0);
session_start();

if(isset($_GET['captcha']) && isset($_GET['cert']) ){
   $cert=$_GET['cert'];
   $cert = trim(preg_replace('/\s+/',' ', $cert));

   
   
 if(hash("sha256",$_GET['captcha']) == $_SESSION['SCAPTCHA']){
    require_once('chatServ_retroshare.php');
    $serv_i2p=new chatServ();
    $serv_tor=new chatServ('localhost','9091');
    $text="";
    if( $serv_i2p->add_peer($cert) )
        $text.="Node added for I2P";
    else
        $text.="Node not added for I2P";
    if( $serv_tor->add_peer($cert) ) $text.="Node added for TOR";
    else $text.="Node not added for Tor";
    print("<script>alert('$text')</script>");	
}else print("<script>alert('Not correct captcha')</script>");	
}

?>
<!doctype html>
<html>
<head>
	<title>RetroShare ChatNode add</title>
	<style>
		/*One shitcodes one love*/
	body{
		text-align:center;
	}form input[type="textarea"], form option{
		width:220px;
	}form input[type="textarea"]:focus, form option{
		border:2px groove aqua;
	}
	</style>

</head>
<body>
<form action="index.php" method=GET>
<img id=captcha src="captcha.php" alt="captcha"><br>

<textarea name=cert placeholder="Your Certificate"></textarea><br>
<input type="textarea" name=captcha placeholder="Write what you see on picture."><br>
<input type=submit value=check>
</form>

</body>
</html>
