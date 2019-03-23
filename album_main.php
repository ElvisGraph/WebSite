<?php
include 'Configuracion.php';
include 'includes/funcion.php';

// #########################################################################################################
$Datos_Album = $database->select("Albunes", "*", array( "AlbumID"=> $_GET['id'],'LIMIT' => 1, ));

$ArtistaID = $Datos_Album[0]['ArtistaID'];
$NombreArtista = $Datos_Album[0]['Artista'];
$TituloAlbum = $Datos_Album[0]['Titulo'];
$Genero = $Datos_Album[0]['Genero'];
$View = $Datos_Album[0]['View'];
$Fecha = $Datos_Album[0]['Fecha'];
$Cover = $Datos_Album[0]['Cover'];
$Cover = str_replace("100x100", "200x200", $Cover);

// ############################################################################################################
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noarchive">
  <title>Album <?php echo titulo_seo_letra($TituloAlbum, $NombreArtista); ?></title>
  <meta name="name" content="<?php echo $Site_name; ?>">
  <meta name="keywords" content="lyrics,music,song lyrics,songs,paroles"> 
  <link rel="canonical" href="<?php echo $actual_link; ?>" />
  <meta name="description" content="Letras de  <?php echo $NombreArtista.' - '.$TituloAlbum ?>"> 
  <meta property="og:title" content="Letra Letra <?php echo titulo_seo_letra($TituloAlbum, $NombreArtista); ?>" />
  <meta property="og:description" content="Letra de <?php echo $NombreArtista.' - '.$TituloAlbum ?>" />
  <meta property="og:image" content="<?php echo $Cover; ?>" />
  <meta property="og:url" content="<?php echo $actual_link; ?>" />
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
  <link rel="manifest" href="<?php echo $url_web; ?>/icon/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?php echo $url_web; ?>/icon/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $url_web; ?>/bsaz.css">
</head>
<body class="margin50">
  <!-- header -->
  <?php include 'header.php'; ?>

      <form id="corlyr" action="<?php echo $url_web; ?>/Editar_User.php" method="post">
        <input type="hidden" name="song_id" value="<?php echo $SongID; ?>">
      </form>

  <div class="container">
    <div class="col-md-8" style="margin-top: 10px;padding-left:0px;">
          <ol class="breadcrumb noprint" itemscope="" itemtype="https://schema.org/BreadcrumbList">
      <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo $url_web; ?>"><span itemprop="name"><?php echo $Site_name; ?></span></a></li>
      <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo $url_web; ?>/a/<?php echo cano(artista($NombreArtista)).'/'.$ArtistaID ?>"><span itemprop="name"><?php echo artista($NombreArtista); ?></span></a></li>
      <li itemprop="itemListElement" itemscope="" itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo titulo($TituloAlbum); ?> Letra</span></li>
    </ol>
      <div class="postmain">
        <div class="postmaintitle" style="margin-bottom: 15px;">
          <h1><?php echo cocheteporparentesis(str_replace("feat.", "Ft.", $NombreArtista.' - '.$TituloAlbum)) ?></h1>
        </div>
        <div class="headpageimage">
          <img src="<?php echo $Cover; ?>" width="200px" height="200px" alt="Pedro Capó &amp; Farruko - Calma Remix" style="display: inline;">
        </div>
        <div class="headpageinfo">
          <h2 class="product-title" style="margin-top: 10px;"><?php echo Sub_Titulo($TituloAlbum) ?></h2>
          <div class="product-stock"> <?php echo $NombreArtista ?></div>
          <ul style="list-style:none;padding: 0px;margin-top: 5px;text-transform: capitalize;">
            <li><b> Genero:</b> <?php echo $Genero; ?> </li>
            <li><b> Release Date:</b> <?php echo substr($Fecha, 0,10); ?></li>
            <br>
            <li style="color: #777777;"></li>
          </ul>
        </div>
        <div class="postmaintitle" style=" margin-bottom: 0px; "></div>
<!-- Music -->
    <table class="table table-condensed"> 
      <?php 

      $sql  = "SELECT TituloCancion, Slug, NombreArtista, SongID FROM Json WHERE Album='".$_GET['id']."' ORDER BY View DESC;";
      $results = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);

      $count = 1;
      foreach ($results as $result) {
       ?>                                 
       <tr><td class="text-left visitedlyr">
        <?php echo $count++ ?>. <a href="<?php echo $url_web; ?>/m/<?php echo $result['Slug'] ?>/<?php echo $result['SongID'] ?>" target="_blank"><b>Letra <?php echo subtitulobusqueda($result['TituloCancion']) ?></b></a> by <b><?php echo $result['NombreArtista'] ?></b><br>
      </td></tr>
    <?php } ?>
  </table>
  <!-- Music -->
      </div>
    </div>
    <div class="col-md-4">
      <div class="scrolltitle">
<h4>Mas Canciones <i style="color: #f06c01;" class="fa fa-play-circle"></i></h4>
</div>
<ul class="side-itemlist">
<?php 
$sql  = "SELECT TituloCancion, Slug, NombreArtista, NombreCompleto, CoverMiniatura FROM Json WHERE ArtistaID='".$ArtistaID."' ORDER BY Fecha DESC LIMIT 15;";
$results = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $result) {

 ?>
<li class="side-item"><div class="side-thumb"><img alt="<?php echo $result['CoverMiniatura']; ?>" src="<?php echo $result['CoverMiniatura']; ?>" style="display: inline;"></div>
<div class="info"><h3><a title="<?php echo Sub_Titulo($result['TituloCancion']) ?>" href="<?php echo $url_web.'/letra-'.$result['Slug'] ?>"><?php echo Sub_Titulo($result['TituloCancion']) ?></a></h3>
<h4><a title="<?php echo $result['NombreArtista']; ?>" href="<?php echo $url_web.'/letra-'.$result['Slug'] ?>"><?php echo $result['NombreArtista']; ?></a></h4>
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
<?php include 'footer.php'; ?>
</body>
</html>