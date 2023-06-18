<?php

   include 'conexionBDD.php';  //incluimos el archivo que conecta con la Base de Datos ("conexionBDD.php"). --> Permite usar la variable "$conexion" dentro de mysqli_query() y conectar con la BDD.

   session_start();            //iniciamos sesión en este archivo. 

?>


<html>
   
   <head>
     
      <meta charset="UTF-8"> 
      <link rel="stylesheet" href="bookline.css">  <!-- CSS externo -->

      <!-- CSS interno  -------------------------------------------------------------------->
      <style>        
         table, th, td {
         border: 1px solid red;
         padding: 3px;
         }
         .prueba {
            border: 1px solid green;
            padding: 3px;
         }
         .prueba_1 {
            border: 3px solid purple;
            padding: 3px;
         }
      </style>

   </head>
   
   <body class="body_log_admin">
         
      <!-- HTML ----------------------------------------------------------------------------------->
      <div class="div_titulo">
         <h1>Administrador/a: <?php echo $_SESSION['nombre_usuario']; ?> </h1> 
         <h3> Tus funciones como administrador son las siguientes: </h3>
         <ul>
            <li><p> (1) Añadir o eliminar usuarios. 
                     Para ello, utiliza las tablas correspondientes de abajo.</p></li>
            <li><p> (2) Comprobar el historial de compraventas. 
                     Para ello, haz clic en: <a href = 'compra-ventas.php'> ver historial de compraventas</a>.</p></li>
         </ul>
         <p> ¿Has terminado? Haz clic en: <a href = 'logout.php'> Cerrar sesión</a>.</p>
      </div>

      <!-- En este formulario posibilitaremos que el administrador pueda añadir usuarios -->
      <div class="tabla_usuarios">
         <form action="accion_administrador.php" method="POST">
               <fieldset>                             
                  <legend> <b><h4> AÑADIR USUARIOS </h4></b> </legend>   
                  <label for="id_puesto">Selecciona el tipo del nuevo usuario:</label> 
                  <select id="id_puesto" name="puesto" value=""> 
                     <option value="cliente"> Usuario Cliente </option>
                     <option value="empleado"> Usuario Empleado </option>
                     <option value="administrador"> Usuario Administrador </option>
                  </select>
                  <br><br>
                  <label for="id_email">Introduce el email del nuevo usuario:</label>
                  <input type="email" id="id_email" name="email" value="" placeholder="Email (@)">
                  <br><br>
                  <label for="id_contrasena">Introduce la contraseña del nuevo usuario:</label>
                  <input type="password" id="id_contrasena" name="contrasena" value= "" placeholder="Contraseña">
                  <br><br>
                  <label for="id_nombre">Introduce el nombre del nuevo usuario:</label>
                  <input type="text" id="id_nombre" name="nombre" value="" placeholder="Nombre">
                  <br><br>
                  <label for="id_submit">Para finalizar, haz clic en:</label>
                  <input type="submit" id="id_submit" name="anadir_usuario" value="Clic aquí para añadir usuario">
               </fieldset>
         </form>
      </div>

      <br>
      
      <!-- PHP ----------------------------------------------------------------------------------->
      <?php

         // Preparamos la tabla y su cabecera:
         echo "
         <div class='tabla_usuarios'>
            <fieldset> 
               <legend> <b><h4> ELIMINAR USUARIOS </h4></b> </legend>
                  <table>\n 
                  <tr>\n
                     <th>usuarioID</th>\n
                     <th>puesto</th>\n
                     <th>email</th>\n
                     <th>contrasena</th>\n
                     <th>nombre</th>\n
                     <th>¿Eliminar usuario?</th>\n
                  </tr>\n
            </fieldset>
         </div>";

         //Conectamos y hacemos $comando_sql (query).
         $comando_sql = "SELECT usuarioID, puesto, email, contrasena, nombre FROM tablausuarios";
         $ejecucion = mysqli_query($conexion, $comando_sql); //--> conectas. Ahora, tienes q "pintar" la tabla.. (imprimirla)

         // Vamos imprimiendo acada una de las filas (registros) seleccionados en el $comando_sql SELECT anterior. 
         // Para ello, usamos la función "mysqli_fetch_assoc()", y la combinamos con un bucle "while". 
         // Asignamos el proceso anterior a la variable "$i", que usaremos para, en cada iteración del "while", ir asignando los valores que correspondan.
         // En la última columna añadimos un formulario (<form>), que posibilitará eliminar a un usuario. 
         
         
         while ($i = mysqli_fetch_assoc($ejecucion)) {
            echo "<tr>\n
                  <td>" . $i["usuarioID"] . "</td>\n
                  <td>" . $i["puesto"] . "</td>\n
                  <td>" . $i["email"] . "</td>\n
                  <td>" . $i["contrasena"] . "</td>\n
                  <td>" . $i["nombre"] . "</td>\n
                  <td><form action='accion_administrador.php' method='POST'>    
                     <input type='hidden' name='usuarioID' value='" . $i["usuarioID"] . "'>
                     <input type='hidden' name='nombre' value='" . $i["nombre"] . "'>
                     <input type='hidden' name='puesto' value='" . $i["puesto"] . "'>
                     <input type='submit' name='eliminar_usuario' value='Clic aquí para eliminar usuario'></form></td>\n
                  </tr>";
         };
      ?>
   
   </body>

   </html>

    
