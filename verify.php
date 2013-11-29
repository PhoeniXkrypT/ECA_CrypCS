<!DOCTYPE html>
<html>
<body>
<center>
<h1>--VERIFICATION--</h1>
</center>

<?php
$file = fopen("cer.txt","r");
$data = fread($file,filesize("cer.txt"));

$length = strlen($data);
$sig=substr($data, -130);

$fpub=fopen("public.pem","r");
$pub_key=fread($fpub,filesize("public.pem"));
fclose($fpub); 

echo $sig."<br>";

openssl_public_decrypt($sig,$source,$pub_key);
echo $source."<br>";

$len=$length-185;
$content=substr($data,0,$len);
$md = md5($content);
echo "Content"."<br>".$content."<br>";
echo" "."<br>";
echo $md."<br>";

fclose($file);
?>

</body>
</html>
