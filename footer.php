        <?php if (isset($_SESSION['login']) && $_SESSION['login'] === true) { ?>
        <br>
        <div class="text-center"> 
        <a class="btn btn-menu" href="<?php echo $url_web ?>/admin.php"><?php echo $admin_user; ?></a>
        <a class="btn btn-menu" href="<?php echo $url_web ?>/admin.php?logout=true">Salir</a>
        </div> 
        <br>  
        <?php }  ?>

<!-- end of what's hot placeholder -->
  </div>  <!-- container main-page -->

<!-- nav bottom -->
       <nav class="navbar navbar-default navbar-bottom">
          <div class="container text-center">
          <ul class="nav navbar-nav navbar-center">
            <li><a href="<?php echo $url_web ?>/contacto.html" rel="nofollow">Contacto</a></li>
            <li><a href="<?php echo $url_web ?>/privacy.html" rel="nofollow">Privacy Policy</a></li>
            <li><a href="<?php echo $url_web ?>/copyright.html" rel="nofollow">DMCA Policy</a></li>
         </ul>
          </div> 
        </nav>

<!-- bot ban -->
<!--   <div class="lboard-wrap">
  <div class="container">
    <div class="row">
       <div class="col-xs-12 top-ad text-center">
          <span id="cf_banner_bottom"></span>
       </div>
    </div>
  </div>
  </div> -->

<!-- footer -->
     <div class="footer-wrap">
          <div class="container">
          <small>
             Todas las letras son propiedad y copyright de sus propietarios. Todas las letras proporcionadas para fines educativos y uso personal solamente.<br>
             <script type="text/javascript">
                curdate=new Date();
                document.write("<strong>Copyright &copy; 2000-"+curdate.getFullYear()+" MP3K5.CLUB<\/strong>");
             </script>
          </small>
          </div>
     </div>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-111324369-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-111324369-1');
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="<?php echo $url_web ?>/js/collapse.js"></script>
<script type="text/javascript">var dsz = {"url":"<?php echo $url_web ?>"};</script>
<script src="<?php echo $url_web ?>/js/custom.js"></script>
<script src="<?php echo $url_web ?>/js/imglazyload.js"></script>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#343c66",
      "text": "#cfcfe8"
    },
    "button": {
      "background": "#f71559"
    }
  },
  "theme": "edgeless",
  "position": "bottom-right"
})});
</script>
