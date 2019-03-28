<?php 
include 'includes/funcion.php';
include 'Configuracion.php';


  $sql  = "SELECT * FROM Json WHERE NombreCompleto LIKE '%".$_GET['q']."%'";
  $results = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);

  $TituloBuscar = ucwords('$_GET['q']');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noarchive, noindex, follow">
  <meta name="keywords" content="lyrics,music,song lyrics,songs,paroles">
  <META NAME="ROBOTS" CONTENT="NOINDEX, FOLLOW">
  <title>Descargar <?php echo $TituloBuscar ?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:400,500,600,700" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $url_web; ?>/bsaz.css">
</head>
<body class="margin50">
  <!-- header -->
  <?php include 'header.php'; ?>
  <!-- top ban -->

<div class="container main-page">
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center" style="padding-top: 20px;">
<?php
         echo '<div class="postmaintitle" style="margin-bottom: 15px;margin-top: 15px;"><h1>'.$TituloBuscar.'</h1> </div>';
         include 'includes/Get_Video.php'; 
?>
      </div>

      <form class="search" method="get" action="" role="search">
        <div style="margin-bottom:15px" class="input-group">
          <input type="text" class="form-control" placeholder="" name="q" value="<?php echo $TituloBuscar; ?>">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
          </span>
        </div>
      </form>
    </div></div></div>

    <?php include 'footer.php'; ?>
  </body>
  </html>

