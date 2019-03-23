<?php 
$data_letra = cache_letra('https://api.genius.com/search?q='.buscar_lt($TituloCancion, $NombreArtista).'&per_page=4');
// echo $data_letra;
// exit();
  $data_letra = json_decode($data_letra);
// foreach ($data_letra->response->hits as $key) {
//   echo $key->result->primary_artist->name;
// }
//   exit();
  if (!empty($data_letra->response->hits)) {
    if ($data_letra->response->hits[0]->result->primary_artist->name !== 'Spotify' && $data_letra->response->hits[0]->result->primary_artist->name !== "Genius en Español"  && !empty($data_letra->response->hits[0]->result->url) && !preg_match('/My Top Songs & Albums/i', $data_letra->response->hits[0]->result->full_title) && $data_letra->response->hits[0]->result->primary_artist->name !== "Genius" && preg_match('/'.artista($NombreArtista).'/i', $data_letra->response->hits[1]->result->primary_artist->name)) {
      $data_letras = guardar_letras($data_letra->response->hits[0]->result->url);
    }
    elseif ($data_letra->response->hits[1]->result->primary_artist->name !== 'Spotify' && $data_letra->response->hits[1]->result->primary_artist->name !== "Genius en Español"  && !empty($data_letra->response->hits[1]->result->url) && !preg_match('/My Top Songs & Albums/i', $data_letra->response->hits[1]->result->full_title) && $data_letra->response->hits[1]->result->primary_artist->name !== "Genius" && preg_match('/'.artista($NombreArtista).'/i', $data_letra->response->hits[1]->result->primary_artist->name)) {

      $data_letras = guardar_letras($data_letra->response->hits[1]->result->url);
    }
    elseif ($data_letra->response->hits[2]->result->primary_artist->name !== 'Spotify' && $data_letra->response->hits[2]->result->primary_artist->name !== "Genius en Español" && !empty($data_letra->response->hits[2]->result->url) && !preg_match('/My Top Songs & Albums/i', $data_letra->response->hits[2]->result->full_title) && $data_letra->response->hits[2]->result->primary_artist->name !== "Genius" && preg_match('/'.artista($NombreArtista).'/i', $data_letra->response->hits[1]->result->primary_artist->name)) {
      $data_letras = guardar_letras($data_letra->response->hits[2]->result->url);
    }
    elseif ($data_letra->response->hits[3]->result->primary_artist->name !== 'Spotify' && $data_letra->response->hits[3]->result->primary_artist->name !== "Genius en Español" && $data_letra->response->hits[3]->result->primary_artist->name !== "Genius" && !empty($data_letra->response->hits[3]->result->url) && !preg_match('/My Top Songs & Albums/i', $data_letra->response->hits[3]->result->full_title) && preg_match('/'.artista($NombreArtista).'/i', $data_letra->response->hits[1]->result->primary_artist->name)) {
      $data_letras = guardar_letras($data_letra->response->hits[3]->result->url);
    }
  }
  else {
    include 'ajax.php';
  }

// echo $data_letra->response->hits[0]->result->url;
 ?>