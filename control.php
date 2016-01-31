<? 
//vemos si el usuario y contraseña es váildo 
include('config.php');
include('model/tareas.php');
$usuario=$_POST["usuario"];
$contrasena=$_POST["contrasena"];

if (ValidaUsuario($usuario,$contrasena)){ 
   	//usuario y contraseña válidos 
   	//defino una sesion y guardo datos 
   	session_start(); 
    $_SESSION["autentificado"]= "SI"; 
   header('Location: ctrl/inicio.php');
}else { 
   	//si no existe le mando otra vez a la portada 
   header('Location: login_form.php?errorusuario=si');
} 
?>