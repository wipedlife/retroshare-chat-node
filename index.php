
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
<?php
error_reporting(0);
session_start();
$mycerts=
array(
"tor"=>"CQEGAcGcxsBNBF04uA0BCADHws0Gghn9QfAOK1H94OKGpPK9jbEN2XizTRHH2Kiv
39GukxA3On2bKZnjNkgSJ6neY0XUlhWcl+4c4LjSVNczm3Upuvp4G2NV0sLaqwh6
EaQEmEKqwxbzcyGaJ/XTqlvN5nE+FVL+b7Ot2jfolkxJxSuYZlYexzscl46EUQKq
5nZQyOj0Nt2dZHpoCldibwrWW6Gc+N8Pz4YFRZCWxT4Rq4TqFomTXI70+2Nxdwal
Us4QnvyEgXwIOnAKnmrh8p1wx8EnBYs/ixgxHnM0Gd/BPfAetA7ffR/ATxmAqPBd
jOTqxQ0rgpp7S4C+W1sdnWSKi5IAL3LGM4z3f8Oh7J9bABEBAAHNKExpdmluZ3N0
b25lIChHZW5lcmF0ZWQgYnkgUmV0cm9TaGFyZSkgPD7CwF8EEwECABMFAl04uA0J
EJ8LO9V5450ZAhkBAABxbQf/fWtuzqCbk9NMOSo8IcCtiZXrVsbxX19jBpe0gVDh
q0isYBzMhcHuVS+bazCFHFYP6pqqUGzwSSiRiIXxWc0DNaIrLxj8X1gddPLJhLR9
eChP9FX5wtUdQsyqxC2mTuCIxxIbwnJGvIsnNX7XBvgh6qPL9HLfyzLzyVa+wMS8
ATFoeL8W1Xwhy6QySzRbG0BigwgcdEq1JET1j6d9XjEebfr3idSWfanS79pQn9lT
Wr7xjGKJXFsFPOEosRjK/1h79ei4RoN4eCN9WfcoX4z7hCbOt24luEZZCj+N4OFh
bG+xE9XmCeF+K1LKoZorqqV+QSKOsvZYbUq7YU1y4aFe0ghDZGVtb25oYXR1Z3Z1
ZW1ldGF3Y2ZwcXF4N21vNHJsYmFzcWdqaGN5em5vbTNrZXVndmtsb3Z3cWQub25p
b246NzgxMwYLTXkgY29tcHV0ZXIFEKhQc2OooPZg1LP6rHFzdHcHA7qTNg==",
"i2p"=>"CQEGAcGcxsBNBF04tfwBCAC32oDph2jBOIkHxNzs+HXbef4MjKw41Ztsze5HCJ9i
yjM5gIXFo3cTEtCdtkVUa6CVB3EOzHUggQZJhiK/qFz8aTk36/hmlTlLynAHYCzF
x4TodIh1Mp8zDer92+ybqHTtzKBwAjrsRUN+xAWnlga6afaF7EeaI3rxbTEAsCz+
GYZP9exugyCGTqCfmaIdOd+g/BYNpLgA9uV6EiCBj2qmTgOE42i0xoxGJgh/oX+/
zZAw6sLoNKQa/mgwP3/G+LLHNzEldIlnxjqydynez18dRC92PwBNDnRAS+Thy6ZN
IB4vw9EJkWZaWDq9x2n/ebvZSZeIfWJtVrnSGb+8TlKfABEBAAHNKExpdmluZ3N0
b25lIChHZW5lcmF0ZWQgYnkgUmV0cm9TaGFyZSkgPD7CwF8EEwECABMFAl04tfwJ
EDaTBZs3chngAhkBAADplgf+JElIuMlS6np/NooKT9ozoyvQ5RKKcHy1ffmbGNUn
fSa12Hiw8XOXOf4KvkV4oaT3h51jBa7Gja7gMyzOwnB3ojs9ItY6+Kp6LpJ7W5pw
STAOAuSMq/KR61pR6qjmbO7awn8EpEuM3rxjB5M9um4/ms9Rfi0oXexcouTx0WFw
RB69S5Ab0RdNWqGYdK5ph+bHeyT9veZOD4n0aZSva4AQqgIqfiyczZPp4Na6P8yp
+wTuTOrdQrb4o0nYt98aU8WOacRpGQPMyGBBcy50g2ogR8LzRQP7KDwUwQRA8Q+a
cqS42ZGYzEn0EbQIL2faMf3MK3W1ZKWmnE8WtOSnIR+WCggUbGl2aW5nc3RvbmUu
aTJwOjc4MTIGC015IGNvbXB1dGVyBRCWviJ5TrB0+yIeIlO0mxqVBwN8vjs="
);
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
    foreach($mycerts as $type=>$cert)
        print("my $type cert: <textarea>$cert</textarea><br/>");
    print("<script>alert('$text')</script>");

    
}else print("<script>alert('Not correct captcha')</script>");	
}

?>
</body>
</html>
