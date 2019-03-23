<div class="row text-left">
<?php
$data_al = cache_url('https://itunes.apple.com/lookup?id='.$_GET['id'].'&entity=album&limit=200', 86400*7);
$response_al = json_decode($data_al);

foreach (array_slice($response_al->results, 1, 200) as $a){ 
  if ($a->trackCount >= 3 && $_GET['id'] == $a->artistId) {

  ?>   
        <a href="">
        <div class="col-xs-12 col-sm-6 col-md-4 nueva-cancion">
          <div class="cuadro"
          ><span class="cover-cancion clearfix"><img width="80" height="80" src="<?php echo $a->artworkUrl100; ?>" alt="ChocQuibTown, Zion &amp; Lennox &amp; Farruko Pa Olvidarte (feat. Manuel Turizo) [Remix]"></span><div class="datos-cancion"> <span class="titulo-cancion"> <?php echo $a->collectionName; ?></span><p> <span class="artista"><i class="fa fa-user"></i> <?php echo $a->artistName; ?></span></p><p><span class="fecha-cancion"> Urbano latino</span></p></div><div class="clear clearfix">
          </div>
        </div>
      </div>
      </a>
<?php } }?>
    </div>