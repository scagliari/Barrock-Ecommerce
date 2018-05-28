<?php

try {
  $db = new PDO('mysql:host=localhost; dbname=barrockdb; charset=utf8', 'root', '' );
} catch (PDOException $error) { echo $error->getMessage();

}

?>
