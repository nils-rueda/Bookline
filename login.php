<?php

    include 'conexionBDD.php';  /* incluimos el archivo que conecta con la Base de Datos ("conexionBDD.php"). 
    --> Permite usar la variable "$conexion" dentro de mysqli_query() y conectar con la BDD. */

    session_start();            //iniciamos sesión en este archivo. 

    if (isset($_POST['submit'])) {  //'submit' viene de "index.html", del index login, que tiene "action = login.php", con confundir con el del registro.
        $usuario = $_POST['usuario'];       // viene de "index.html"
        $password = $_POST['password'];     // viene de "index.html"
        $_SESSION['nombre_usuario'] = $usuario; //asigamos nombre de usuario para llevar a "log_cliente.php", "log_empleado.php", o "log_administrador.php".
                                                //Este $_SESSION[] se va a enviar a "log_cliente/empleado/administrador.php", y se usará para darle la bienvenida al usuario, sea del tipo que sea. 
        
        $comandoSQL_1 = "SELECT * FROM tablausuarios WHERE nombre = '$usuario' AND contrasena = '$password'";  
        $ejecuta = mysqli_query($conexion, $comandoSQL_1);

        $contar_filas = mysqli_num_rows($ejecuta); //"mysqli_num_rows" devuelve el nº de filas de un resultado.

        if($contar_filas == 1) {    //si el nº de filas es igual a 1, significa que el usuario y el password coinciden, por lo que procedemos loguearle.
        
            //seleccionamos el 'puesto' (tipo) del usuario. Dependiendo del 'puesto', se le remitirá a una página u otra. 
            $comandoSQL_2 = "SELECT puesto FROM tablausuarios WHERE nombre = '$usuario'";
            $ejecuta_2 = mysqli_query($conexion, $comandoSQL_2);  
            
            while ($fila = mysqli_fetch_assoc($ejecuta_2)) {    //tenemos q usar el fetch_assoc para seleccionar lo indicado anteriormente; luego, lo guardamos en una variable, "$puesto", para usarlo más abajo.
                $puesto = $fila['puesto']; 
            }
            
            if ($puesto == 'cliente') {                     // Usamos JavaScript para remitir a los usuarios a su página correspondiente, dependiendo del tipo de usuario que sea. 
                echo ("<script type='text/javascript'>    
                window.alert('Login cliente realizado.¡Bienvenid@!');
                window.location.href='log_cliente.php'; 
                </script>");
            } else if ($puesto == 'empleado') {
                echo ("<script type='text/javascript'>    
                window.alert('Login empleado/a realizado.¡Bienvenid@!');
                window.location.href='log_empleado.php'; 
                </script>");
            } else if ($puesto == 'administrador') {
                echo ("<script type='text/javascript'>    
                window.alert('Login administrador/a realizado. ¡Bienvenid@!');
                window.location.href='log_administrador.php'; 
                </script>");
            } else {
            $error = "Tu nombre de usuario o tu contraseña son incorrectos.";
            }
        } else {
            echo "<p> Error: el nombre de usuario y la contraseña no coinciden. </p>";
            echo "<p><a href='index.html'> Volver atrás. </a></p>";
        }
    }
    
?>