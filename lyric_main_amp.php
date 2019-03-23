<?php
include 'Configuracion.php';
include 'includes/funcion.php';
// #########################################################################################################
// Actualizar View
$database->update("Json", ["View[+]" => 1], ["Slug" => $_GET['slug']]);
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
$Letras = $Get_Letra[0];

$Canonical = str_replace("/amp", "", $actual_link);

// ############################################################################################################
?>

<!doctype html>
<html amp lang="es">
<head>
  <meta charset="utf-8">
  <script async src="https://cdn.ampproject.org/v0.js"></script>
  <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
  <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
  <title>Descargar MP3 <?php echo titulo_seo_letra($TituloCancion, $NombreArtista); ?></title>
  <meta name="description" content="Entra AHORA ✅ ✅ ✅ Para Escuchar y Descargar <?php echo $TituloCancion.' '.$NombreArtista; ?>" />
  <link rel="canonical" href="<?php echo $Canonical; ?>">
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
  <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
  <style amp-custom>
  body {
    background-color: #EEEEEE;
  }
  .page {
    margin:   10px;
  }
  .container {
    width: 100%;
/*      padding-right: 15px;
padding-left: 15px;*/
margin-right: auto;
margin-left: auto;
}
.postmain {
  padding: 15px;
  margin-bottom: 20px;
  background-color: #fff;
  border-radius: 2px;
  overflow: hidden;
  margin-top: 10px;
}
.headpageimage {
  padding: 0px;
  text-align: center;
  float: inherit;
  padding-bottom: 10px;
}
body, h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4 {
  font-family: 'Roboto', 'Helvetica', 'Arial', sans-serif;
  font-weight: 300;
  text-decoration:  none;
}
.headpageinfo {
  float: inherit;
  /*    max-width: 480px;*/
  text-align: center;
}
.headpageinfo ul {
 list-style:none;padding: 0px;margin-bottom: 0px;text-transform: capitalize; 
}

.headpageinfo i {
  color: #ea4c20;
}
.product-title {
  font-size: 18px;
  font-weight: 500;
  margin-bottom: 0px;
  margin-top: 0px;
  text-align: center;
}
.product-stock a { 
  color: #f06c01; 
  font-weight: 700;
  text-decoration: none;
}
.product-stock {
  color: #777777;
  font-size: 15px;
  margin-top: 5px;
}
.postmaintitle {
  clear: both;
  margin-bottom: 25px;
  margin-top: 10px;
  border-bottom: 3px solid #D5D5D5;
  margin-bottom: 15px;
  text-align:   center;
}
.postmaintitle h3 {
  color: #212121;
  display: inline-block;
  border-bottom: 3px solid #F06C00;
  margin-top: 0px;
  margin-bottom: -3px;
  line-height: 22px;
  font-size: 20px;
  font-weight: 600;
  padding-bottom: 10px;
}
.postmaintitle h1 {
  color: #212121;
  display: inline-block;
  border-bottom: 3px solid #F06C00;
  margin-top: 0px;
  margin-bottom: -3px;
  line-height: 22px;
  font-size: 18px;
  font-weight: 600;
  padding-bottom: 10px;
}
.panel-body {
    padding: 15px;
}
.panel {
    border-radius: 2px;
    border: 0;
  }
  .media-list {
    padding-left: 0;
    list-style: none;
    margin: 0;
}
.media-left, .media-right, .media-body {
    display: block;
    width: 100%;
    margin-bottom: 10px;
    padding: 0px;
    text-align: center;
}
.media-heading {
    font-weight: 700;
    text-transform: uppercase;
}
.media-left .media-object {
    margin: 0px auto;
}
.media-heading {
    margin-top: 0;
    margin-bottom: 5px;
}
.well1 {
    min-height: 20px;
    padding: 19px;
    margin-bottom: 20px;
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.05);
    padding: 10px;
    margin-bottom: 0px;
    font-size:  13px;
}
.fa-calendar {
    margin-right: 5px;
}
.fa-clock-o {
    margin-right: 5px;
    margin-left: 5px;
}

.fa-eye {
    margin-right: 5px;
    margin-left: 5px;
}
.btn, .input-group-btn .btn {
    border: none;
    border-radius: 2px;
    position: relative;
    padding: 6px 30px;
    margin: 10px 1px;
    font-size: 14px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0;
    will-change: box-shadow, transform;
    outline: 0;
    cursor: pointer;
    text-decoration: none;
    background: transparent;
}
.btn-success {
    width: 100%;
    margin-bottom: 10px;
    color: #fff;
    background-color: #449d44;
    border-color: #398439;
    padding:  10px;
}
.btn-primary {
    margin: 0px;
    width: 100%;
    color: #fff;
    background-color: #286090;
    border-color: #204d74;
    padding:  10px;
}
.scrolltitle {
    position: relative;
    margin-bottom: 15px;
    font-weight: bold;
    border-bottom: 3px solid #D5D5D5;
}
.scrolltitle h4 {
    color: #212121;
    display: inline-block;
    border-bottom: 3px solid #F06C00;
    margin-bottom: -3px;
    line-height: 24px;
    font-size: 24px;
    font-weight: 700;
    padding-bottom: 10px;
}
.side-itemlist {
    list-style: none;
    margin: 0px;
    position: relative;
    padding: 0px;
}
.side-item {
    margin: 0px 0px 10px 0px;
    background: #ffffff;
    border-radius: 2px;
    overflow: hidden;
    -webkit-box-shadow: 0 0 6px rgba(0,0,0,0.27);
    -moz-box-shadow: 0 0 6px rgba(0,0,0,0.27);
    box-shadow: 0 0 6px rgba(0,0,0,0.27);
}
.side-thumb {
    display: inline-block;
    width: 80px;
    height: 80px;
    float: left;
    margin-right: 10px;
}
.side-item .info {
    margin-top: 8px;
    vertical-align: top;
    margin-left: 10px;
}
.side-item h3 {
    font-weight: 600;
}
.side-item h3 {
    position: relative;
    display: block;
    /* height: 16px; */
    margin: 0;
    font-weight: 600;
    font-size: 18px;
    /* line-height: 16px; */
    overflow: hidden;
    margin-bottom: 8px;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
}
.side-item h4 {
    position: relative;
    display: block;
    height: 18px;
    margin: 0;
    font-weight: 500;
    font-size: 15px;
    line-height: 16px;
    overflow: hidden;
    margin-bottom: 5px;
}
a {
    color: #212121;
    text-decoration: none;
}
footer {
    background: #333;
    padding-top: 15px;
    font-size: 12px;
    color: #DDD;
    margin-left: auto;
    margin-right: auto;
    width: 100%;
    height: 50px;
    clear: both;
}
.footcontent {
    max-width: 1140px;
    margin: 0 auto;
}
.pull-leftq {
    float: initial;
    text-align: center;
}
.pull-rightq {
    float: initial;
    text-align: center;
}
.footcontent a {
    color: #DDD;
}
.footsep {
    margin: 10px;
    border-left: 1px solid #4D515F;
}
.pull-leftq b {
    color: #F60;
}
.container-4 {
    overflow: hidden;
    max-width: 600px;
    vertical-align: middle;
    white-space: nowrap;
    text-align: center;
    margin: auto;
    width: 100%;
    margin-top: 10px;
}

.container-4 input#search {
    width: 100%;
    height: 50px;
    background: #333333;
    border: none;
    font-size: 10pt;
    float: left;
    color: #fff;
    padding-left: 15px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    font-weight: 500;
}
.container-4 input#search::-webkit-input-placeholder {
   color: #65737e;
}
 
.container-4 input#search:-moz-placeholder { /* Firefox 18- */
   color: #65737e;  
}
 
.container-4 input#search::-moz-placeholder {  /* Firefox 19+ */
   color: #65737e;  
}
 
.container-4 input#search:-ms-input-placeholder {  
   color: #65737e;  
}
.container-4 button.icon {
    -webkit-border-top-right-radius: 5px;
    -webkit-border-bottom-right-radius: 5px;
    -moz-border-radius-topright: 5px;
    -moz-border-radius-bottomright: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    margin-left: -50px;
    border: none;
    background: #ef6743;
    height: 50px;
    width: 50px;
    color: #eeeeee;
    opacity: 1;
    font-size: 10pt;
}
.navbar, .navbar.navbar-default {
    background-color: #ef6844;
    color: #ffffff;
    -moz-box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.container-2 {
    padding-right: 15px;
    padding-left: 15px;
    margin-right: auto;
    margin-left: auto;
}
.navbar .navbar-brand {
    /* height: 60px; */
    padding: 7px 0px 7px 0px;
    text-align: center;
}
.letra {
  text-align: center;
  text-transform: capitalize;
}

</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
</head>
<body>
  <div class="page">  
    <div class="navbar navbar-default" role="navigation">
  <div class="container-2">
    <div class="navbar-header">
      <div class="navbar-brand">
      <a href="<?php echo $url_web ?>"><amp-img width="145px" height="40px" src="<?php echo $url_web ?>/imagenes/logo-full.png" alt="<?php echo $Site_name ?>" title="Inicio"></a>
      </div>
    </div>
</div>
</div>
 <div class="container">
  <div class="box">
  <div class="container-4">
    <form action="<?php echo $url_web ?>/buscar.php" target="_top">
    <input required="" name="q" type="search" id="search" placeholder="Artista, Titulo O URL de Youtube" />
    <button class="icon"><i class="fa fa-search"></i></button>
    </form>
  </div>
</div>
   <div class="postmain">
    <div class="postmaintitle" style="margin-bottom: 15px;">
<h1><?php echo $NombreArtista.' - '.$TituloCancion ?></h1>
</div>
     <div class="headpageimage">
      <amp-img src="<?php echo cache_image($Cover); ?>" width="200px" height="200px" alt="Ariana Grande - break up with your girlfriend, i'm bored">
      </div>
      <div class="headpageinfo">
        <h1 class="product-title">
          <?php echo $TituloCancion; ?> <i class="fa fa-music"></i>
        </h1>
          <h2 class="product-stock"><i class="fa fa-user"></i> <?php echo $NombreArtista; ?></h2><ul>
            <li><b><i class="fa fa-circle"></i> Genero:</b> <?php echo $Genero; ?></li>
            <li><b><i class="fa fa-circle"></i> Release Date:</b> <?php echo substr($Fecha, 0,10); ?></li>
            <li><b><i class="fa fa-circle"></i> View:</b> <?php echo $View; ?></li>
          </ul>

        </div>
         <div class="postmaintitle"> </div>
         <?php include 'includes/Get_Video_AMP.php';  ?>
        <div class="postmaintitle">
          <h3>Letra de <?php echo titulo_seo_letra($TituloCancion, $NombreArtista); ?> <i class="fa fa-music"></i></h3>
        </div>
         <div class="letra">
           <?php echo $Letras; ?>
         </div>
          <div class="scrolltitle">
        <h4>Mas Canciones <i style="color: #f06c01;" class="fa fa-play-circle"></i></h4>
        </div>
  <ul class="side-itemlist">
<?php 
$sql  = "SELECT TituloCancion, Slug, NombreArtista, NombreCompleto, CoverMiniatura FROM Json WHERE ArtistaID='".$ArtistaID."' ORDER BY Fecha DESC LIMIT 15;";
$results = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);
foreach ($results as $result) {
 ?>
<a title="<?php echo $result['NombreArtista'].' '.$result['TituloCancion']; ?>" href="<?php echo $url_web.'/m/'.$result['Slug'].'/'.$result['SongID'] ?>"><li class="side-item"><div class="side-thumb"><amp-img alt="<?php echo $result['NombreArtista'].' '.$result['TituloCancion']; ?>" src="<?php echo $result['CoverMiniatura']; ?>"width="80px" height="80px" ></div>
  <div class="info"><h3><?php echo Sub_Titulo($result['TituloCancion']) ?></h3>
    <h4><?php echo $result['NombreArtista']; ?></h4>
    </div>
  </li></a>
<?php } ?>
</ul>

      </div>
<footer>
<div class="footcontent">
<div class="pull-leftq">
Copyright &copy; 2019 <b>MP3K5.com</b>.
</div>
<div class="pull-rightq">
<b>
<a href="<?php echo $url_web ?>">Inicio</a><span class="footsep"></span><a href="<?php echo $url_web ?>/privacy.html" rel="nofollow">Política de Privacidad</a><span class="footsep"></span><a href="<?php echo $url_web ?>/copyright.html" rel="nofollow">DMCA</a><span class="footsep"></span><a href="<?php echo $url_web ?>/contacto.html" rel="nofollow">Contacto</a>
</b>
</div>
</div>
</div>
</footer>
<amp-analytics type="googleanalytics">
<script type="application/json">
{
  "vars": {
    "account": "UA-111324369-1"
  },
  "triggers": {
    "trackPageview": {
      "on": "visible",
      "request": "pageview"
    }
  }
}
</script>
</amp-analytics>
    </div>
  </body>
  </html>