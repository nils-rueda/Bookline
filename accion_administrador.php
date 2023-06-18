<html> 

  <head>
      <meta charset="UTF-8">  
      <link rel="stylesheet" href="bookline.css">  <!-- CSS externo -->
  </head>

  <body>
   
    <?php

      include 'conexionBDD.php';  //incluimos el archivo que conecta con la Base de Datos ("conexionBDD.php"). --> Permite usar la variable "$conexion" dentro de mysqli_query() y conectar con la BDD.
      
      include 'funciones.php';
      
      session_start();            //iniciamos sesión en este archivo. 


      // 1) Añadir usuarios y 2) Eliminar usuarios ----------------------------------------------------------------------------
      
      if (isset($_POST['anadir_usuario'])) {        //AÑADIMOS USUARIOS.

        $puesto = $_POST['puesto'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];
        $nombre = $_POST['nombre'];

          if (comprobar_usuario($nombre, $email)) {     //usamos la función para comprobar si el usuario ya existe.
              
            $comando_sql = "INSERT INTO tablausuarios (puesto, email, contrasena, nombre) 
                        VALUES ('$puesto', '$email', '$contrasena', '$nombre')";
            $ejecutar = mysqli_query($conexion, $comando_sql);
            echo 
            "<div class='sms_exito'>
                <p> Has CREADO el siguiente usuario: </p>
                <ul>
                  <li> Nombre: <h3><b>$nombre</b></h3></li>
                  <li> Tipo de usuario: <h3><i>$puesto</i> </h3></li>
                </ul>
                <p><a href='log_administrador.php'> Volver atrás. </a></p>
              </div>";

          } else {

              echo "<p> El nombre y/o el email del usuario que estás intentando registrar ya existe. Prueba otro.</p>
              <p><a href='log_administrador.php'> Volver atrás. </a></p>";
          }

      } else if (isset($_POST['eliminar_usuario'])) {     //ELIMINAMOS USUARIOS
        

        $usuarioID = $_POST['usuarioID'];
        $nombre = $_POST['nombre'];
        $puesto = $_POST['puesto'];
        
        $comando_sql = "DELETE FROM tablausuarios WHERE usuarioID = $usuarioID";
        $ejecutar = mysqli_query($conexion, $comando_sql);
        
        echo   
        "<div class='sms_exito'>
          <p> Has ELIMINADO el siguiente usuario: </p>
          <ul>
            <li> Nombre de usuario: <h3><b>$nombre</b></h3></li>
            <li> Tipo de usuario: <h3><b> $puesto</b></h2></li>
          </ul>
          <p> Para volver atrás, haz <a href='log_administrador.php'>clic aquí.</a></p>
        </div>";

      } else {

        echo "Ha habido un error al tratar de eliminar al usuario seleccionado.";
        echo "<p><a href='log_administrador.php'> Volver atrás. </a></p>";

      }

    ?>
  
    </body>

</html> 