<?php

    //esta función está invocada en 2 ocasiones: 1) en "registro.php" y 2) en "accion_administrador.php".
    function comprobar_usuario($usuario, $email) {
        include "conexionBDD.php";
        $comando_sql = "SELECT * FROM tablausuarios WHERE nombre = '$usuario' OR email = '$email'";  
        $ejecutar = mysqli_query($conexion, $comando_sql);  
        
        $contar_filas = mysqli_num_rows($ejecutar); //"mysqli_num_rows" --> Devuelve el nº de filas de un resultado.
        if($contar_filas == 0) {    //si el nº de files es igual a 0, significa que ni el usuario ni el email existen, por lo que insertamos los datos del nuevo usuario.
            return true;
        } else {
            return false;
        }
    }


    function comprobar_id_libro($idlibro) {
        include "conexionBDD.php";
        $comando_sql = "SELECT * FROM tablalibros WHERE idlibro = '$idlibro'";  
        $ejecutar = mysqli_query($conexion, $comando_sql);  
        
        $contar_filas = mysqli_num_rows($ejecutar); //"mysqli_num_rows" --> Devuelve el nº de filas de un resultado.
        if($contar_filas == 0) {    //si el nº de filas es igual a 0, significa que ni usuario ni el email existen, por lo que devolvemos "true".
            return true;
        } else {
            return false;
        }
    }



?>