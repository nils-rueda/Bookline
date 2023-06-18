<?php

   include 'conexionBDD.php';  /* incluimos el archivo que conecta con la Base de Datos ("conexionBDD.php"). 
   --> Permite usar la variable "$conexion" dentro de mysqli_query() y conectar con la BDD. */
   
   session_start();            //iniciamos sesión en este archivo. 

?>


<html>
   
   <head>
      <meta charset="UTF-8">  
      <link rel="stylesheet" href="bookline.css">  <!-- CSS externo -->

      <!-- CSS interno ----------------------------------------------------------------------------------->
      <style>        
         table, th, td {
         border: 1px solid blue;
         padding: 3px;
         }
      </style>
   </head>

   <body class="body_log_empleado">

      <!-- HTML ----------------------------------------------------------------------------------->
      <div class="div_titulo">
         <h1>Emplead@: <?php echo $_SESSION['nombre_usuario']; ?> </h1> 
         <br> 
         <h3> Tus funciones como empleado son las siguientes: </h3>
         <ul>
            <li>(1) Añadir nuevos libros (nuevos títulos) a la base de datos. 
                     Para ello, utiliza el formulario correspondiente más abajo.</li>
            <li>(2) Modificar el stock de los libros (incrementar o reducir el nº de ejemplares disponibles). 
                     Para ello, en la tabla correspondiente de abajo, introduce la cantidad 
                     en la casilla correspondiente y, a continuación, pulsa "enter" en tu teclado.</li>
            <li>(3) Comprobar el historial de compraventas. 
                     Para ello, haz clic en: <a href = 'compra-ventas.php'> ver historial de compraventas</a>.</li>
         </ul>
         <br>
         <p> ¿Has terminado? Haz clic en: <a href = 'logout.php'> Cerrar sesión</a>.</p>
      </div>

      <!-- En este formulario, posibilitaremos que el empleado pueda registrar un nuevo libro en la base de datos (un nuevo título) -->
      <div class="tabla_nuevo_libro">
         <form action="accion_empleado.php" method="POST">
            <fieldset>                             
               <legend><h2> (1) Nuevos libros </h2></legend>   
               <br>
               <label for="idlibro"> ID del nuevo libro:</label> 
               <input type="number" id="idlibro" name="idlibro" value="" placeholder="nuevo idlibro">
               <br><br>
               <label for="Autor"> Autor/a del nuevo libro:</label>
               <input type="text" id="Autor" name="Autor" value="" placeholder="nuevo Autor">
               <br><br>
               <label for="Titulo">Título del nuevo libro:</label>
               <input type="text" id="Titulo" name="Titulo" value= "" placeholder="nuevo Titulo">
               <br><br>
               <label for="Genero">Género del nuevo libro::</label>
               <input type="text" id="Genero" name="Genero" value="" placeholder="nuevo Genero">
               <br><br>
               <label for="Precio">Precio del nuevo libro:</label>
               <input type="number" id="Precio" name="Precio" value="" placeholder="nuevo Precio">
               <br><br>
               <label for="Stock">Stock disponible del nuevo libro:</label>
               <input type="number" id="Stock" name="Stock" value="" placeholder="nuevo Stock">
               <br><br>
               <label for="id_submit">Para registrar el nuevo libro, haz clic en:</label>
               <input type="submit" id="id_submit" name="registrar_libro" value="Registrar nuevo libro">
            </fieldset>
         </form>
      </div>

      <br><br><br>

      
      <!-- PHP ----------------------------------------------------------------------------------->
      <?php
            // Preparamos la tabla y su cabecera:
         echo "
         <div class='tabla_stock_libros'>
            <fieldset>
               <legend><h2> (2) Modificar stock: incrementar/reducir nº de ejemplares </h2></legend>
               <br>
               <table>\n 
               <tr>\n
                  <th>idlibro</th>\n
                  <th>AUTOR</th>\n
                  <th>TITULO</th>\n
                  <th>GENERO</th>\n
                  <th>PRECIO</th>\n
                  <th>STOCK</th>\n
                  <th> (+) <br> Nº de ejemplares a incrementar <br> (pulsa 'enter' tras introducir la cantidad) </th>\n
                  <th> (-) <br> Nº de ejemplares a reducir <br> (pulsa 'enter' tras introducir la cantidad) </th>\n
               </tr>\n
            </fieldset>
         </div>";


         //Conectamos con la base de datos y realizamos el $comando_sql SELECT.
         $comando_sql = "SELECT * FROM tablalibros";
         $ejecucion = mysqli_query($conexion, $comando_sql); 

         // Vamos imprimiendo acada una de las filas (registros) seleccionados en el $comando_sql SELECT anterior. 
         // Para ello, usamos la función "mysqli_fetch_assoc()", y la combinamos con un bucle "while". 
         // Asignamos el proceso anterior a la variable "$i", que usaremos para, en cada iteración del "while", ir asignando los valores que correspondan.
         // En la última columna añadimos 2 formularios (<form>), que posibilitarán crear un botón para incrementar o reducir el stock de los libros. 
         
         while ($i = mysqli_fetch_assoc($ejecucion)) {
            echo "<tr>\n
                  <td>" . $i["idlibro"] . "</td>\n
                  <td>" . $i["Autor"] . "</td>\n
                  <td>" . $i["Titulo"] . "</td>\n
                  <td>" . $i["Genero"] . "</td>\n
                  <td>" . $i["Precio"] . "</td>\n
                  <td>" . $i["Stock"] . "</td>\n
                  <td><form action='accion_empleado.php' method='POST'>    
                     <input type='hidden' name='id' value='" . $i["idlibro"] . "'>
                     <input type='number' name='incrementar' value='0'></form></td>\n
                  <td><form action='accion_empleado.php' method='POST'>    
                     <input type='hidden' name='id' value='" . $i["idlibro"] . "'>
                     <input type='number' name='reducir' value='0'></form></td>\n
                  </tr>";
         };
            

      ?>

   </body>

</html>

    
