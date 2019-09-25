<?php
  require "rb.php";
  R::setup( 'mysql:host=localhost;dbname=ucounter', 'root', '' );

  $ip = $_SERVER['REMOTE_ADDR'];
  $online = R::findOne('online', 'ip = ?', array($ip));

  if($online){
    // Update
    $online->lastvisit = time();
    R::store($online);
  }else{
    // Create
    $online = R::dispense('online');
    $online->lastvisit = time();
    $online->ip = $ip;
    R::store($online);
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Online Test</title>
</head>
<body>
  Сейчас онлайн: 0
</body>
</html>