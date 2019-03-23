 <?php 
 include 'Configuracion.php';
 include 'includes/funcion.php';

 if (isset($_GET['id'])) {
// ##############################################
 	$data = cache_url('https://itunes.apple.com/lookup?id='.$_GET['id'].'&entity=song');
 	$response = json_decode($data);
 	 	$count_artist = $database->count("Artista", [ "ArtistaID" => $response->results[0]->artistId ]);
 	echo $count_artist;
 	if ($count_artist < 1) {
 	 $database->insert("Artista", [
 			"NombreArtista" => artista($response->results[0]->artistName),
 			"ArtistaID" => $response->results[0]->artistId,
 		]);
 	}
// ##############################################


 	$count = $database->count("Json", [ "Slug" => $_GET['name'] ]);
 	if ($count > 0) { 
 		$data_itunes_songs = cache_url('https://itunes.apple.com/lookup?id='.$response->results[0]->artistId.'&entity=song&limit=10&country=us');
 		$response = json_decode($data_itunes_songs);
 		$numero = 1; 
 		foreach (array_slice($response->results, 1, 200) as $result_al) {

 			?>

 			<a href="<?php echo $url_web ?>/data.php?id=<?php echo $result_al->trackId; ?>&name=<?php echo Slug_Letra($result_al->artistName, $result_al->trackCensoredName)?>"><?php echo $numero; ?></a><br>

 			<?php 
 			$numero++;
 		}

 		exit();
 	}
 	else {
 // Cachear Cover
 	$Cover = str_replace('30x30bb', "200x200bb", $response->results[0]->artworkUrl30);
    $CoverMiniatura = str_replace('30x30bb', "80x80bb", $response->results[0]->artworkUrl30);
    $database->insert("Json", [
     "ArtistaID" => $response->results[0]->artistId,
     "SongID" => $response->results[0]->trackId,
     "NombreArtista" => $response->results[0]->artistName,
     "ArtistaPrincipal" => artista($response->results[0]->artistName),
     "TituloCancion" => $response->results[0]->trackCensoredName,
     "Cover" => $Cover,
     "Fecha" => $response->results[0]->releaseDate,
     "Album" => $response->results[0]->collectionId,
     "Slug" => Slug_Title(artista($response->results[0]->artistName), subtitulobusqueda($response->results[0]->trackCensoredName)),
     "NombreCompleto" => $response->results[0]->artistName.' '.$response->results[0]->trackCensoredName,
     "Genero" => $response->results[0]->primaryGenreName,
     "CoverMiniatura" => $CoverMiniatura
   ]);


     	$data_itunes_songs = cache_url('https://itunes.apple.com/lookup?id='.$response->results[0]->artistId.'&entity=song&limit=10&country=us');
 		$response = json_decode($data_itunes_songs);
 		$numero = 1; 
 		foreach (array_slice($response->results, 1, 200) as $result_al) {

 			?>

 			<a href="<?php echo $url_web ?>/data.php?id=<?php echo $result_al->trackId; ?>&name=<?php echo Slug_Letra($result_al->artistName, $result_al->trackCensoredName)?>"><?php echo $numero; ?></a><br>

 			<?php 
 			$numero++;
 		}

 		exit();
 	}


 	exit();
 }

$paises = array('MX', 'ES', 'AR');
foreach ($paises as $pais ) {
 $string = cache_url('https://rss.itunes.apple.com/api/v1/'.$pais.'/apple-music/hot-tracks/all/200/explicit.json');
 $json = json_decode($string);
 $numero = 1;
 foreach (array_slice($json->feed->results, 0,200) as $item) {
 	?>

 	<a href="<?php echo $url_web ?>/data.php?id=<?php echo $item->id?>&name=<?php echo Slug_Letra($item->artistName, $item->name)?>"><?php echo $numero; ?></a><br>
 	<?php
 	$numero++;
 }
 } 
 foreach ($paises as $pais ) {
 $string = cache_url('https://rss.itunes.apple.com/api/v1/'.$pais.'/top-songs/hot-tracks/all/200/explicit.json');
 $json = json_decode($string);
 $numero = 1;
 foreach (array_slice($json->feed->results, 0,200) as $item) {
    ?>

    <a href="<?php echo $url_web ?>/data.php?id=<?php echo $item->id?>&name=<?php echo Slug_Letra($item->artistName, $item->name)?>"><?php echo $numero; ?></a><br>
    <?php
    $numero++;
 }
 } 
  
 foreach ($paises as $pais ) {
 $string = cache_url('https://rss.itunes.apple.com/api/v1/'.$pais.'/new-releases/hot-tracks/all/200/explicit.json');
 $json = json_decode($string);
 $numero = 1;
 foreach (array_slice($json->feed->results, 0,200) as $item) {
    ?>

    <a href="<?php echo $url_web ?>/data.php?id=<?php echo $item->id?>&name=<?php echo Slug_Letra($item->artistName, $item->name)?>"><?php echo $numero; ?></a><br>
    <?php
    $numero++;
 }
 } 

 ?>