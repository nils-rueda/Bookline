<html>
  
  <link rel="stylesheet" href="bookline.css">  <!-- CSS externo -->

  <?php
    
    include 'conexionBDD.php';  //incluimos el archivo que conecta con la Base de Datos ("conexionBDD.php"). --> Permite usar la variable "$conexion" dentro de mysqli_query() y conectar con la BDD.
    
    session_start();            //iniciamos sesión en este archivo. 
    
    /* [1] Aquí accede un usuario "cliente" (no los "empleados", ni los "administradores").
       [2] vamos a restar una unidad al "stock" del "idlibro" en cuestión, en la "tablalibros". 
       [3] vamos a enviar la info a "compra_ventas.php" para registrar la compra. */

    $idlibro = $_POST['id'];  /*El 'id' viene del hidden name del input del formulario de log_cliente, incrustado en la celda de la tabla de libros.
                              Está vinculado al "form" del libro seleccionado, y se envía tras dar a submit.*/
    $precio = $_POST["pre"]; //También proviene del formulario del log_cliente.


    // Restamos una unidad al "stock" del libro comprado, basándonos en su "idlibro". Modificamos así la "tablalibros".
    $comando_sql = "UPDATE tablalibros SET stock = stock -1 WHERE idlibro = $idlibro";
    $ejecucion = mysqli_query($conexion, $comando_sql);

    // Seleccionamos el Autor y Título del libro comprado, basándonos en su "idlibro", para informar al cliente de lo que ha comprado.
    $comando_sql = "SELECT Autor, Titulo FROM tablalibros WHERE idlibro = $idlibro";
    $ejecucion = mysqli_query($conexion, $comando_sql);

    while($i = mysqli_fetch_array($ejecucion)) {
      echo 
      "<div class='sms_exito'>
        <p> Gracias por comprar un ejemplar de: </p>
        <p><h2>" . $i['Autor'] . " - " . $i['Titulo'] . "</h2></p>
        <br>
        <p>¿Quieres seguir comprando? <a href='log_cliente.php'>Clic aquí</a> para volver. </p>
      </div>";
    }

    // Insertar info en la tabla de compra-ventas, para registrar la compra. Podrán visualizar la tabla los empleados y el administrador, desde sus páginas de "accion".
    $fecha = date("Y-m-d");

    $comando_sql = "INSERT INTO tablacompraventas (fecha_compraventa, idlibro, precio_unidad) 
            VALUES ('$fecha', '$idlibro', '$precio')";
    $ejecucion = mysqli_query($conexion, $comando_sql);

  ?>

</html>