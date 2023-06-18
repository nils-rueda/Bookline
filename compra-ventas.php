<html> 


  <head>

      <meta charset="UTF-8">  
      <link rel="stylesheet" href="bookline.css">  <!-- CSS externo -->

  </head>


  <body class="body_comprasventas ">

    <div class="div_titulo">
      <h3> Información sobre todas las compraventas realizadas </h3>
      <p> Para terminar, haz clic en: </p> 
      <button class="boton_negro" onclick="cerrar_sesion()">Cerrar sesión</button>

      
      <!-- JavaScript: usamos JS para poder editar el "button" anterior con CSS,
      y poder usarlo como un "submit", es decir, reenviar a otra página.-->
      <script>                        
          function cerrar_sesion() {
            location.replace("logout.php")
          }
      </script>

    </div>


    <!-- CSS interno ----------------------------------------------------------------------------------->
    <style>        
          table, th, td {
          border: 1px solid black;
          }
    </style>

    <!-- PHP ----------------------------------------------------------------------------------> 
    <?php

      include 'conexionBDD.php';  //incluimos el archivo que conecta con la Base de Datos ("conexionBDD.php"). --> Permite usar la variable "$conexion" dentro de mysqli_query() y conectar con la BDD.
      
      session_start();            //iniciamos sesión en este archivo.


        // Preparamos la tabla y su cabecera:
        echo 
        "<div class='tabla_comprasventas'>
        <table>\n 
        <tr>\n
            <th>ID de la compraventa</th>\n
            <th>Fecha de la compraventa </th>\n
            <th>ID del libro</th>\n
            <th>Precio de la unidad</th>\n
        </tr>\n
        </div>";

        //preparamos el $comando_sql SELECT, y lo ejecutamos, para rellenar la tabla que acabamos de preparar. Después, con el while, vamos imprimiendo el contenido usando fetch_assoc. 
      $comando_sql = "SELECT * FROM tablacompraventas";
      $ejecucion = mysqli_query($conexion, $comando_sql);


      while ($i = mysqli_fetch_assoc($ejecucion)) {
        echo "<tr>\n
          <td>" . $i["id_compraventa"] . "</td>\n
          <td>" . $i["fecha_compraventa"] . "</td>\n
          <td>" . $i["idlibro"] . "</td>\n
          <td>" . $i["precio_unidad"] . "</td>";
    };

    ?>
  
  </body>
</html>

