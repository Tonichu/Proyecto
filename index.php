<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="librerias/css/estilo_pag_principal.css">
  <link rel="stylesheet" href="librerias/css/modal.css">
  <link rel="stylesheet" href="librerias/css/card-carrusel.css">
  <link rel="stylesheet" href="librerias/css/carrusel-imagenes.css">
</head>

<body>
  <!-- Navbar con los modal incluidos -->
  <div class="header">
    <div class="container">
      <div class="navbar">
        <div class="logo">
          <h2>BUNKAY</h2>
        </div>
        <div class="menu">
          <nav>
            <ul>
              <li><a href="index.php">Inicio</a></li>
              <li><a href="index.php?page=google_maps">Conócenos</a></li>
              <li><a href="index.php?page=actividades">Precios</a></li>
              <li><a href="">Eventos</a></li>
              <li>

                <div class="modal-container">
                  <button class="modal-button" onclick="window.modal1.showModal();">Área clientes</button>

                  <dialog id="modal1" class="modal-dialog">
                    <div class="container">
                      <div class="card">
                        <h2 class="modal-title">Iniciar Sesión</h2>
                        <form class="formIndex" action="pages/usuarios/comprobar_usuario.php" method="post">
                          <div class="form-group">
                            <label for="Email">Correo Electrónico:</label>
                            <input type="text" id="Email" name="Email" required>
                          </div>
                          <div class="form-group">
                            <label for="password">Contraseña:</label>
                            <input type="password" id="password" name="password" required>
                          </div>
                          <input class="btn submit-button" type="submit" value="Iniciar Sesión">
                        </form>
                      </div>
                    </div>
                    <button class="btn modal-close-button" onclick="window.modal1.close();">Cerrar</button>
                  </dialog>

                </div>
              </li>

              <li>
                <div class="modal-container">
                  <button class="modal-button" onclick="window.modal2.showModal();">Inscribirse</button>

                  <dialog id="modal2" class="modal-dialog">
                    <div class="container">
                      <div class="card">
                        <h2 class="modal-title">Registro de Usuario</h2>
                        <form action="pages/usuarios/crear_usuario.php" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" required><br><br>
                          </div>

                          <div class="form-group">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" id="apellidos" name="apellidos" required><br><br>
                          </div>

                          <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" id="telefono" name="telefono"><br><br>
                          </div>

                          <div class="form-group">
                            <label for="correo">Correo Electrónico:</label>
                            <input type="email" id="correo" name="correo" required><br><br>
                          </div>

                          <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" id="direccion" name="direccion"><br><br>
                          </div>

                          <div class="form-group">
                            <label for="pass">Contraseña:</label>
                            <input type="password" id="pass" name="pass" required><br><br>
                          </div>

                          <div class="form-group">
                            <label for="foto">Foto de Perfil:</label>
                            <input type="file" id="foto" name="foto"><br><br>
                          </div>

                          <input class="btn submit-button" type="submit" value="Registrarse">
                          <button class="btn modal-close-button" onclick="window.modal2.close();">Cerrar</button>
                        </form>
                      </div>
                    </div>
                  </dialog>

                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </div>

  <!-- Descripción con slogan y frase motivacional -->
  <div class="background-container">
    <h1 class="slogan">Ejercicio con Propósito. ¡BUNKAY!</h1>
    <p class="discount">¡Matrícula al 50%!</p>
    <p class="description-slogan">Descubre una experiencia única en fitness. Ven a Bunkay, donde te ayudamos a alcanzar
      tus
      metas de manera divertida y efectiva. ¡Únete a nuestra comunidad hoy mismo!</p>
  </div>

  <!-- Descripción del gimnasio y horarios -->
  <div class="container-descipcion">
    <div class="description-70">
      <h2>¡Descubre el gimnasio que revolucionará tu estilo de vida!</h2>
      <p>Enclavado en un amplio polígono industrial, nuestras modernas instalaciones ocupan vastas naves que te invitan
        a explorar y alcanzar tus metas fitness.</p>
      <p>Con una misión clara de promover la salud y el bienestar, nuestro gimnasio te ofrece un ambiente acogedor y
        motivador donde podrás superarte día a día. Desde rutinas de entrenamiento personalizadas hasta clases grupales
        emocionantes, aquí encontrarás todo lo que necesitas para alcanzar tus objetivos de forma eficaz y divertida.
      </p>
    </div>
    <div class="side-content">
      <div class="opening-hours">
        <h2>Horario de Apertura:</h2>
        <br />
        <p><strong>Lunes a Viernes: </strong>
          <br />8:00 - 22:00
        </p>
        <p><strong>Sábados: </strong>
          <br />10:00 - 20:00
        </p>
        <p><strong>Domingos y Festivos:</strong>
          <br />10:00 - 14:00
        </p>
      </div>
      <div class="message">
        <p>¡En nuestro gimnasio, cada día es una oportunidad para alcanzar nuevas alturas y superar tus límites! ¡Te
          esperamos para vivir una experiencia fitness inigualable!</p>
      </div>
    </div>
  </div>

  <!-- Carrousel de imagenes -->
  <div class="body">
    <div class="carousel">
      <div class="list">
        <div class="item">
          <img
            src="https://www.shutterstock.com/image-illustration/modern-fitness-gym-center-information-260nw-2242253485.jpg">
          <div class="content">
            <div class="title">RECIBIDOR</div>
            <div class="topic">BIENVENIDA A LOS CLIENTES</div>
            <div class="des">
              Amplio recibidor de bienvenida a los clientes donde encontraras nuestra cara visible del gimnasio. En él
              encontrara a los chicos / las chicas más profesionales. Se te explicará de las instalaciones que se
              compone nuestro gimnasio y se te aserorará sobre los beneficios de cada actividad explicandote con amplio
              detalle en que consiste cada una

            </div>
            <div class="buttons">
              <button>DETALLES</button>
              <button>SUBSCRIBITE</button>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="https://www.dreamfit.es/assetsup/imagescentros/centro_02_02.jpg">
          <div class="content">
            <div class="title">ZONA CARDIO</div>
            <div class="topic">CALORIAS DEMÁS</div>
            <div class="des">
              ¡Bienvenidos a nuestra Zona de Cardio! Aquí encontrará equipos de última generación y orientación
              experta para ayudarle a mejorar la salud de su corazón y su condición -general. Nuestra sala
              espaciosa y bien equipada ofrece una variedad de máquinas y estaciones de entrenamiento diseñadas para
              mejorar la resistencia, fortalecer el corazón y estimular la circulación.
            </div>
            <div class="buttons">
              <button>DETALLES</button>
              <button>SUBSCRIBITE</button>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="https://www.blkboxfitness.com/cdn/shop/articles/Club_Design.png?v=1593591281">
          <div class="content">
            <div class="title">ENTRENAMIENTO FUNCIONAL</div>
            <div class="topic">ENTRENA EL DÍA A DÍA</div>
            <div class="des">
              ¡Explora nuevos límites en nuestra Sala de Entrenamiento Funcional! Diseñada para desafiar tu cuerpo en
              todas las dimensiones, nuestra sala ofrece un enfoque único para mejorar tu fuerza, flexibilidad y
              coordinación. Equipada con una variedad de equipos versátiles y espacios abiertos para ejercicios de
              cuerpo completo, cada sesión en nuestra sala te lleva más cerca de alcanzar tus metas de fitness de manera
              eficiente y efectiva.
            </div>
            <div class="buttons">
              <button>DETALLES</button>
              <button>SUBSCRIBITE</button>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="https://el-boulevard.com/wp-content/uploads/2022/05/FITNESS-PARK_eb.jpg">
          <div class="content">
            <div class="title">SALA FITNESS</div>
            <div class="topic">ENTRENAMIENTO TOTAL</div>
            <div class="des">
              ¡Bienvenido a nuestra Sala Fitness, donde tu transformación comienza! Aquí, te ofrecemos un espacio de
              entrenamiento completo diseñado para desafiar tu cuerpo y llevar tu condición física al siguiente nivel.
              Equipada con la última tecnología y una amplia gama de equipos de alta calidad, nuestra sala ofrece
              infinitas posibilidades para tu rutina de ejercicio.
            </div>
            <div class="buttons">
              <button>DETALLES</button>
              <button>SUBSCRIBITE</button>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="https://www.cmdsport.com/app/uploads/2016/12/ciclismo-indoor-dreamfit-villaverde.jpg">
          <div class="content">
            <div class="title">CICLO INDOR</div>
            <div class="topic">SPINNING</div>
            <div class="des">
              ¡Bienvenido a nuestra Sala de Ciclo Indoor de élite, donde la pasión por el spinning se fusiona con un
              enfoque profesional para llevarte a un viaje transformador de fitness y bienestar! Sumérgete en una
              atmósfera dinámica y energizante, donde la música vibrante y las luces envolventes te transportarán a un
              estado de motivación sin igual.
            </div>
            <div class="buttons">
              <button>DETALLES</button>
              <button>SUBSCRIBITE</button>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="https://www.dreamfit.es/assetsup/imagescentros/zQaCdL7rqmoR5sywTemlSvNSoSQXmmRFNmHs05Y5.jpg">
          <div class="content">
            <div class="title">BURBUJA VIRTUAL</div>
            <div class="topic">INNOVACIÓN Y TECNOLOGÍA</div>
            <div class="des">
              Sumérgete en la vanguardia del fitness con nuestra sala de gimnasio convertida en una burbuja virtual,
              donde la innovación y la tecnología se fusionan para ofrecerte una experiencia de entrenamiento única y
              envolvente.
            </div>
            <div class="buttons">
              <button>DETALLES</button>
              <button>SUBSCRIBITE</button>
            </div>
          </div>
        </div>
        <div class="item">
          <img
            src="https://forus.es/wp-content/uploads/2022/07/Forus-Granada.jpg">
          <div class="content">
            <div class="title">ZONA SPA</div>
            <div class="topic">RECUPERACIÓN</div>
            <div class="des">
              ¡Bienvenido a nuestro exquisito Oasis de Recuperación en el Spa! Aquí, te invitamos a sumergirte en un
              mundo de relajación y rejuvenecimiento donde cuerpo y mente se funden en armonía. Experimenta la serenidad
              mientras te entregas a tratamientos rejuvenecedores diseñados para revitalizar tu energía y restaurar tu
              bienestar interior.
            </div>
            <div class="buttons">
              <button>DETALLES</button>
              <button>SUBSCRIBITE</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Lista de miniaturas -->
      <div class="thumbnail">
        <div class="item">
          <img
            src="https://www.shutterstock.com/image-illustration/modern-fitness-gym-center-information-260nw-2242253485.jpg">
          <div class="content">
            <div class="title">
              RECIBIDOR
            </div>
            <div class="description">
              BIENVENIDA
            </div>
          </div>
        </div>
        <div class="item">
          <img src="https://www.dreamfit.es/assetsup/imagescentros/centro_02_02.jpg">
          <div class="content">
            <div class="title">
              ZONA CARDIO
            </div>
            <div class="description">
              CALORIAS DEMÁS
            </div>
          </div>
        </div>
        <div class="item">
          <img src="https://www.blkboxfitness.com/cdn/shop/articles/Club_Design.png?v=1593591281">
          <div class="content">
            <div class="title">
              ENTRENAMIENTO FUNCIONAL
            </div>
            <div class="description">
              DÍA A DÍA
            </div>
          </div>
        </div>
        <div class="item">
          <img src="https://el-boulevard.com/wp-content/uploads/2022/05/FITNESS-PARK_eb.jpg">
          <div class="content">
            <div class="title">
              SALA FITNESS
            </div>
            <div class="description">
              ENTRENAMIENTO TOTAL
            </div>
          </div>
        </div>
        <div class="item">
          <img src="https://www.cmdsport.com/app/uploads/2016/12/ciclismo-indoor-dreamfit-villaverde.jpg">
          <div class="content">
            <div class="title">
              CICLO INDOR
            </div>
            <div class="description">
              SPINNING
            </div>
          </div>
        </div>
        <div class="item">
          <img src="https://www.dreamfit.es/assetsup/imagescentros/zQaCdL7rqmoR5sywTemlSvNSoSQXmmRFNmHs05Y5.jpg">
          <div class="content">
            <div class="title">
              BURBUJA VIRTUAL
            </div>
            <div class="description">
              INNOVACIÓN Y TECNOLOGÍA
            </div>
          </div>
        </div>
        <div class="item">
          <img
            src="https://forus.es/wp-content/uploads/2022/07/Forus-Granada.jpg">
          <div class="content">
            <div class="title">
              ZONA SPA
            </div>
            <div class="description">
              RECUPERACIÓN
            </div>
          </div>
        </div>
      </div>
      <!-- next prev -->

      <div class="arrows">
        <button id="prev">
          < </button>
            <button id="next">></button>
      </div>
      <!-- time running -->
      <div class="time"></div>
    </div>
  </div>


  <!-- Slider carrusel de card modo explicación -->
  <h1 class="title-card-carrusel">Características</h1>
  <div class="cuerpo">
    <div class="card-carrusel">
      <div class="face front">
        <img
          src="https://img.freepik.com/fotos-premium/sesion-fotos-profesional-gimnasio-totalmente-equipado-equipo-fitness-ia_894067-8720.jpg"
          alt="">
        <h3>Todo incluido</h3>
      </div>
      <div class="face back">
        <h3>Todo incluido</h3>
        <p>Mejor relación calidad / precio / cliente.</p>
        <div class="link">
          <a href="#">Detalles</a>
        </div>
      </div>
    </div>

    <div class="card-carrusel">
      <div class="face front">
        <img src="https://institutodyn.com/wp-content/uploads/como-ser-monitor-de-gimnasio-1024x675.jpg" alt="">
        <h3>Sin permanencia</h3>
      </div>
      <div class="face back">
        <h3>Sin permanencia</h3>
        <p>Nuestra preocupación, nuestros clientes. Tú decides cuándo te vas.</p>
        <div class="link">
          <a href="#">Detalles</a>
        </div>
      </div>
    </div>

    <div class="card-carrusel">
      <div class="face front">
        <img src="https://res.cloudinary.com/dvjfemxbz/image/upload/2d1dba31-871b-4263-8c5a-864805dadc6c_sqlwv3.png"
          alt="">
        <h3>Innovación y Tecnología</h3>
      </div>
      <div class="face back">
        <h3>Innovación y Tecnología a tú alcance</h3>
        <p>Las mejores salas con la última tecnología del mercado</p>
        <div class="link">
          <a href="#">Detalles</a>
        </div>
      </div>
    </div>

    <div class="card-carrusel">
      <div class="face front">
        <img src="https://www.unir.net/wp-content/uploads/2023/08/monitordegimnasio2.jpg" alt="">
        <h3>Multitud de actividades</h3>
      </div>
      <div class="face back">
        <h3>Multitud de actividades dirigidas al mes</h3>
        <p>Tendrás a tu disposición una variedad de actividades dirigidas por nuestros mejores
          monitores.</p>
        <div class="link">
          <a href="#">Detalles</a>
        </div>
      </div>
    </div>

    <div class="card-carrusel">
      <div class="face front">
        <img src="https://www.dir.cat/themes/custom/dir/images/spa.jpg" alt="">
        <h3>Zona spa</h3>
      </div>
      <div class="face back">
        <h3>¡Relájate en nuestro exquisito Spa!</h3>
        <p>Sumérgete en un oasis de tranquilidad y bienestar con nuestra exclusiva zona de Spa. Disfruta de un ambiente
          relajante diseñado para rejuvenecer cuerpo y mente.¡Ven y vive una experiencia única!</p>
        <div class="link">
          <a href="#">Detalles</a>
        </div>
      </div>
    </div>
  </div>


  <footer>
    <div class="social-icons">
      <a href="https://www.instagram.com/" target="_blank"><img src="librerias/iconos/instagram.png"
          alt="Instagram"></a>
      <a href="https://www.facebook.com/" target="_blank"><img src="librerias/iconos/facebook.png" alt="Facebook"></a>
      <a href="https://twitter.com/?lang=es" target="_blank"><img src="librerias/iconos/twitter.png" alt="Twitter"></a>
      <a href="https://www.linkedin.com/" target="_blank"><img src="librerias/iconos/linkedin.png" alt="LinkedIn"></a>
      <a href="https://www.youtube.com/" target="_blank"><img src="librerias/iconos/youtube.png" alt="YouTube"></a>
      <a href="https://www.tiktok.com/" target="_blank"><img src="librerias/iconos/tiktok.png" alt="TikTok"></a>
    </div>
    <div class="divider"></div>
  </footer>

  <script src="librerias/javascript/pagina_principal_carrusel.js"></script>

</body>

</html>