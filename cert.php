<!DOCTYPE html>
<html>
<body>
<center>
<h1>--CERTIFICATE--</h1>
</center>

<?php
$fp=fopen("cer.txt","a");
fwrite($fp,PHP_EOL);
fwrite($fp,"--- CERTIFICATE ---");
fwrite($fp,PHP_EOL);
fwrite($fp,PHP_EOL);
echo "Data : "."<br>";
fwrite($fp,"Data : ");
fwrite($fp,PHP_EOL);
echo "VERSION : 1"."<br>";
fwrite($fp,"VERSION : 1");
fwrite($fp,PHP_EOL);
$s_no=rand();
echo "SERIAL NUMBER : ". $s_no . "<br>";
fwrite($fp,"SERIAL NUMBER : ");
fwrite($fp,$s_no);
fwrite($fp,PHP_EOL);
echo "SIGNATURE ALGORITHM : md5WithRSAEncryption"."<br>";
fwrite($fp,"SIGNATURE ALGORITHM : md5WithRSAEncryption");
fwrite($fp,PHP_EOL);
$str1 = "--- CERTIFICATE --- Data : VERSION : 1"." SERIAL NUMBER : ". $s_no ." SIGNATURE ALGORITHM : md5WithRSAEncryption";

echo "ISSUER : ECA Group3"."<br>";
echo " "."<br>";
fwrite($fp,"ISSUER : ECA Group3");
fwrite($fp,PHP_EOL);
fwrite($fp,PHP_EOL);
echo "VALIDITY"."<br>";
fwrite($fp,"VALIDITY");
fwrite($fp,PHP_EOL);
$d_date=date(" d  M  Y");
echo "NOT BEFORE : ".$d_date."<br>";
fwrite($fp,"NOT BEFORE : ");
fwrite($fp,$d_date);
fwrite($fp,PHP_EOL);
$ahead =  date(' d  M  Y', strtotime("+30 days") );
echo "NOT AFTER : ".$ahead."<br>";
fwrite($fp,"NOT AFTER : ");
fwrite($fp,$ahead);
fwrite($fp,PHP_EOL);
fwrite($fp,PHP_EOL);
echo " "."<br>";
$str2 = " ISSUER : ECA Group3 "." VALIDITY"." NOT BEFORE : ".date(" d  M  Y ") ."NOT AFTER : ".$ahead."";

$nam=$_POST["name"];
echo "SUBJECT : ".$nam."<br>";
fwrite($fp,"SUBJECT : ");
fwrite($fp,$nam);
fwrite($fp,PHP_EOL);
$p=$_POST["pur"];
echo "KEY PURPOSE : ".$p."<br>";
fwrite($fp,"KEY PURPOSE : ");
fwrite($fp,$p);
fwrite($fp,PHP_EOL);
fwrite($fp,PHP_EOL);
echo " "."<br>";

echo "Subject Public Key Info : "."<br>";
fwrite($fp,"Subject Public Key Info : ");
fwrite($fp,PHP_EOL);
echo "PUBLIC KEY ALGORITHM : rsaEncryption"."<br>";
fwrite($fp,"PUBLIC KEY ALGORITHM : rsaEncryption");
fwrite($fp,PHP_EOL);
$fileContent = file_get_contents($_FILES["file"]["name"]);
echo nl2br("PUBLIC KEY : \n" . $fileContent . "<br>");
fwrite($fp,"PUBLIC KEY :");
fwrite($fp,$fileContent);
fwrite($fp,PHP_EOL);
$str3 = " SUBJECT : ".$_POST["name"]." KEY PURPOSE : ".$_POST["pur"]." Subject Public Key Info : ";
$str4 = " PUBLIC KEY ALGORITHM : rsaEncryption"." PUBLIC KEY :" . $fileContent;

$cakey=$str1.$str2.$str3.$str4;
echo "----------------------"."<br>";
echo $cakey."<br>";
echo "----------------------"."<br>";
echo "SIGNATURE ALGORITHM : md5WithRSAEncryption"."<br>";
fwrite($fp,"SIGNATURE ALGORITHM : md5WithRSAEncryption");
fwrite($fp,PHP_EOL);
echo "SIGNATURE : "."<br>";
$md = md5($cakey);
fwrite($fp,"SIGNATURE : ");
fwrite($fp,PHP_EOL);
echo $md."<br>";

$fpriv=fopen("private.pem","r");
$priv_key=fread($fpriv,filesize("private.pem"));
fclose($fpriv); 

openssl_private_encrypt($md,$crypttext,$priv_key); 
echo $crypttext."<br>";
fwrite($fp,$crypttext);
fwrite($fp,PHP_EOL);

fclose($fp);
?>

</body>

</html>
