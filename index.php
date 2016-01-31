<?php
/* 
 * Fichero que llama al controlador 'inicio.php' 
 * usando una redirección
 * 
 * Se envía una cabecera para que cargue otra página. Hay que hacerlo así
 * pues en otro caso tendríamos problemas para crear los enlaces URL de las
 * diferentes páginas
 */

//header('Location: ctrl/inicio.php');


header('Location: login_form.php?errorusuario=no');

/*
 if (isset($_POST))
 {

 include('model/tareas.php');
 $usuario=$_POST["usuario"];
 $contrasena=$_POST["contrasena"];
 if(ValidaUsuario($usuario,$contrasena))
 {
 session_start();
 header('Location: ctrl/inicio.php');
 }
 else
 {
 header("Location: index.php");
 }
 }
 else
 {
 ?>
 <form action="#" method="POST">
 Usuario<input type="text" name="usuario">
 <br>
 Password<input type="password" name="contrasena">
 </form>
 <?php
 }
 ?>*/

