<?php
function Lyrics_URL ($title, $artist) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://api.musixmatch.com/ws/1.1/track.search?q_track=".$title."&q_artist=".$artist."&page_size=5&page=1&s_track_rating=desc&apikey=445d6196c08dc2b7490929f18149d684");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_ENCODING,  '');
    $result=curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result);
    $result = $result->message->body->track_list[0]->track->track_share_url;
    $result = explode("?utm", $result);

   return $result[0];
}

function Lyrics_Date ($URL) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $URL);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_ENCODING,  '');
    $result=curl_exec($ch);
    curl_close($ch);
    $result  = strstr($result, ',"body":"');
    $result = strstr($result, 'body":"');
    $result = @explode('","language":', $result);
    $result = str_replace('body":"', "", $result[0]);
    $result = nl2br(stripcslashes($result));
    return $result;
}

$Lyrics_URL = Lyrics_URL(titulo_letra2(str_replace(" ", "%20", $TituloCancion)), artista(str_replace(" ", "%20", $NombreArtista)));

$Lyrics_Date = Lyrics_Date($Lyrics_URL);

$data_letras = $Lyrics_Date;

