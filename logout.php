<?php

    // Primero, iniciamos sesión:
    session_start();

    // A continuación, destruimos la sesión. Eliminaramos todo lo que esté incluido en "$_SESSION"
    session_destroy();

    // Por último, volvemos al formulario
    header("Location: index.html");

?>