<?php
include 'Configuracion.php';
include 'includes/funcion.php';

// ######################################################################################################### 


$count = $database->count("Json", [ "Slug" => $_GET['slug'] ]);
if ($count < 1) {
header("HTTP/1.0 301 Moved Permanently");
header("Location: ".$url_web);
header("Connection: close");
}

// #########################################################################################################
// Actualizar View

$database->update("Json", ["View[+]" => 1], ["Slug" => $_GET['slug']]);

$Song_Datos = $database->select("Json", "*", array( "Slug"=> $_GET['slug'],'LIMIT' => 1, ));

if ($Song_Datos[0]['SongID'] !== $_GET['id']) {
header("HTTP/1.0 301 Moved Permanently");
header("Location: ".$url_web.'/m/'.$Song_Datos[0]['Slug'].'/'.$Song_Datos[0]['SongID']);
header("Connection: close");
}

// if (count($Song_Datos) < 1 ) {header("Location:".$url_web.'/buscar.php?q='.str_replace("-", "+", $_GET['slug'])); exit();}

$data_letras = $Song_Datos[0]['Letra'];

$SongID = $Song_Datos[0]['SongID'];
$ArtistaID = $Song_Datos[0]['ArtistaID'];
$NombreArtista = $Song_Datos[0]['NombreArtista'];
$TituloCancion = $Song_Datos[0]['TituloCancion'];
$Cover = $Song_Datos[0]['Cover'];
// Cover Miniatura
if(!empty($Song_Datos[0]['CoverMiniatura'])) {
$CoverMiniatura = $Song_Datos[0]['CoverMiniatura'];
} else {
$data = cache_url('https://itunes.apple.com/lookup?id='.$SongID.'&entity=song');
$response = json_decode($data);
$CoverMiniatura = str_replace('30x30bb', "80x80bb", $response->results[0]->artworkUrl30);
$database->update("Json", ["CoverMiniatura" => cache_image($CoverMiniatura)], ["Slug" => $_GET['slug']]);
$CoverMiniatura = $url_web.'/imagenes/persona-default.png';
}
// Genero
if(!empty($Song_Datos[0]['Genero'])) {
$Genero = $Song_Datos[0]['Genero'];
} else {
$data = cache_url('https://itunes.apple.com/lookup?id='.$SongID.'&entity=song');
$response = json_decode($data);
$database->update("Json", ["Genero" => $response->results[0]->primaryGenreName], ["Slug" => $_GET['slug']]);
$Genero = 'Desconocido';
}
$Fecha = $Song_Datos[0]['Fecha'];
$View = $Song_Datos[0]['View'];

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


// Verificar Si La Letra Esta En La Base De Datos
if (empty($Song_Datos[0]['Letra'])) {
  // Configuracion Letra #
  include 'ajax.php';
  $database->update("Json", ["Letra" => $data_letras], ["Slug" => $_GET['slug']]);
}
$Get_Letra = $database->select("Json", "Letra", array( "Slug"=> $_GET['slug'],'LIMIT' => 1, ));
$data_letras = $Get_Letra[0];

// #############################################################################################################
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noarchive">
  <title>Descargar MP3: <?php echo titulo_seo_letra($TituloCancion, $NombreArtista); ?></title>
  <meta name="name" content="<?php echo $Site_name; ?>">
  <link rel="canonical" href="<?php echo $actual_link; ?>" />
  <meta name="description" content="Entra AHORA ✅ ✅ ✅ Para Escuchar y Descargar <?php echo $TituloCancion.' '.$NombreArtista; ?>"> 
  <meta property="og:title" content="<?php echo titulo_seo_letra($TituloCancion, $NombreArtista); ?>" />
  <meta property="og:description" content="Entra AHORA ✅ ✅ ✅ Para Escuchar y Descargar <?php echo $TituloCancion.' '.$NombreArtista; ?>" />
  <meta property="og:image" content="<?php echo $Cover; ?>" />
  <meta property="og:url" content="<?php echo $actual_link; ?>" />
  <link rel="amphtml" href="<?php echo $actual_link; ?>/amp" />
  <meta property="og:locale" content="es_ES" />
  <meta property="og:locale:alternate" content="en_US" />
  <meta property="og:site_name" content="<?php echo $Site_name; ?>" />
  <meta property="og:type" content="music.song" />
  <meta property="music:musician" content="<?php echo $url_web; ?>/a/<?php echo cano(artista($NombreArtista)).'/'.$ArtistaID ?>">
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
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?php echo $url_web; ?>/icon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="<?php echo $url_web; ?>/bsaz.css">
</head>
<body class="margin50">
  <!-- header -->
  <?php include 'header.php'; ?>

      <form id="corlyr" action="<?php echo $url_web; ?>/Editar_User.php" method="post">
        <input type="hidden" name="song_id" value="<?php echo $SongID; ?>">
      </form>

  <div class="container animated rotateIn fast">
    <div class="col-md-8" style="margin-top: 10px;padding-left:0px;">
          <ol class="breadcrumb noprint" itemscope="" itemtype="https://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo $url_web; ?>"><span itemprop="name"><?php echo $Site_name; ?></span></a></li>
      <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a  rel="nofollow" itemprop="item" href="<?php echo $url_web; ?>/a/<?php echo cano(artista($NombreArtista)).'/'.$ArtistaID ?>"><span itemprop="name"><?php echo artista($NombreArtista); ?></span></a></li>
      <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo titulo($TituloCancion); ?> Letra</span></li>
    </ol>
      <div class="postmain">
        <div class="postmaintitle" style="margin-bottom: 15px;">
          <h1><?php echo cocheteporparentesis(str_replace("feat.", "Ft.", $NombreArtista.' - '.$TituloCancion)) ?></h1>
        </div>
        <div class="headpageimage">
          <img src="<?php echo cache_image($Cover); ?>" width="200px" height="200px" alt="Pedro Capó &amp; Farruko - Calma Remix" style="display: inline;">
        </div>
        <div class="headpageinfo">
          <h2 class="product-title" style="margin-top: 10px;"><?php echo Sub_Titulo($TituloCancion) ?></h2>
          <div class="product-stock"> <?php echo $NombreArtista ?></div>
          <ul style="list-style:none;padding: 0px;margin-top: 5px;text-transform: capitalize;">
            <li><b> Genero:</b> <?php echo $Genero; ?> </li>
            <li><b> Release Date:</b> <?php echo substr($Fecha, 0,10); ?></li>
            <li><b> View:</b> <?php echo $View; ?></li>
            <br>
            <li style="color: #777777;"></li>
          </ul>
        </div>
        <div class="postmaintitle" style=" margin-bottom: 0px; "></div>

    <?php 
    include 'includes/Get_Video.php'; 
    ?>
    <div class="postmaintitle" style=" margin-bottom: 0px; "><h2>Letra <?php echo cocheteporparentesis(str_replace("feat.", "Ft.", $NombreArtista.' - '.$TituloCancion)) ?></h2></div>
     <div class="letras" id="<?php echo $SongID ?>">
      <?php
      if (strlen($data_letras) > 200) {
        echo "<br>";
        echo $data_letras;
        echo "<br>";
        echo "<br>";
         if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        // echo '<a class="btn btn-share" href="#" onclick="submitCorrections()" rel="nofollow" rel="nofollow"><span class="glyphicon glyphicon-pencil"></span> Editar o Corregir</a>';
      } }
      else {
        echo "<br>";
        echo '<div class="alert alert-warning" role="alert">';
        echo "Las letras de esta canción aún no se han lanzado. Por favor, vuelva pronto y estara disponible.";
        echo '</div>';
        // echo '<a class="btn btn-share" href="#" onclick="submitCorrections()" rel="nofollow"><span class="glyphicon glyphicon-pencil"></span> Ayudanos Con Esta Letra</a>';

      }
      ?>
    </div>

      </div>
    </div>
    <div class="col-md-4">
<div class="scrolltitle">
<h4>Mas Canciones <i style="color: #f06c01;" class="fa fa-play-circle"></i></h4>
</div>
<ul class="side-itemlist">
<?php 
$sql  = "SELECT TituloCancion, Slug, NombreArtista, NombreCompleto, CoverMiniatura, SongID FROM Json WHERE ArtistaID='".$ArtistaID."' ORDER BY Fecha DESC LIMIT 15;";
$results = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $result) {
 ?>
<a title="<?php echo Sub_Titulo($result['TituloCancion']) ?>" href="<?php echo $url_web.'/m/'.$result['Slug'].'/'.$result['SongID'] ?>"><li class="side-item"><div class="side-thumb"><img alt="<?php echo $result['CoverMiniatura']; ?>" src="<?php echo $url_web;?>/image/loading.svg" data-src="<?php echo $result['CoverMiniatura']; ?>" style="display: inline;"></div>
<div class="info"><h3><?php echo Sub_Titulo($result['TituloCancion']) ?></h3>
<h4><?php echo $result['NombreArtista']; ?></h4></a>
</div>
<?php } ?>
</ul>
    </div>
<div class="smt"></div>
</div>
</div>
<script type="text/javascript">
  function submitCorrections(){
    document.getElementById('corlyr').submit();
    return false;
  }
</script>
  <script src="https://www.youtube.com/iframe_api"></script>
  <script src="https://cdn.rawgit.com/labnol/files/master/yt.js"></script>
<?php include 'footer.php'; ?>
<script>
      //lazy loading
      $('.container img').imgLazyLoad({
        // jquery selector or JS object
        container: window,
        // jQuery animations: fadeIn, show, slideDown
        effect: 'fadeIn',
        // animation speed
        speed: 600,
        // animation delay
        delay: 400,
        // callback function
        callback: function(){}
      });
</script>
</body>
</html>