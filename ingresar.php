<?php

require_once "funciones.php";
include "conexion.php";

session_start();

if (existeParametro('usuario',$_SESSION)) {
  header("Location: indexingresado.html");
  exit;
}

$nombre = valorParametro('nombre',$_POST);
  $email = valorParametro('email',$_POST);
$password = valorParametro('password',$_POST);
$password2 = valorParametro('password2',$_POST);
$existeFile = existeFileSinError('imagen');
$infoUsuario = [];
$error = false;

if (existeParametro('submit', $_POST)) {
  if ($nombre && $email && $password && $password == $password2 && $existeFile) {
    $infoUsuario = infoUsuario($email);
    if ($infoUsuario['existe']) {
      $error = true;
    } else{
      guardarUsuario([
        'nombre'=>$nombre,
        'email' => $email,
        'password' => password_hash($password,PASSWORD_DEFAULT),
        'id' => $infoUsuario['proximoId']+1,
        'imagen' => guardarAvatar('imagen')
      ]);
      header("Location: bienvenido.php");
      exit;
    }
  } else {
    $error = true;
  }

// Uso $db para Insertar un nuevo usuario en mi base
  global $db;
// Preparo un stmt de tipo INSERT
$insert = 'INSERT INTO usuarios (NombreyApellido, email, contraseña)
VALUES (:username, :email, :password)';

  $stmt = $db->prepare($insert);
//defino variables dentro del ámbito local
$usuario = [
  "nombre" => $_POST['nombre'],
  "email" => $_POST['email'],
  "password" => $_POST['password'],
];
  // Bindeo los valores
  $stmt->bindValue(":username", $usuario["nombre"]);
  $stmt->bindValue(":email", $usuario["email"]);
  $stmt->bindValue(":password", $usuario["password"]);

  // Ejecuto el stmt
  $stmt->execute();
  // Obtengo el ID insertado
  $userId = $db->lastInsertId();
  // Retornar el ID
  return $userId;
var_dump($userId);

}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css"> <!-- este archivo css lo hice para porque el logo es gigante y necesitaba achicarlo un poco-->
    <link rel="stylesheet" href="css/styledesktop.css">
    <title>Barrock Brewery</title>
    <link rel="shortcut icon" href="imagenes/barrockfavicon.png">
  </head>
  <body>
    <div class="main">
      <div class="loQueVaFixed">
              <div class="logo" id="logo">
                <a href="index.html"><img src="imagenes/Barrock Brewery.png" alt=""></a>
              </div>
              <nav class ="rubros">
                    <ul>
                      <a href="index.html"><li>Inicio</li></a>
                      <a href="preguntas.html"><li>Preguntas</li></a>
                      <a href="contacto.html"><li>Contacto</li></a>
                      <a href="ingresar.php"><li>Registrate</li></a>
                      <a href="login.php"><li>Login</li></a>
                    </ul>
              </nav>
              <div class="redes">
                <ul class="social">
                  <li><a href="http://www.twitter.com" target="_blank"><img src="imagenes/icono-tw.svg" alt=""></a></li>
                  <li><a href="http://www.instagram.com" target="_blank"><img src="imagenes/icono-ig.svg" alt=""></a></li>
                  <li><a href="http://www.facebook.com" target="_blank"><img src="imagenes/icono-fb.svg" alt=""></a></li>
                </ul>
              </div>
            </div>
      <div class="contenedor">

        <div class="formularios">

            <div class="registro">
              <h1>REGISTRATE Y OBTENÉ <br>INCREIBLES BENEFICIOS</h1>
              <form role="form" action="" method="post" enctype="multipart/form-data">
           		<div class="ingreso">
           		</div><div class="form-group col-sm-6">
           			<?php if($error && array_key_exists('existe', $infoUsuario) && $infoUsuario['existe']): ?>
                         <span style="color: red; font-size: 16px;">Ya existe un usuario con ese E-mail</span>
                       <?php endif; ?>
                       <?php if($error && !$nombre):?>
                 				<span style="color: red; font-size: 16px;"> Ingresar un nombre y apellido</span>
                 			<?php endif; ?>
                 		<?php if($error && strlen($nombre) < 10):?>
                 				<span style="color: red; font-size: 16px;">El Nombre y Apellido es demasiado corto</span>
                 			<?php endif; ?>
           			<label>Nombre y Apellido</label><br><input type="text" class="form-control" name="nombre" required>
           			</div>
           		<div class="form-group col-sm-6">
           			<?php if($error && !$email):?>
                 				<span style="color: red; font-size: 16px;">  Ingresar email</span>
                 			<?php endif; ?>
           			<label>Email</label><br><input type="Email" class="form-control" name="email" required>
           		</div>
           		<div class="form-group col-sm-6">
           			<?php if($error && !$password):?>
                 				<span style="color: red; font-size: 16px;">Ingresar contraseña</span>
                 			<?php endif; ?>
           			<label>Contraseña</label><br><input name="password" type="password" class="form-control" required>
           		</div>
           		<div class="form-group col-sm-6">
           			<?php if($error && !$password2):?>
                 				<span></span>
                 			<?php endif; ?>
                 		<?php if($error && ($password2 || $password)):?>
                 				<span style="color: red; font-size: 16px;">Las contraseñas deben ser iguales</span>
                 			<?php endif; ?>
           			<label>Confirmar Contraseña</label><br><input name="password2" type="password" class="form-control" required>

           		</div>
           		<div class="form-group">
           					<label>Foto</label><br>
           					<div>
           						<?php if($error && !$existeFile):?>
                 					<span style="color: red; font-size: 16px;">Ingresar un Avatar</span>
                 			<?php endif; ?>
           						<input type="file" name="imagen">
           					</div>
           				</div>

           			<button type="submit" name="submit">ENVIAR</button>
           			<button type="reset">VOLVER</button>

           	 </form>
            </div>

            <div class="imagenregistro">
              <img src="imagenes/cervezalogin.png" style="width: 100%;">
            </div>
      </div>
    </div>
      <footer>
      <div class="contenedor">
        <div class="copy">
          <p id="copyright">® Copyright 2018</p>
        </div>
        <div class="copy2">
          <p>Cerveza artesanal significa independencia. Significa crear con ingredientes naturales,
            significa permanentemente descubrir, significa materias primas orgánicas, significa
            elaborar pensando siempre en la mejor calidad y en el respeto hacia la comunidad.</p>
        </div>
        <div class="redes2">
          <ul class="social">
            <li><a href="http://www.facebook.com" target="_blank"><img style="width: 100%;" src="imagenes/facebook-black-logo.jpg" alt=""></a></li>
          </ul>
        </div>
      <!--ACA IRIA ANCLA-->
      </div>
    </footer>

  </body>
</html>
