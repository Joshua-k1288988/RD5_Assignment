<?php
$password = "123bvnvbnvb4";
$has = password_hash($password , PASSWORD_DEFAULT );
echo $has . "<br>";
echo password_hash($password , PASSWORD_DEFAULT) . "<br>";
echo password_hash("4321" , PASSWORD_DEFAULT) . "<br>";
if(password_verify($password, $has)){
    echo "1<br>";
}
else{
    echo "0";
}
echo time() . "<br>";
echo date("Y-m-d H:i:s", time());
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>