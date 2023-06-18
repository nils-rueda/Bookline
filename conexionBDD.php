<?php

    /* Creamos la conexión con nuestra BDD, y asignamos dicha conexión a la variable "$conexion".
		Gracias a esta operación, podremos reutilizar estas líneas de código en los demás archivos, 
		y podremos usar en ellos la variable "$conexion" para conectar con la BDD. 
    */

		//Variables clave para realizar la conexión:
		$servidor = "localhost";  
		$usuario = "root";	
		$password = ""; 
		$bbdd = "bddlibreria"; // es la BBD con la que conectamos.

		//Conectamos con la BDD, y lo asignamos a la variable "$conexion":
		$conexion = mysqli_connect($servidor, $usuario, $password, $bbdd);

		//En caso de error en la conexión:
		if (!$conexion) {
			die("<p>Error en la conexión con la Base de Datos: </p>" . mysqli_connect_error());
		}
		/* Si la conexión se realiza correctamente, se mostrará una pequeña luz verde (una imagen muy pequeña) 
		en la parte superior/izquierda de la pantalla (en lugar de poner un mensaje que informe del éxito 
		con la conexión). De esta forma, podemos mantener un control durante el desarrollo del proyecto, 
		sabiendo si la conexión se ha realizado con éxito, de forma discreta:  
		*/
		else {
			echo "<img src='imagenes/green_light.png' width='10' height='10'>"; 
			return $conexion;	//devolvemos la variable "$conexion", posibilitando la conexión con la BDD. 
		}

		
