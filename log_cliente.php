<?php

include 'conexionBDD.php';  /* incluimos el archivo que conecta con la Base de Datos ("conexionBDD.php"). 
--> Permite usar la variable "$conexion" dentro de mysqli_query() y conectar con la BDD. */

session_start();            //iniciamos sesión en este archivo. 

?>

<html>

   <head>
      <meta charset="UTF-8">  
      <link rel="stylesheet" href="bookline.css">  <!-- CSS externo -->

      <!-- CSS interno  ----------------------------------------------------------------------------------->
      <style>        
         table, th, td {
         border: 1px solid black;
         background-color: white;
         }
      </style>
   </head>

   <body class="body_log_cliente">

   <!-- HTML ----------------------------------------------------------------------------------->
   <div class="div_titulo">
      <h1>Bienvenid@ <?php echo $_SESSION['nombre_usuario']; ?></h1> 
      <h3> ¡Consulta nuestra oferta de libros a los mejores precios! </h3>
      <p>Cuando termines, haz clic en: <a href = 'logout.php'> Cerrar sesión </a></p>
   </div>

   <!-- PHP ----------------------------------------------------------------------------------->
   <?php
         // Preparamos la tabla y su cabecera:
         echo 
         "<div class='tabla_log_cliente'>
            <table>\n 
            <tr>\n
               <th>idlibro</th>\n
               <th>AUTOR</th>\n
               <th>TITULO</th>\n
               <th>GENERO</th>\n
               <th>PRECIO</th>\n
            </tr>\n
         </div>";

         //Conectamos con la base de datos y realizamos el $comando_sql SELECT.
         $comando_sql = "SELECT idlibro, Autor, Titulo, Genero, Precio FROM tablalibros";
         $ejecuta = mysqli_query($conexion, $comando_sql);

         // Vamos imprimiendo acada una de las filas (registros) seleccionados en la el $comando_sql SELECT anterior. 
         // Para ello, usamos la función "mysqli_fetch_assoc()", y la combinamos con un bucle "while". 
         // Asignamos el proceso anterior a la variable "$i", que usaremos para, en cada iteración del "while", ir asignando los valores que correspondan.
         // En la última columna añadimos un formulario, <form>, que incluye un botón de compra. El "action" del <form> remite, en esta ocasión, a "accion_cliente". 
         // En el <form> incluiremos, también, 2 inputs de tipo "hidden", para enviar la información correspondiente (idlibro, y precio) al archivo "accion_cliente". 
       
         while ($i = mysqli_fetch_assoc($ejecuta)) {
				echo "<tr>\n
                  <td>" . $i["idlibro"] . "</td>\n
                  <td>" . $i["Autor"] . "</td>\n
						<td>" . $i["Titulo"] . "</td>\n
						<td>" . $i["Genero"] . "</td>\n
						<td>" . $i["Precio"] . "</td>\n
                  <td><form action='accion_cliente.php' method='POST'>
                     <input type='hidden' name='id' value='" . $i["idlibro"] . "'> 
                     <input type='hidden' name='pre' value='" . $i["Precio"] . "'>
                     <input type='submit' name='comprar' value='comprar'></form></td>\n
                  </tr>";
			};
			
   ?>
   </body>

</html>
