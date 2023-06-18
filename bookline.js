

// 1. LOGIN: Para que, en index.html, el <button id="btnLogin"> de html redirija a nueva página, "i_LoginForm.html".

var btnLogin_JS = document.getElementById("btnLogin");

btnLogin_JS.addEventListener('click', function() {
    location.href = "i_LoginForm.html";
});


// 2. REGISTRO: El del registro lo hice de otra forma, con puro html, usando <a href="i_Register.html", para probar 2 formas diferentes de redirigir (uno con JavaScript, el otro con puro HTML).



/*  *********** Atrezzos ***********
(no consigo hacerlo con .getElementByClassName()): */

var atrezzo1_JS = document.getElementById("atrezzo1");
var atrezzo2_JS = document.getElementById("atrezzo2");
var atrezzo3_JS = document.getElementById("atrezzo3");

atrezzo1_JS.addEventListener('click', function() {
    alert('Estas son opciones decorativas. Regístrate y loguéate para interactuar con la aplicación web.');
});
atrezzo2_JS.addEventListener('click', function() {
    alert('Estas son opciones decorativas. Regístrate y loguéate para interactuar con la aplicación web.');
});
atrezzo3_JS.addEventListener('click', function() {
    alert('Estas son opciones decorativas. Regístrate y loguéate para interactuar con la aplicación web.');
});


//---
