<?php

include('funciones.php');

	session_start();

	if (!existeParametro('usuario',$_SESSION)) {
		header("Location: inicio.php");
		exit;
	}

	$usuario = $_SESSION['usuario'];
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
                      <a href="Logout.php"><li>Logout</li></a>
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
        <section class="contenedor">
            <div class="historia">

              <div class="historiatexto">
              <div class="h2">
                <h1>BIENVENIDO</h1>
              </div>
              <p><?= $usuario['nombre'] ?>:</p><p> Gracias por registrarte en nuestro sitio y decidir formar parte de esta gran familia.
              Como la familia es lo que más importa, tenemos grandes beneficios para ofrecerte. </p>
              <h3>DESCUENTOS SEMANALES</h3>
              <p>Seguinos en nuestras redes y enterate de todos los descuentos
                semanales que ofrecemos solo para aquellos que forman parte de nuestra cartera de clientes.</p>
              <h3>ENTRADAS A EVENTOS</h3>
              <p>La cerveza artesanal es una moda que llegó para quedarse.
                Todas los meses tenemos distintos eventos, a los cuales podemos invitarte.
                Queremos que la buena cerveza siga expandiéndose, y qué mejor forma
              que combinándola con comida exquisita y música de calidad.</p>
              </div>
              <div class="historiaimagen">
                <img style="width:100%;" src="imagenes/bienvenido.jpg">
              </div>


        </section>
				<div class="cervezas">
            <div class="margen">
              <div class="fila1">
                <div class="ipa">
                  <div class="fotomobile">
                    <img src="imagenes/barrockventa1.png" style="width:100%;">
                  </div>
                  <div class="textoBirra">
                    <h3>INDIAN PALE ALE</h3>
                    <p id = "descripcionBirra">Es un estilo de cerveza de tradición inglesa que se caracteriza como una ale pálida y espumosa con un alto nivel del alcohol y de lúpulo.
                      Se trata de bebidas amargas, de graduación relativamente elevada y que se sirven tibias.</p>
                  </div>
                </div>
                <div class="porter">
                  <div class="fotomobile">
                    <img src="imagenes/barrockventa2.png" style="width:100%;">
                  </div>
                  <div class="textoBirra">
                   <h3>LAS CERVEZAS PORTER</h3>
                   <p id = "descripcionBirra">
                    Se preparan a partir de una combinación de otros dos tipos de cerveza de alta fermentación: el brown ale y el pale ale. Su graduación es muy elevada, aunque no tanto como la de las cervezas Stout o negras.
                   </p>

                  </div>
                </div>
                <div class="stout">
                  <div class="fotomobile">
                    <img src="imagenes/barrockventa3.png" style="width:100%;">
                  </div>
                  <div class="textoBirra">
                    <h3>LA CERVEZA STOUT</h3>
                    <p id = "descripcionBirra">
                      Es similar a la Porter en sus características y en su forma de preparación, si bien su graduación es aún mayor y su color más oscuro; es por esto que por lo general hacemos referencia a ellas como “cervezas negras”.
                    </p>
                  </div>
                </div>
              </div>
              <div class="fila2">
              <div class="pilsener">
                <div class="fotomobile">
                  <img src="imagenes/barrockventa4.png" style="width:100%;">
                </div>
                <div class="textoBirra">
                  <h3>LAS PILSENER</h3>
                  <p id = "descripcionBirra">
                    Son las más populares en muchos países, entre ellos España. Tienen tonos dorados y brillantes, su graduación es baja (aproximadamente 4,5-5%).
                  </p>
                </div>
              </div>
              <div class="amber">
                <div class="fotomobile">
                  <img src="imagenes/barrockventa5.png" style="width:100%;">
                </div>
                <div class="textoBirra">
                  <h3>AMBER LAGER</h3>
                  <p id = "descripcionBirra">
                    Es una cerveza con una combinación de lúpulos y un blend de finas maltas que generan su color rojizo, un delicado aroma y un amargor apacible que permite dar a luz a un tostado delicioso.
                  </p>
                </div>
              </div>
              <div class="honey">
                <div class="fotomobile">
                  <img src="imagenes/barrockventa6.png" style="width:100%;">
                </div>
                <div class="textoBirra">
                  <h3>HONEY</h3>
                  <p id = "descripcionBirra">
                    Los celtas y otras civilizaciones antiguas solían hacer aguamiel
                    mediante la fermentación de la miel. También producían cerveza a
                    la cual a menudo se la añadía miel como un suave edulcorante.
                    Es una confusa y deliciosa cerveza.
                  </p>
                </div>
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

      </div>
  </body>
</html>
