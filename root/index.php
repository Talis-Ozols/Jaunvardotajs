<!DOCTYPE html>

<html>
<head>
  <meta charset="UTF-8">
</head>

<body>

<?php
echo "Šis ir default: Hello";
echo nl2br("\n");
$str = "Hello";
$str = md5($str);
echo "Un šis ir MD5 hash-ots: ";
echo $str;
?>
 
</body>
</html>