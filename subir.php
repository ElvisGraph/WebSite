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
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
</head>
<body class="margin50">
  <!-- header -->
  <?php include 'header.php'; ?>
  <!-- top ban -->
 <!-- main -->
<div class="container main-page">
<div class="row">
<div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center" style="padding-top: 20px;">
<div class="panel"> 
<div class="panel-body">
<?php 

if (isset($_POST['add']) && $_POST['add'] !=='') {
  $term = $_POST['add'];
  $terms= explode("\r\n", $term);
  foreach ($terms as $term) {
  $search_url = str_replace(array('ft'), '', toAscii($term));
  $search_url = cano($_POST['artista'].' '.$search_url);

  $data_al = cache_url('https://itunes.apple.com/search?term='.$search_url.'&country=us&limit=1&entity=song', 1000000);
  $response_al = json_decode($data_al);

  # code...

if (!empty($response_al->results)) {
$count = $database->count("Json", [ "SongID" => $response_al->results[0]->trackId ]);
if ($count < 1) {
  if ($response->results[0]->artworkUrl30 !== '') {
  $data = cache_url('https://itunes.apple.com/lookup?id='.$response_al->results[0]->trackId.'&entity=song', 1000000);
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
}
else {
  echo "No Existe ".$search_url."</br>";
  }
}
else {
// echo "Ya Existe! ".$search_url."</br>";
}
}
else {
  echo "No Existe ".$search_url."</br>";
  }
}
  }

 ?>
<form class="search" method="post" action="<?php echo $url_web; ?>/subir.php">
    <select class="categoryName form-control" style="width:500px" name="artista"></select>
  <div class="form-group">
  <textarea class="form-control" name="add" rows="20"></textarea>
  </div>
  <button type="submit" id="submit" name="submit" value="Save Settings" class="btn btn-primary">Enviar</button>
</form> 
</div>
</div>
</div>
</div>
</div>
<script type="text/javascript">
      $('.categoryName').select2({
        placeholder: 'Selecciona una categoría',
        ajax: {
          url: 'ar.php',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results: data
            };
          },
          cache: true
        }
      });
</script>
<?php include 'footer.php'; ?>
</body>
</html>