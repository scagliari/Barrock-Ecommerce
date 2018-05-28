<?php
session_start();

require_once "funciones.php";
require_once "conexion.php";

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


      //Acá vamos a incluir todo dentro de una base de datos
      global $db;
      // Preparo un stmt de tipo INSERT
      $stmt = $db->prepare('INSERT INTO usuarios
          (Nombre_Apellido, email, contraseña)
          VALUES (:username, :email, :password)');

      // Bindeo los valores
      $stmt->bindValue(":username", $_POST['nombre']);
      $stmt->bindValue(":email", $_POST['email']);
      $stmt->bindValue(":password", $_POST['password']);
      // Ejecuto el stmt
      $stmt->execute();

      //Macheo el nombre que me llega por Post con usuarios SESSION
      $_SESSION['usuario'] = $_POST['nombre'];
      //Si está todo bien redirijo a la página de bienvenido
      header("Location: bienvenido.php");
      exit;
    }
  } else {
    $error = true;
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://meyerweb.com/eric/tools/css/reset/reset.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
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
           		<div class="ingreso"></div>
              <div>
           			<?php if($error && array_key_exists('existe', $infoUsuario) && $infoUsuario['existe']): ?>
                         <div style="color: red; font-size: 16px;">Ya existe un usuario con ese E-mail</div>
                       <?php endif; ?>
                       <?php if($error && !$nombre):?>
                 				<div style="color: red; font-size: 16px;"> Ingresar un nombre y apellido</div>
                 			<?php elseif ($error && strlen($nombre) < 10): ?>
                 				<div style="color: red; font-size: 16px;">El Nombre y Apellido es demasiado corto</div>
                 			<?php endif; ?>
           			<label>Nombre y Apellido</label><br><input type="text" name="nombre" >
           			</div>
           		<div>
           			<?php if($error && !$email):?>
                 				<div style="color: red; font-size: 16px;">Ingresar email</div>
                 			<?php endif; ?>
           			<label>Email</label><br><input type="Email" name="email" >
           		</div>
           		<div>
           			<?php if($error && !$password):?>
                 				<div style="color: red; font-size: 16px;">Ingresar contraseña</div>
                 			<?php endif; ?>
           			<label>Contraseña</label><br><input name="password" type="password" >
           		</div>
           		<div>

                 		<?php if($error && ($password2 != $password)):?>
                 				<div style="color: red; font-size: 16px;">Las contraseñas deben ser iguales</div>
                 			<?php endif; ?>
           			<label>Confirmar Contraseña</label><br><input name="password2" type="password" >

           		</div>
           		<div class="form-group">
           					<label>Foto</label><br>
           					<div>
           						<?php if($error && !$existeFile):?>
                 					<div style="color: red; font-size: 16px;">Ingresar un Avatar</div>
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
