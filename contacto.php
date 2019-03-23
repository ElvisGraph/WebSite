<?php 
include 'includes/funcion.php';
include 'Configuracion.php';
  if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['comments'];
    $from = 'Contact Form'; 
    $to = 'lihuc@mymailbest.com';
    $subject = 'Message from '.$_POST['email'].' contact form';
    
    $body ="From: $name\n E-Mail: $email\n Message:\n $message";
    $replyto ="Reply-To: $email";
    
    // Check if name has been entered
    if (!$_POST['name']) {
      $errName = 'Please enter your name';
    }
    
    // Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $errEmail = 'Please enter a valid email address';
    }
    
    //Check if message has been entered
    //Check if simple anti-bot test is correct
// If there are no errors, send the email
  if (mail ($to, $subject, $body, $replyto)) {
    $result='<div class="alert alert-success">Your message has been sent successfully.</div>';
  } else {
    $result='<div class="alert alert-danger">An error occurred. Please try again later.</div>';
  }

  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noarchive">
  <meta name="name" content="<?php echo  $site_name ?>">
  <meta name="keywords" content="lyrics,music,song lyrics,songs,paroles">  
  <title>Contacto | <?php echo $site_name ?></title>
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

<div class="panel-heading">
<b>¡Al completar este formulario enviaremos su mensaje directamente al equipo de LyricsTunes.com! </b><br>
<small>Si desea enviar / corregir letras, por favor <a href="/add.php">click here</a></small>
</div>

<div class="panel-body">
<form method="post">

<div class="form-group">
 <label for="name">Tu nombre:</label>
 <input type="text" class="form-control" id="name" name="name" value="" required="">
</div>
<div class="form-group">
 <label for="email">tu correo eletronico:</label>
 <input type="text" class="form-control" id="email" name="email" value="" required="">
</div>
<div class="form-group">
 <label for="subj">Asunto:</label>
 <input type="text" class="form-control" id="subj" name="subj" value="" required="">
</div>
<div class="form-group">
 <label for="comments">Mensaje:</label>
 <textarea class="form-control" id="comments" name="comments" rows="15" required="" ></textarea>
</div>
<button class="btn btn-primary" type="submit" name="submit">Enviar Mensaje</button>

</form>
</div>

</div></div></div></div>

    <?php include 'footer.php'; ?>
  </body>
  </html>

