<?php
$nombre_archivo = 'Cache/Letras/'.base64_decode($_GET['name']).'.txt';  
unlink($nombre_archivo);
header('Location:'.base64_decode($_GET['url']));

// Hola


 ?>