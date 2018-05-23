<?php

$errores = [];
$nombre = trim($_POST['nombre']);


if ($nombre == '') {
  $errores[] = "El nombre es obligatorio <br>";
}


$email = trim($_POST['email']);

if ($email == '') {
  $errores[] = "El email es obligatorio <br>";
}

elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errores[] = "El email ingresado no es válido <br>";
}

$confirmaremail = trim($_POST['confirmaremail']);

if ($email != $confirmaremail) {
  $errores[] = "Los email ingresados no coinciden <br>";
}

$contrasena = trim($_POST['password']);
$confirmpass = trim($_POST['confirmpass']);

if ($contrasena != $confirmpass) {
  $errores[] = "Las contraseñas ingresadas no coinciden";
}


// Subir y guardar archivos en mi servidor

if ($_FILES['avatar']['error'] == UPLOAD_ERR_OK) {
  $origen = $_FILES['avatar']['tmp_name'];
  $ext = pathinfo($_FILES['avatar']['name'], PATH_INFO_EXTENSION);
  $nombreimagen = uniqid() . '.' . $ext;
  $destino = __DIR__ . '/avatar/' . $nombreimagen;

move_uploaded_file($origen, $destino);

}


 ?>
