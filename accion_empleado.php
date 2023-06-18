<html> 

  <head>

    <link rel="stylesheet" href="bookline.css">  <!-- CSS externo -->
    
  </head>

  <body>

    <?php

    include 'conexionBDD.php';  //incluimos el archivo que conecta con la Base de Datos ("conexionBDD.php"). --> Permite usar la variable "$conexion" dentro de mysqli_query() y conectar con la BDD.
    
    include 'funciones.php';
    
    session_start();            //iniciamos sesión en este archivo. 

    /*[1] Aquí accede un usuario "empleado" (no "cliente", ni el "administrador").
      [2] vamos a añadir/reducir "stock" del "idlibro" en cuestión, en la "tablalibros". */

    // Registro de nuevos libros: -----------------------------------
    if (isset($_POST['registrar_libro'])) { 

      $idlibro = $_POST['idlibro'];
      $autor = $_POST['Autor'];
      $titulo = $_POST['Titulo'];
      $genero = $_POST['Genero'];
      $precio = $_POST['Precio'];
      $stock = $_POST['Stock'];

      if(comprobar_id_libro($idlibro)) {

          $comando_sql = "INSERT INTO tablalibros (idlibro, Autor, Titulo, Genero, Precio, Stock) 
                      VALUES ('$idlibro', '$autor', '$titulo', '$genero', '$precio', '$stock')";
          $ejecutar = mysqli_query($conexion, $comando_sql);
          
          echo 
          "<div class='sms_exito'>
            <p> Has añadido el siguiente libro: </p>
            <ul>
              <li> Título: <b>$titulo</b> </li>
              <li> Autor/a: <i>$autor</i> </li>
            </ul>
            <p>Haz clic <a href='log_empleado.php'>aquí</a> para volver atrás.</p>
          </div>";

      } else {

        echo 
        "<p>El código ID indicado para el nuevo libro ya existe. Por favor, introduce otro número ID.</p>
        <p><a href = 'log_empleado.php'> Volver atrás. </a></p>";

      }

    }

    // Añadir o reducir "stock" del "idlibro" en cuestión, en la "tablalibros". --------------------

    if (isset($_POST['reducir'])) {

      $idlibro = $_POST['id']; //el 'id' viene del hidden name del input del form de log_empleado. Está vinculado al "form" del libro seleccionado, y se envía tras dar a submit 
      $reducir = $_POST['reducir'];

      // Reducimos "stock", basándonos en el "idlibro". Modificamos así la "tablalibros".
      $sql = "UPDATE tablalibros SET stock = stock - $reducir WHERE idlibro = $idlibro";
      $resultado = mysqli_query($conexion, $sql);

      echo 
      "<div class='sms_stock'>
        <p> Has ELIMINADO: </p> 
        <ul>
          <li> $reducir unidad(es) </li>
        </ul>
        <p> del stock del título seleccionado.</p>
        <p> Para volver atrás, haz <a href = 'log_empleado.php'>clic aquí.</a></p>
      </div>";

    } else if (isset($_POST['incrementar'])) {

      $idlibro = $_POST['id']; //el 'id' viene del hidden name del input del form de log_empleado. Está vinculado al "form" del libro seleccionado, y se envía tras dar a submit. 
      $incrementar = $_POST['incrementar'];

      // Añadimos "stock", basándonos en el "idlibro". Modificamos así la "tablalibros".
      $sql = "UPDATE tablalibros SET stock = stock + $incrementar WHERE idlibro = $idlibro";
      $resultado = mysqli_query($conexion, $sql);

      echo 
      "<div class='sms_stock'>
        <p> Has AÑADIDO:
        <ul> 
          <li> $incrementar unidad(es) </li>
        </ul>
        <p> al stock del título seleccionado.</p>
        <p> Para volver atrás, haz <a href = 'log_empleado.php'>clic aquí.</a></p>
      </div>";

    }

    ?>

  </body>

</html>