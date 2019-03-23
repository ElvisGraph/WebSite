<?php 
include 'Configuracion.php';
include 'includes/funcion.php';

$data = cache_url('https://itunes.apple.com/lookup?id='.$_GET['id'].'&entity=song');
$response = json_decode($data);

header("HTTP/1.0 301 Moved Permanently");
header("Location: ".$url_web.'/m/'.Slug_Title(artista($response->results[0]->artistName), subtitulobusqueda($response->results[0]->trackCensoredName)).'/'.$response->results[0]->trackId);
header("Connection: close");
exit(); 
 ?>