<?php
include 'includes/funcion.php';
include 'Configuracion.php';
// include 'includes/nocsfr.php';
if (isset($_SESSION['login']) && $_SESSION['login'] === false) { 
echo '<h1>Acceso Denegado!</h1>';
echo '<meta http-equiv="refresh" content="1;url='.$config_url.'" />  </div>';
exit();
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noarchive">
  <meta name="name" content="AZLyrics">
  <meta name="keywords" content="lyrics,music,song lyrics,songs,paroles">  
  <title>Editor</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $url_web; ?>/bsaz.css">
  <script src="<?php echo $url_web; ?>/js/clipboard.min.js"></script>
</head>
<body class="margin50">
  <!-- header -->
  <?php include 'header.php'; ?>
  <!-- top ban -->
 <!-- main -->
 <?php  
$valueq = '';
if (isset($_GET['q'])) {
$valueq = $_GET['q'];
}

  ?>
 <div class="container main-page">
<div class="row">
<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center" style="padding-top: 20px;">
<div class="panel"> 
<div class="panel-body">
<form class="search" method="get" action="<?php echo $url_web; ?>/Editar_User.php">
<div style="margin-bottom:15px" class="input-group">
<input type="text" class="form-control" placeholder="" name="q" required="" value="<?php echo $valueq; ?>">
<span class="input-group-btn">
<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
</span>
</div>
</form> 
<?php 
if (isset($_GET['q'])) { 
  $search_url = str_replace(array('ft'), '', $_GET['q']);
  $search_url = cano($search_url);
  $data_al = cache_url('https://itunes.apple.com/search?term='.$search_url.'&country=co&limit=50&entity=album', 10);
  // echo $data_al;
  $response_al = json_decode($data_al);
  echo '<table class="table table-condensed">';
  foreach (array_slice($response_al->results, 0, 200) as $result_al) {
        echo '<a href="?album='.$result_al->collectionId.'&title='.$result_al->collectionName.'"><div class="col-xs-12 col-sm-6 col-md-4 nueva-cancion">
    <div class="cuadro"><span class="cover-cancion clearfix"><img width="80" height="80" src="'.$result_al->artworkUrl100.'" ></span><div class="datos-cancion"> <span class="titulo-cancion"> '.$result_al->collectionName.'</span><p> <span class="artista"><i class="fa fa-user"></i> '.$result_al->artistName.'</span></p></div><div class="clear clearfix"></div></div>
    </div></a>';

 }
 echo '</table>';
} 
else {
 if (!isset($_GET['id']) && !isset($_GET['album'])) {
  $string = cache_url('https://rss.itunes.apple.com/api/v1/co/apple-music/hot-tracks/all/102/explicit.json', 86400);
  $json = json_decode($string);
  $numero = 1;
  foreach (array_slice($json->feed->results, 0,102) as $item) {
    $sslimage = preg_replace('~http://(.*?).mzstatic~', "https://$1-ssl.mzstatic", $item->artworkUrl100);
    $bigimage = preg_replace('/200x200/ms', "180x180", $sslimage);

    echo '<a href="?id='.$item->id.'"><div class="col-xs-12 col-sm-6 col-md-4 nueva-cancion">
    <div class="cuadro"><span class="cover-cancion clearfix"><img width="80" height="80" src="'.$bigimage.'" ></span><div class="datos-cancion"> <span class="titulo-cancion"> '.$item->name.'</span><p> <span class="artista"><i class="fa fa-user"></i> '.$item->artistName.'</span></p></div><div class="clear clearfix"></div></div>
    </div></a>';
  }
}
}
if (isset($_GET['id'])) {
$count = $database->count("Json", [ "SongID" => $_GET['id'] ]);
if ($count < 1) {
  $data = cache_url1('https://itunes.apple.com/lookup?id='.$_GET['id'].'&entity=song', 000);
  // echo $data;
  $response = json_decode($data);
 // Cachear Cover
  $Cover = str_replace('30x30bb', "200x200bb", $response->results[0]->artworkUrl30);
  $CoverMiniatura = str_replace('30x30bb', "80x80bb", $response->results[0]->artworkUrl30);
  $database->insert("Json", [
   "ArtistaID" => $response->results[0]->artistId,
   "SongID" => $response->results[0]->trackId,
   "NombreArtista" => $response->results[0]->artistName,
   "ArtistaPrincipal" => artista($response->results[0]->artistName),
   "TituloCancion" => $response->results[0]->trackCensoredName,
   "Cover" => $Cover,
   "Fecha" => $response->results[0]->releaseDate,
   "Album" => $response->results[0]->collectionId,
   "Slug" => Slug_Title(artista($response->results[0]->artistName), subtitulobusqueda($response->results[0]->trackCensoredName)),
   "NombreCompleto" => $response->results[0]->artistName.' '.$response->results[0]->trackCensoredName,
   "Genero" => $response->results[0]->primaryGenreName,
   "CoverMiniatura" => $CoverMiniatura
 ]);

  $count_artist = $database->count("Artista", [ "ArtistaID" => $response->results[0]->artistId]);
  if ($count_artist < 1) {
    $database->insert("Artista", [
     "ArtistaID" => $response->results[0]->artistId,
     "NombreArtista" => artista($response->results[0]->artistName),
     "Genero" => $response->results[0]->primaryGenreName,
   ]);
  }
echo "Guardada!";
}
else {
echo "Ya Existe!";
}
}

if (isset($_GET['album'])) {

$data = file_get_contents('https://itunes.apple.com/lookup?id='.$_GET['album'].'&entity=song&country=co');
$response = json_decode($data);

if ($response->resultCount == '0') {
$data = file_get_contents('https://itunes.apple.com/lookup?id='.$_GET['album'].'&entity=song');
$response = json_decode($data);
}

if ($response->results[0]->trackCount > 2) {
  $count_artist = $database->count("Albunes", [ "AlbumID" => $response->results[0]->collectionId]);
  if ($count_artist < 1) {
    $database->insert("Albunes", [
     "Artista" => $response->results[0]->artistName,
     "Titulo" => $response->results[0]->collectionName,
     "Genero" => $response->results[0]->primaryGenreName,
     "Cover" => $response->results[0]->artworkUrl100,
     "Fecha" => $response->results[0]->releaseDate,
     "AlbumID" => $response->results[0]->collectionId,
     "ArtistaID" => $response->results[0]->artistId,
   ]);
  }
}


  $count_artist = $database->count("Artista", [ "ArtistaID" => $response->results[0]->artistId]);
  if ($count_artist < 1) {
    $database->insert("Artista", [
     "ArtistaID" => $response->results[0]->artistId,
     "NombreArtista" => artista($response->results[0]->artistName),
     "Genero" => $response->results[0]->primaryGenreName,
   ]);
  }

foreach (array_slice($response->results, 1, 200) as $a ) {
  $count = $database->count("Json", [ "SongID" => $a->trackId ]);
  if ($count < 1) {
  $Cover = str_replace('30x30bb', "200x200bb", $a->artworkUrl30);
  $CoverMiniatura = str_replace('30x30bb', "80x80bb", $a->artworkUrl30);
  $database->insert("Json", [
   "ArtistaID" => $a->artistId,
   "SongID" => $a->trackId,
   "NombreArtista" => $a->artistName,
   "ArtistaPrincipal" => artista($a->artistName),
   "TituloCancion" => $a->trackCensoredName,
   "Cover" => $Cover,
   "Fecha" => $a->releaseDate,
   "Album" => $a->collectionId,
   "Slug" => Slug_Title(artista($a->artistName), subtitulobusqueda($a->trackCensoredName)),
   "NombreCompleto" => $a->artistName.' '.$a->trackCensoredName,
   "Genero" => $a->primaryGenreName,
   "CoverMiniatura" => $CoverMiniatura
 ]);
}
else {
echo $a->trackCensoredName.' '.$a->artistName." Ya Existe!</br> ";
} 
}

}
?>
</div>
</div>
</div>
</div>
</div>

</body>
</html>