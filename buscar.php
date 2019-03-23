<?php 
include 'includes/funcion.php';
include 'Configuracion.php';

  $sql  = "SELECT * FROM Json WHERE NombreCompleto LIKE '%".$_GET['q']."%'";
  $results = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);
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
  <title>Resultado de <?php echo $_GET['q'] ?></title>
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

      <div class="panel">
        <?php if (count($results) !== 0): ?>
          <div class="panel-heading"><b>Resultados de la canción:</b><br><small>[<?php echo count($results); ?> total <span class="text-lowercase">canciones</span> encontradas]</small></div>
        <table class="table table-condensed"> 
          <?php 
            $count = 1;
          foreach ($results as $result) {
          ?>                                 
          <tr><td class="text-left visitedlyr">
           <?php echo $count++ ?>. <a href="<?php echo $url_web.'/m/'.$result['Slug'].'/'.$result['SongID']; ?>" target="_blank"><b><?php echo subtitulobusqueda($result['TituloCancion']); ?></b></a> by <b><?php echo artista($result['NombreArtista']) ?></b><br>
          </td></tr>
          <?php } ?>
          </table>    
        <?php else:
          echo '<div class="postmaintitle" style="margin-bottom: 15px;margin-top: 15px;"><h1>'.$_GET['q'].'</h1> </div>';
         include 'includes/Get_Video.php'; 
        endif ?>
      </div>

      <form class="search" method="get" action="" role="search">
        <div style="margin-bottom:15px" class="input-group">
          <input type="text" class="form-control" placeholder="" name="q" value="<?php echo $_GET['q']; ?>">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
          </span>
        </div>
      </form>
    </div></div></div>

    <?php include 'footer.php'; ?>
  </body>
  </html>

