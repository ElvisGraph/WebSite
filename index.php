<?php
include 'includes/funcion.php';
include 'Configuracion.php';
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noarchive">
  <meta name="name" content="<?php echo $site_name; ?>">
  <meta name="keywords" content="lyrics,music,song lyrics,songs,paroles">  
    <title><?php echo $Site_name; ?></title>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="<?php echo $url_web; ?>/bsaz.css">
</head>
<body class="margin50">
  <!-- header -->
  <?php include 'header.php'; ?>
  <!-- top ban -->

 <!-- main -->
 <div class="container main-page animated rotateIn faster">
<div class="row">
 <div class="col-xs-12 col-lg-8 col-lg-offset-2 text-center artist-col">
  <h1>ESTRENOS!</h1>
</div>
</div>
<div class="row">
    <?php 
  $Song_Nuevas = $database->query('SELECT * FROM Json ORDER BY ID DESC LIMIT 39')->fetchAll(PDO::FETCH_ASSOC);
  foreach ($Song_Nuevas as $Song_Nueva) {
  ?>
    <a href="<?php echo $url_web.'/m/'.$Song_Nueva['Slug'].'/'.$Song_Nueva['SongID']?>"><div class="col-xs-12 col-sm-6 col-md-4 nueva-cancion">
      <div class="cuadro"><span class="cover-cancion clearfix"><img width="80" height="80" src="<?php echo $url_web;?>/image/loading.svg" data-src="<?php echo $Song_Nueva['CoverMiniatura']; ?>"></span><div class="datos-cancion"> <span class="titulo-cancion"> <?php echo $Song_Nueva['TituloCancion']; ?></span><p> <span class="artista"><i class="fa fa-user"></i> <?php echo $Song_Nueva['NombreArtista']; ?></span></p><p></p></div><div class="clear clearfix"></div></div>
    </div></a>
  <?php } ?>
</div>
</div>
</div>
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
