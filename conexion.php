<?php

try {

  $db = new PDO('mysql: host=localhost; dbname=barrockdb; charset=utf8', 'root', '' );
} catch (PDOException $error) { echo '<h1>Oops, al parecer hubo un error</h1>';

}

?>
