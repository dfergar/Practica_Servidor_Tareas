<html> 
<head> 
<title>Autentificación aplicación Primavera</title> 
</head> 
<body> 
<h1>Autentificación aplicación Primavera</h1> 
<form action="control.php" method="POST"> 
<table align="center" width="225" cellspacing="2" cellpadding="2" border="0"> 
<tr> 
<td colspan="2" align="center" 
<?if ($_GET["errorusuario"]=="si"){?> 
bgcolor=red><span style="color:ffffff"><b>Datos incorrectos</b></span> 
<?}else{?> 
bgcolor=#cccccc>Introduce tu clave de acceso 
<?}?></td> 
</tr> 
<tr> 
<td align="right">USUARIO:</td> 
<td><input type="Text" name="usuario" size="8" maxlength="50"></td> 
</tr> 
<tr> 
<td align="right">PASSWORD:</td> 
<td><input type="password" name="contrasena" size="8" maxlength="50"></td> 
</tr> 
<tr> 
<td colspan="2" align="center"><input type="Submit" value="ENTRAR"></td> 
</tr> 
</table> 
</form> 
</body> 
</html>