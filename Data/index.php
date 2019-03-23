 <?php 
 include '../Configuracion.php';
 include '../includes/funcion.php';
  include '../includes/funcion.php';

  $string = cache_url('https://rss.itunes.apple.com/api/v1/'.$pais.'/apple-music/hot-tracks/all/12/explicit.json', 86400);
  $json = json_decode($string);
  foreach (array_slice($json->feed->results, 0,12) as $item) {
    $sslimage = preg_replace('~http://(.*?).mzstatic~', "https://$1-ssl.mzstatic", $item->artworkUrl100);
    $bigimage = preg_replace('/200x200/ms', "180x180", $sslimage); ?>
    
  <?php } ?>