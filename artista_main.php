<?php 
include 'includes/funcion.php';
include 'Configuracion.php';

// Actualizar View
$database->update("Artista", ["View[+]" => 1], ["ArtistaID" => $_GET['id']]);


// ##############################################
$count = $database->count("Artista", [ "ArtistaID" => $_GET['id']]);
if ($count <= 0) {
// Obtener Datos Artista
$Get_Datos_Artista = file_get_contents('https://itunes.apple.com/lookup?id='.$_GET['id'], 0);
$Datos_Artista = json_decode($Get_Datos_Artista);
    $database->insert("Artista", [
     "ArtistaID" => $Datos_Artista->results[0]->artistId,
     "NombreArtista" => artista($Datos_Artista->results[0]->artistName),
     "Genero" => $Datos_Artista->results[0]->primaryGenreName,
     "GeneroID" => $Datos_Artista->results[0]->primaryGenreId
   ]);
}

$Datos_Artista = $database->select("Artista", "*", array( "ArtistaID"=> $_GET['id'],'LIMIT' => 1, ));

if (!isset($_GET['name'])) {
header("HTTP/1.0 301 Moved Permanently");
header("Location: ".$url_web.'/a/'.cano($Datos_Artista[0]['NombreArtista']).'/'.$Datos_Artista[0]['ArtistaID']);
header("Connection: close");
}

$ArtistaID = $Datos_Artista[0]['ArtistaID'];
$NombreArtista = $Datos_Artista[0]['NombreArtista'];
$Genero = $Datos_Artista[0]['Genero'];
$GeneroID = $Datos_Artista[0]['GeneroID'];
$View = $Datos_Artista[0]['View'];


// Obtener Cover
$g = cano($NombreArtista);
$g = str_replace('-', "+", $g);
$Get_Cover = cache_url('http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist='.$g.'&api_key='.$api_fm.'&format=json', 0);
// echo $Get_Cover;
$Data_Cover = json_decode($Get_Cover);
if (isset($Data_Cover->artist->image[4]->{'#text'})) {
$Cover_Artista = $Data_Cover->artist->image[4]->{'#text'};
}
else {
$Cover_Artista = '';
}
// Actualizar Datos
if ($Datos_Artista[0]['GeneroID'] == '' && $Datos_Artista[0]['CoverArtista'] == '') {
$Get_Datos_Artista = file_get_contents('https://itunes.apple.com/lookup?id='.$_GET['id'], 0);
$Datos_Artista = json_decode($Get_Datos_Artista);
$database->update("Artista", ["Genero" => $Datos_Artista->results[0]->primaryGenreName, "GeneroID"=> $Datos_Artista->results[0]->primaryGenreId], ["ArtistaID" => $_GET['id']]);
}
// ##############################################


$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noarchive">
  <title>Canciones de <?php echo strtoupper($NombreArtista); ?></title>
  <meta name="keywords" content="lyrics,music,song lyrics,songs,paroles">
  <meta name="description" content="Canciones de <?php echo $NombreArtista; ?>. Escucha las nuevas canciones de <?php echo $NombreArtista; ?> 2019 con letras e información. <?php echo $NombreArtista; ?> Lyrics.">  
  <meta property="og:title" content="<?php echo strtoupper($NombreArtista); ?> - Letras de canciones de <?php echo $NombreArtista; ?>" />
  <meta property="og:description" content="Canciones de <?php echo $NombreArtista; ?>. Escucha las nuevas canciones de <?php echo $NombreArtista; ?> 2019 con letras e información. <?php echo $NombreArtista; ?> Lyrics." />
  <meta property="og:image" content="<?php echo $Cover_Artista; ?>" />
  <meta property="og:url" content="<?php echo $actual_link; ?>" />
  <meta property="og:locale" content="es_ES" />
  <meta property="og:locale:alternate" content="en_US" />
  <meta property="og:site_name" content="<?php echo $Site_name; ?>" />
  <meta property="og:type" content="musician" />
  <meta name="name" content="<?php echo $Site_name; ?>">
  <link rel="apple-touch-icon" sizes="57x57" href="<?php echo $url_web; ?>/icon/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="<?php echo $url_web; ?>/icon/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo $url_web; ?>/icon/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $url_web; ?>/icon/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo $url_web; ?>/icon/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $url_web; ?>/icon/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="<?php echo $url_web; ?>/icon/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $url_web; ?>/icon/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $url_web; ?>/icon/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo $url_web; ?>/icon/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $url_web; ?>/icon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="<?php echo $url_web; ?>/icon/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $url_web; ?>/icon/favicon-16x16.png">
  <link rel="manifest" href="<?php echo $url_web; ?>/icon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?php echo $url_web; ?>/icon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $url_web; ?>/bsaz.css">
</head>
<body class="margin50">
  <style type="text/css">
  .headpageimage {
    padding: 0;
    text-align: center;
    float: inherit;
    padding-bottom: 10px;
  }
  .product-title {
    font-size: 22px;
    font-weight: 500;
    margin-bottom: 0;
    margin-top: 10px;
  }
  .headpageinfo {
   float: none; 
   max-width: 100%;
 }
</style>
<!-- header -->
<?php include 'header.php'; ?>
<!-- header -->
<div class="container main-page text-center">
  <div class="panel"> 
   <div class="panel-body">
    <div class="headpageimage cover_artista">
      <img src="<?php echo cache_image($Cover_Artista); ?>" width="200px" height="200px" alt="">
    </div>
    <div class="headpageinfo">
      <h1 class="product-title text-center"><span class="glyphicon glyphicon-user"></span> <?php echo $NombreArtista; ?></h1>
      <ul style="list-style:none;padding: 0px;">
        <!--           <li><b><span class="glyphicon glyphicon-ok"></span> Genero:</b> <a href="#" rel="nofollow"><?php echo $genero_artista; ?></a></li> -->
      </ul>
    </div>
    <div class="postmaintitle" style="margin-bottom: 20px;">
      <h2>Top Canciones <?php echo $NombreArtista; ?> <span class="glyphicon glyphicon-music"></span></h2>
    </div>
    <!-- Canciones -->
    <table class="table table-condensed"> 
      <?php 

      $sql  = "SELECT TituloCancion, Slug, NombreArtista, SongID FROM Json WHERE ArtistaID='".$_GET['id']."' ORDER BY View DESC;";
      $results = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);

      $count = 1;
      foreach ($results as $result) {
       ?>                                 
       <tr><td class="text-left visitedlyr">
        <?php echo $count++ ?>. <a href="<?php echo $url_web; ?>/m/<?php echo $result['Slug'] ?>/<?php echo $result['SongID'] ?>" target="_blank"><b><?php echo subtitulobusqueda($result['TituloCancion']) ?></b></a> by <b><?php echo $result['NombreArtista'] ?></b><br>
      </td></tr>
    <?php } ?>
  </table>
  <!-- Canciones -->
  <!-- Albunes -->

  <!-- Albunes -->
    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>