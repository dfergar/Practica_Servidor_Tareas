<?php
/**
 * Daniel Fernández García
 * 12/12/2015
 * V: 1.0
 * Controlador para visualizar UNA tarea
 */
include 'constantes.php';

include(MODEL_PATH.'tareas.php');
//Captura del parámetro GET
$codigo = $_REQUEST['id'];
$tareas=array();
//Obtener tareas del modelo
$tareas=VerTareas($codigo);
//Mostramos la vista de la tarea
include(VIEW_PATH.'VerTareasForm.php');



