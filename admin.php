<?php
include 'includes/funcion.php';
include 'Configuracion.php';
// include 'includes/nocsfr.php';

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
  <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
  <script src="<?php echo $url_web; ?>/js/clipboard.min.js"></script>
</head>
<body class="margin50">
  <!-- header -->
  <?php include 'header.php'; ?>
  <!-- top ban -->
<?php 
// mail ( "lihuc@mymailbest.com" , "rgeth" , "fjriegjitjeoh");
 ?>
 <!-- main -->
 <div class="container main-page">
<div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 text-center" style="padding-top: 20px;">
  <div class="panel"> 
     <div class="panel-body">

    <?php
            if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
            // echo $password;
            if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
              $_SESSION['login'] = false;
              echo '<div class="panel-body">';
              echo 'Logout';
              //  session_destroy();
              echo '<h1>Logout - Redirect to Home Page</h1>';
              echo '
              </div>
              </div>
              </div>
              </div>
              </div>';
              die();

            }
          }
          else {

            if (isset($_POST['submit'])) {


                // var_dump($_POST);
                // Run CSRF check, on POST data, in exception mode, for 10 minutes, in one - time mode.

                $username = $_POST['username'];
                $password = $_POST['password'];
                //  echo $username;
                //  echo $password;
                if ($username === $admin_user && $password === $admin_pass) {

                  $_SESSION['login'] = true;
                  //var_dump($_SESSION['login']);
                  echo '<h1>Login Succesfully, Redirecting to Configuration Page</h1>';
                  echo '
                  </div>
                  </div>
                  </div>
                  </div>
                  ';
                  die();
                }
                if ($username !== $_POST['username']) {
                  $userError = 'Invalid Username';
                }

            }
            if (isset($userError) && $userError != '') {
              echo $userError;
            } ?>

 <form method='post'>
  <div class="form-group">
    <label for="exampleInputPassword1">Usuario</label>
    <input name="username" type="username" class="form-control" id="username" aria-describedby="emailHelp" placeholder="Usuario">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Contraseña</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Iniciar</button>



            <?php die();
          }
          ?>

<?php include 'footer.php'; ?>
</body>
</html>