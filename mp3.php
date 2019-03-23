
<?php
include 'includes/funcion.php';
include 'Configuracion.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    <title><?php echo ucwords(toAscii(base64_decode($_GET['name']))); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $url_web; ?>/bsaz.css">
</head>
<body class="margin50">
  <!-- header -->
  <?php include 'header.php'; ?>
  <!-- top ban -->

 <!-- main -->
 <div class="container main-page">
<div class="row">
<div class="panel">
 <div class="panel-body">
    <h1 class="product-title" style="margin-top: 20px;text-align: center;margin-bottom: 20px;font-weight: 700;"><?php echo ucwords(toAscii(base64_decode($_GET['name']))); ?> <i class="fa fa-music"></i></h1>
<iframe id="dlbutton" width="100%" height="60px" style="border:0;overflow:hidden;" scrolling="no" sandbox="allow-scripts allow-same-origin" src="https://www.convertmp3.io/widget/button/?video=https://www.youtube.com/watch?v=<?php echo base64_decode($_GET['id']) ?>&format=mp3&text=ffffff&color=383838"></iframe>
</div>
</div>
</div>
</div>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
