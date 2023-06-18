<?php

  include 'conexionBDD.php';  /* incluimos el archivo que conecta con la Base de Datos ("conexionBDD.php"). 
                              --> Permite usar la variable "$conexion" dentro de mysqli_query() y conectar con la BDD. */
  include 'funciones.php';
  
  session_start();            //iniciamos sesión en este archivo. 

  // 1. REGISTRO DEL USUARIO:
  if (isset($_POST['submit'])) {    //este "submit" viene de "i_RegisterForm". 
    $usertype = 'cliente';          // el registro sólo crea "clientes". Los "empleados" y los "administradores" tienen que ser creados por un "administrador". 
    $email = $_POST['email']; 
    $password = $_POST['password'];
    $usuario = $_POST['usuario']; 
  } else {
    header("location: index.html"); //si alguien trata de acceder a la página por otros medios, se le devolverá al index.
  }

  //2. COMPROBAMOS QUE EL USUARIO NO EXISTE (que no haya un usuario con el mismo nombre y/o email):
  $comandoSQL = "SELECT * FROM tablausuarios WHERE nombre = '$usuario' OR email = '$email'";  
  $ejecucion = mysqli_query($conexion, $comandoSQL); 

  if (comprobar_usuario($usuario, $email)) { 
      $comandoSQL = "INSERT INTO tablausuarios (puesto, email, contrasena, nombre) 
                    VALUES ('$usertype', '$email', '$password', '$usuario')";
      $ejecucion = mysqli_query($conexion, $comandoSQL);
      $_SESSION['usuario'] = $usuario;              //A continuación, usamos JavaScript:
      echo ("<script type='text/javascript'>    
      window.alert('¡Éxito! Te has registrado. Ya puedes loguearte : )');
      window.location.href='index.html'; 
      </script>");
  } else {
      echo ("<script type='text/javascript'>    
      window.alert('Registro fallido. Ya existe un usuario con ese nombre y/o contraseña.');
      window.location.href='index.html'; 
      </script>");
  }

?>
