<?php

include('funciones.php');

	session_start();

	if (existeParametro('usuario',$_SESSION)) {
		header("Location: bienvenido.php");
		exit;
	}

  $email = valorParametro('email',$_POST);
	$password = valorParametro('password',$_POST);
	$infoUsuario = [];
	$error = false;
	$passwordError = false;

  if (existeParametro('submit', $_POST)) {
    if($email && $password) {
      $infoUsuario = infoUsuario($email);
      if ($infoUsuario['existe']) {
        if (password_verify($password, $infoUsuario['usuario']['password'] )) {
          $_SESSION['usuario'] = $infoUsuario['usuario'];
          if (existeParametro('recordarusuario', $_POST)) {
            setcookie('email',$email);
          } else {
            setcookie('email',$email, time()-60);
          }
          header("Location: bienvenido.php");
          exit;
        } else {
          $error = true;
          $passwordError = true;
        }
      } else {
        $error = true;
      }
    } else {
      $error = true;
    }
  }




/*$recurso = fopen('usuarios/usuarios.json', 'r');
$linea = fgets($recurso);
$primerusuario = json_decode($linea, true);

var_dump($primerusuario['username']);*/




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
							<h1>INGRESÁ A TU CUENTA:</h1>
	            <form action="" method="post">


	                      <?php if($error && array_key_exists('existe', $infoUsuario) && !$infoUsuario['existe']): ?>
	                        <span  style="padding-bottom: 10px; font-size: 16px; background-color: #ffd8d8; color: red; width: 100%;"><i></i> Usuario no registrado</span>
	                      <?php endif; ?>
	                      <?php if($error && $passwordError): ?>
	                        <span style="padding-bottom: 10px; font-size: 16px; background-color: #ffd8d8; color: red; width: 100%;"><i></i> Contraseña incorrecta</span>
	                      <?php endif; ?>
	                      <?php if($error && !$email):?>
	                        <span style="padding-bottom: 10px; font-size: 16px; background-color: #ffd8d8; color: red; width: 100%;"> <i></i> Ingresar un email</span>
	                      <?php endif; ?>



	                      <div><label>Email de Usuario</label><br><input type="email" name="email" value="<?php if($_POST) {echo $_POST['email'];} ?>" placeholder="Email"></div>

	                      <?php if($error && !$password):?>
	                        <span><i></i> Ingresar una contraseña</span>
	                      <?php endif; ?>

	                      <div><label>Contraseña:</label><br><input type="password" name="password" value="" class="<?= ($error && !$password) ? 'error':null ?>"  placeholder="Contraseña"></div>
	                      <div><label for="recordarusuario"><span class="ref">Recordar usuario</span><input type="checkbox" name="recordarusuario" value="recordar" <?= existeParametro('email', $_COOKIE) ? 'checked' : null ?>></label></div>

	                <button type="submit" name="submit">ACEPTAR</button>
	                <a href="login.php"> <button type="button">CANCELAR</button></a>
	                    </form>
				</div>
				<div class="imagenregistro">
						<img src="imagenes/login.jpg" style="width: 100%;">
				</div>
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
