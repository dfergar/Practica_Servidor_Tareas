<?php
/* 
 * Fichero que llama al controlador 'inicio.php' 
 * usando una redirección
 * 
 * Se envía una cabecera para que cargue otra página. Hay que hacerlo así
 * pues en otro caso tendríamos problemas para crear los enlaces URL de las
 * diferentes páginas
 */

header('Location: ctrl/inicio.php');

