<?php 
include 'includes/url_slug.php';

function ApiParse($Url){

  if(function_exists('curl_version')){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_URL,$Url);
    $result=curl_exec($ch);
    curl_close($ch);

  }
  else {

   $result = file_get_contents($Url);

  }

  $data = json_decode($result, true);

  if(isset($data['items']) && count($data['items']) > 0 ){
    return $data;
  } else {
  
    return false;
  }
}

function cache_url1($json, $time){
$cachetime = 86400;
if (isset($time)) {
$cachetime = $time;
}
$where     = "Cache/Json";
if (!is_dir($where)) { mkdir($where); } 
$hash = md5($json);
$file = "$where/$hash.cache";
  $mtime= 0;
 if (file_exists($file)) {
    $mtime = filemtime($file);
 }
  $filetimemod = $mtime + $cachetime;

  if ($filetimemod < time() OR !file_exists($file)) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_URL,$json);
    $result=curl_exec($ch);
    curl_close($ch);
    if ($result) {file_put_contents($file, $result);}
   }
   else {
    $result = file_get_contents($file);
   }

   return $result;
}

function cache_url($json){

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $json);
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
    
  return $result;
}

function cache_letra ($json){
// echo $json;
$cachetime = 99999999;
$where     = "Cache/Genius";
if (!is_dir($where)) { mkdir($where); } 
$hash = md5($json);
$file = "$where/$hash.txt";
  $mtime= 0;
 if (file_exists($file)) {
    $mtime = filemtime($file);
 }
  $filetimemod = $mtime + $cachetime;

  if ($filetimemod < time() OR !file_exists($file)) {
    $ip = "" . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255) . "." . mt_rand(0, 255);
    $ch = curl_init();
    $headers = array(
    'Content-type: application/json',
    'Authorization: Bearer 6X4mKeT6ErC4ghJJHtv-cfrEAIJbs8EKjRYX0Vh7-qXcxa7zha_PmAViMPhkcC7q',
    'REMOTE_ADDR: $ip',
    'HTTP_X_FORWARDED_FOR: $ip'
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL,$json);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_REFERER, "https://itunes.apple.com");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $result=curl_exec($ch);
    curl_close($ch);
    if ($result) {file_put_contents($file, $result);}
   }
   else {
    $result = file_get_contents($file);
   }

   return $result;
}

    function cache_image($image_url){
      global $url_web;
  if ($image_url !=="") { 
    //replace with your cache directory
    $image_path = 'Cache/Img/';
    //get the name of the file
    $random_hash=md5($image_url);
    $exploded_image_url = explode("/",$image_url);
    $image_filename = $random_hash.end($exploded_image_url);
   // echo $image_filename;
    $exploded_image_filename = explode(".",$image_filename);
    $extension = end($exploded_image_filename);
    // echo $extension;
    //make sure its an image
    if($extension == "gif" || $extension == "jpg" || $extension == "jpeg" || $extension == "png") {
        //get the remote image
        if (!file_exists($url_web.'/'.$image_path.$image_filename)){
        $image_to_fetch = file_get_contents($image_url);
        //save it
           //  var_dump($image_to_fetch)''
        if (isset($image_to_fetch) && $image_to_fetch!=''){
       
        $local_image_file = fopen($image_path.$image_filename, 'w+');
        chmod($image_path.$image_filename,0755);
        fwrite($local_image_file, $image_to_fetch);
        fclose($local_image_file);
            
        }
         }
        return $url_web.'/'.$image_path.$image_filename;
    }
    return $url_web."/images/persona-default.png";
}
else {
return $url_web."/images/persona-default.png";
}
}

    function cache_image_itunes($image_url){
      global $url_web;
  if ($image_url !=="") { 
    //replace with your cache directory
    $image_path = 'Cache/Img/';
    //get the name of the file
    $random_hash=md5($image_url);
    $exploded_image_url = explode("/",$image_url);
    $image_filename = $random_hash.end($exploded_image_url);
   // echo $image_filename;
    $exploded_image_filename = explode(".",$image_filename);
    $extension = end($exploded_image_filename);
    // echo $extension;
    //make sure its an image
    if($extension == "gif" || $extension == "jpg" || $extension == "jpeg" || $extension == "png") {
        //get the remote image
        if (!file_exists($url_web.'/'.$image_path.$image_filename)){
        $image_to_fetch = file_get_contents($image_url);
        //save it
           //  var_dump($image_to_fetch)''
        if (isset($image_to_fetch) && $image_to_fetch!=''){
       
            $cache_image_ulr = imagecreatefromstring($image_to_fetch);
            $watermark_image_url = imagecreatefromstring(file_get_contents('http:'.$url_web.'/imagenes/logo-min.png'));
            
            // Set the margins for the stamp and get the height/width of the stamp image
            $marge_right = 10;
            $marge_bottom = 10;
            $sx = imagesx($watermark_image_url);
            $sy = imagesy($watermark_image_url);
            imagecopy($cache_image_ulr, $watermark_image_url, imagesx($cache_image_ulr) - $sx - $marge_right, imagesy($cache_image_ulr) - $sy - $marge_bottom, 0, 0, imagesx($watermark_image_url), imagesy($watermark_image_url));
            //unlink($cache_image_ulr);
            imagepng($cache_image_ulr, $image_path.$image_filename);
            imagedestroy($cache_image_ulr);
            
        }
         }
        return $url_web.'/'.$image_path.$image_filename;
    }
    return false;
}
else {
return $url_web."/images/persona-default.png";
}
}


function guardar_letras ($json){
// echo $name;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_URL,$json);
    $result=curl_exec($ch);
    curl_close($ch);
    $result  = strstr($result, '<div class="lyrics">');
    $result = strstr($result, '<div class="lyrics">');
    $result = @explode('</div>', $result);
    $result = str_replace("<br>", "|#|", $result[0]);
    $result = strip_tags($result);
    $result = str_replace("|#|", "<br>", $result);
    
   return $result;
}

function replaceAccents($str) {

  $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,ø,Ø,Å,Á,À,Â,Ä,È,É,Ê,Ë,Í,Î,Ï,Ì,Ò,Ó,Ô,Ö,Ú,Ù,Û,Ü,Ÿ,Ç,Æ,Œ");

  $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,o,O,A,A,A,A,A,E,E,E,E,I,I,I,I,O,O,O,O,U,U,U,U,Y,C,AE,OE");

  return str_replace($search, $replace, $str);
}


// NO JODER CON ESO

function url_slug ($url) {
  $url = replaceAccents($url);
  $url = cano($url);
  return $url;

}

function titulo_letra2 ($g1) {
$g = explode("(", $g1);
$g = $g[0];

if (preg_match('/Remix/i', $g1)) {
$g = $g.'(Remix)';
}
return $g;
}

function titulo ($g1) {
$g = explode("(", $g1);
$g = $g[0];

return $g;
}

function artista ($g) {
  $g = explode(",", $g);
  $g = explode("&", $g[0]);

  return $g[0];
}
function artistabasededato ($g) {
  $g = explode(",", $g);
  $g = explode("&", $g[0]);
  $g = toAscii($g[0]);
  $g = cano($g);
  $g = replaceAccents($g);
  // echo $g;
  return $g;
}

function cocheteporparentesis($g) {
$g = str_replace('[', '(', $g);
$g = str_replace(']', ')', $g);
return $g;

}
function buscar_lt ($tl, $artista) {
$artista = artista($artista);
$tl = cocheteporparentesis($tl);

$tl = $tl.' '.$artista;
// Verificar
if (preg_match('/Remix/i', $tl) or preg_match('/feat/i', $tl)) {
// Si Existe Ambos
if (preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
$getRx = explode('(', $tl);
$getRx = explode(')', $getRx[1]);
$getRx = $getRx[0];

$getFt = explode('(', $tl);
$getFt = explode(')', $getFt[2]);
$getFt = $getFt[0];

$getTl = explode(' (', $tl);
$getTl = $getTl[0];
// 
$tl = $artista.' '.$getTl.' '.$getFt.' '.$getRx;
}
// Si Existe Solo Remix
if (preg_match('/Remix/i', $tl) && !preg_match('/feat/i', $tl)) {
$getTl = explode(' (', $tl);
$getTl = $getTl[0];

$getRx = explode('(', $tl);
$getRx = explode(')', $getRx[1]);
$getRx = $getRx[0];

$tl = $artista.' '.$getTl.' '.$getRx;
}
// Si Existe Solo Ft
if (!preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
$getTl = explode(' (', $tl);
$getTl = $getTl[0];

$getFt = explode('(', $tl);
$getFt = explode(')', $getFt[1]);
$getFt = $getFt[0];
echo 'sii';
$tl = $artista.' '.$getTl.' '.$getFt;
}
}

return str_replace(" ", "%20", $tl);

}

function buscar_lt1 ($tl, $artista) {
$artista = artista($artista);
$tl = cocheteporparentesis($tl);

$tl = $tl.' '.$artista;
// Verificar
if (preg_match('/Remix/i', $tl) or preg_match('/feat/i', $tl)) {
// Si Existe Ambos
if (preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
$getRx = explode('(', $tl);
$getRx = explode(')', $getRx[1]);
$getRx = $getRx[0];

$getFt = explode('(', $tl);
$getFt = explode(')', $getFt[2]);
$getFt = $getFt[0];

$getTl = explode(' (', $tl);
$getTl = $getTl[0];
// 
$tl = $artista.' '.$getTl.' '.$getFt.' '.$getRx;
}
// Si Existe Solo Remix
if (preg_match('/Remix/i', $tl) && !preg_match('/feat/i', $tl)) {
$getTl = explode(' (', $tl);
$getTl = $getTl[0];

$getRx = explode('(', $tl);
$getRx = explode(')', $getRx[1]);
$getRx = $getRx[0];

$tl = $artista.' '.$getTl.' '.$getRx;
}
// Si Existe Solo Ft
if (!preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
$getTl = explode(' (', $tl);
$getTl = $getTl[0];

$getFt = explode('(', $tl);
$getFt = explode(')', $getFt[1]);
$getFt = $getFt[0];

$tl = $artista.' '.$getTl.' '.$getFt;
}
}

$tl = toAscii($tl);
return str_replace(" ", "-", $tl);

}

function titulo_seo_letra ($tl, $artista) {
$artista = $artista;
$tl = cocheteporparentesis($tl);

$ptl = $tl.' - '.$artista;
if (preg_match('/Remix/i', $tl) or preg_match('/feat/i', $tl)) {
if (preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
  $ptl = explode(' (', $tl);
  $ptl = $ptl[0].' (Remix) - '.$artista;  
}

if (preg_match('/Remix/i', $tl) && !preg_match('/feat/i', $tl)) {
  $ptl = explode(' (Remix)', $tl);
  $ptl = $ptl[0].' (Remix) - '.$artista;
}
if (!preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
  $ptl = explode(' (feat.', $tl);
  $ptl = $ptl[0].' - '.$artista;

}
}

return $ptl;

}

function Sub_Titulo ($tl) {
// echo $tl;
$tl = cocheteporparentesis($tl);

$tl = $tl;
// Verificar
if (preg_match('/Remix/i', $tl) or preg_match('/feat/i', $tl)) {
// Si Existe Ambos
if (preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
$getRx = explode('(', $tl);
$getRx = explode(')', $getRx[1]);
$getRx = $getRx[0];

$getFt = explode('feat', $tl);
$getFt = explode(')', $getFt[1]);
$getFt = $getFt[0];

$getTl = explode(' (', $tl);
$getTl = $getTl[0];

if (preg_match('/Remix/i', $getRx)) {
$tl = $getTl.' ('.$getRx.')';
}
else {
// 
$tl = $getTl.' ('.$getFt.')';
}
}
// Si Existe Solo Remix
if (preg_match('/Remix/i', $tl) && !preg_match('/feat/i', $tl)) {
$getTl = explode(' (', $tl);
$getTl = explode(' Remix', $getTl[0]);
$getTl = $getTl[0];

$tl = $getTl.' (Remix)';
}
// Si Existe Solo Ft
if (!preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
$getTl = explode(' (', $tl);
$getTl = $getTl[0];

$getFt = explode('(', $tl);
$getFt = explode(')', $getFt[1]);
$getFt = $getFt[0];

$tl = $getTl;
}
}

return $tl;

}


function subtituloletra ($tl) {
// echo $tl;
$tl = cocheteporparentesis($tl);

$tl = '<b>'.$tl.'</b>';
// Verificar
if (preg_match('/Remix/i', $tl) or preg_match('/feat/i', $tl)) {
// Si Existe Ambos
if (preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
$getRx = explode('(', $tl);
$getRx = explode(')', $getRx[1]);
$getRx = $getRx[0];

$getFt = explode('(', $tl);
$getFt = explode(')', $getFt[2]);
$getFt = $getFt[0];

$getTl = explode(' (', $tl);
$getTl = $getTl[0];

if (preg_match('/Remix/i', $getRx)) {
$tl = '<b>'.$getTl.' ('.$getRx.')</b><br><span class="feat">('.str_replace('feat', "Feat", $getFt).')</span>';
}
else {
// 
$tl = '<b>'.$getTl.' ('.$getFt.')</b><br><span class="feat">('.str_replace('feat', "Feat", $getRx).')</span>';
}
}
// Si Existe Solo Remix
if (preg_match('/Remix/i', $tl) && !preg_match('/feat/i', $tl)) {
$getTl = explode(' (', $tl);
$getTl = $getTl[0];

$getRx = explode('(', $tl);
$getRx = explode(')', $getRx[1]);
$getRx = $getRx[0];

$tl = '<b>'.$getTl.' ('.$getRx.')</b>';
}
// Si Existe Solo Ft
if (!preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
$getTl = explode(' (', $tl);
$getTl = $getTl[0];

$getFt = explode('(', $tl);
$getFt = explode(')', $getFt[1]);
$getFt = $getFt[0];

$tl = '<b>'.$getTl.'</b><br><span class="feat">('.str_replace('feat', "Feat", $getFt).')</span>';
}
}

return $tl;

}


function subtitulobusqueda ($tl) {
$tl = cocheteporparentesis($tl);

if (preg_match('/Remix/i', $tl) or preg_match('/feat/i', $tl)) {
if (preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
  $tl = explode(' (', $tl);
  $tl = $tl[0].' (Remix)';  
}

if (preg_match('/Remix/i', $tl) && !preg_match('/feat/i', $tl)) {
  $tl = explode(' (Remix)', $tl);
  $tl = $tl[0].' (Remix)';
}
if (!preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
  $tl = explode(' (feat.', $tl);
  $tl = $tl[0];
}
}

return $tl;

}

function Slug_Letra ($artista, $tl) {
$tl = cocheteporparentesis($tl);

if (preg_match('/Remix/i', $tl) or preg_match('/feat/i', $tl)) {
if (preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
  $tl = explode(' (', $tl);
  $tl = $tl[0].' (Remix)';  
}

if (preg_match('/Remix/i', $tl) && !preg_match('/feat/i', $tl)) {
  $tl = explode(' (Remix)', $tl);
  $tl = $tl[0].' (Remix)';
}
if (!preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
  $tl = explode(' (feat.', $tl);
  $tl = $tl[0];
}
}

return cano(artista($artista).' '.$tl);

}

function limpiar_duplicado ($get, $key){
  $array = array();

  foreach ($get as $a) {
    if (empty($a->collectionArtistName)) {
     $a->collectionArtistName = '';
    }
    $array[] = array(
      'wrapperType' => $a->wrapperType,
      'url' => replaceAccents(cano($a->artistName.' '.$a->trackCensoredName)), 
      'artistId' => $a->artistId,
      'collectionId' => $a->collectionId,
      'trackId' => $a->trackId,
      'artistName' => $a->artistName,
      'collectionName' => $a->collectionName,
      'trackName' => $a->trackName,
      'collectionCensoredName' => $a->collectionCensoredName,
      'trackCensoredName' => $a->trackCensoredName,
      // 'artistViewUrl' => $a->artistViewUrl,
      // 'previewUrl' => $a->previewUrl,
      'primaryGenreName' => $a->primaryGenreName,
      'trackExplicitness' => $a->trackExplicitness,
      'collectionArtistName' => $a->collectionArtistName,
      'artworkUrl100' => $a->artworkUrl100

    );
}
    $temp_array = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        } 
        $i++; 
    } 
    return $temp_array; 

};

function limpiar_duplicado1 ($get, $key){
  $array = array();
  foreach ($get as $a) {
    if (!empty($a->trackCount)) {
    $array[] = array(    
      'wrapperType' => $a->wrapperType,
      'url' => replaceAccents(cano($a->artistName.' '.$a->collectionName)), 
      'artistId' => $a->artistId,
      'collectionId' => $a->collectionId,
      'collectionName' => $a->collectionName,
      'artistName' => $a->artistName,
      'trackCount' => $a->trackCount,
      'artworkUrl100' => $a->artworkUrl100,
    );
 }      
}
    $temp_array = array(); 
    $i = 0; 
    $key_array = array(); 
    
    foreach($array as $val) { 
        if (!in_array($val[$key], $key_array)) { 
            $key_array[$i] = $val[$key]; 
            $temp_array[$i] = $val; 
        } 
        $i++; 
    } 
    return $temp_array; 

};

function toAscii($str, $options = array(), $delimiter = ' ')
{
  // Make sure string is in UTF - 8 and strip invalid UTF - 8 characters
  $str = mb_convert_encoding((string) $str, 'UTF-8', mb_list_encodings());

  $defaults = array(
    'delimiter'    => $delimiter,
    'limit'        => null,
    'lowercase'    => false,
    'replacements'  => array(),
    'transliterate'=> false,
  );

  if (!isset($options) && $options == '') {
    $options = array();
  }
  // Merge options
  $options = array();
  $options = array_merge($defaults, $options);

  $char_map= array(
    // Latin
    'À'=> 'A','Á'=> 'A','Â'=> 'A','Ã'=> 'A','Ä'=> 'A','Å'=> 'A','Æ'=> 'AE','Ç'=> 'C',
    'È'=> 'E','É'=> 'E','Ê'=> 'E','Ë'=> 'E','Ì'=> 'I','Í'=> 'I','Î'=> 'I','Ï'=> 'I',
    'Ð'=> 'D','Ñ'=> 'N','Ò'=> 'O','Ó'=> 'O','Ô'=> 'O','Õ'=> 'O','Ö'=> 'O','Ő'=> 'O',
    'Ø'=> 'O','Ù'=> 'U','Ú'=> 'U','Û'=> 'U','Ü'=> 'U','Ű'=> 'U','Ý'=> 'Y','Þ'=> 'TH',
    'ß'=> 'ss',
    'à'=> 'a','á'=> 'a','â'=> 'a','ã'=> 'a','ä'=> 'a','å'=> 'a','æ'=> 'ae','ç'=> 'c',
    'è'=> 'e','é'=> 'e','ê'=> 'e','ë'=> 'e','ì'=> 'i','í'=> 'i','î'=> 'i','ï'=> 'i',
    'ð'=> 'd','ñ'=> 'n','ò'=> 'o','ó'=> 'o','ô'=> 'o','õ'=> 'o','ö'=> 'o','ő'=> 'o',
    'ø'=> 'o','ù'=> 'u','ú'=> 'u','û'=> 'u','ü'=> 'u','ű'=> 'u','ý'=> 'y','þ'=> 'th',
    'ÿ'=> 'y',
    // Latin symbols
    '©'=> '(c)',
    // Greek
    'Α'=> 'A','Β'=> 'B','Γ'=> 'G','Δ'=> 'D','Ε'=> 'E','Ζ'=> 'Z','Η'=> 'H','Θ'=> '8',
    'Ι'=> 'I','Κ'=> 'K','Λ'=> 'L','Μ'=> 'M','Ν'=> 'N','Ξ'=> '3','Ο'=> 'O','Π'=> 'P',
    'Ρ'=> 'R','Σ'=> 'S','Τ'=> 'T','Υ'=> 'Y','Φ'=> 'F','Χ'=> 'X','Ψ'=> 'PS','Ω'=> 'W',
    'Ά'=> 'A','Έ'=> 'E','Ί'=> 'I','Ό'=> 'O','Ύ'=> 'Y','Ή'=> 'H','Ώ'=> 'W','Ϊ'=> 'I',
    'Ϋ'=> 'Y',
    'α'=> 'a','β'=> 'b','γ'=> 'g','δ'=> 'd','ε'=> 'e','ζ'=> 'z','η'=> 'h','θ'=> '8',
    'ι'=> 'i','κ'=> 'k','λ'=> 'l','μ'=> 'm','ν'=> 'n','ξ'=> '3','ο'=> 'o','π'=> 'p',
    'ρ'=> 'r','σ'=> 's','τ'=> 't','υ'=> 'y','φ'=> 'f','χ'=> 'x','ψ'=> 'ps','ω'=> 'w',
    'ά'=> 'a','έ'=> 'e','ί'=> 'i','ό'=> 'o','ύ'=> 'y','ή'=> 'h','ώ'=> 'w','ς'=> 's',
    'ϊ'=> 'i','ΰ'=> 'y','ϋ'=> 'y','ΐ'=> 'i',
    // Turkish
    'Ş'=> 'S','İ'=> 'I','Ç'=> 'C','Ü'=> 'U','Ö'=> 'O','Ğ'=> 'G',
    'ş'=> 's','ı'=> 'i','ç'=> 'c','ü'=> 'u','ö'=> 'o','ğ'=> 'g',
    // Russian
    'А'=> 'A','Б'=> 'B','В'=> 'V','Г'=> 'G','Д'=> 'D','Е'=> 'E','Ё'=> 'Yo','Ж'=> 'Zh',
    'З'=> 'Z','И'=> 'I','Й'=> 'J','К'=> 'K','Л'=> 'L','М'=> 'M','Н'=> 'N','О'=> 'O',
    'П'=> 'P','Р'=> 'R','С'=> 'S','Т'=> 'T','У'=> 'U','Ф'=> 'F','Х'=> 'H','Ц'=> 'C',
    'Ч'=> 'Ch','Ш'=> 'Sh','Щ'=> 'Sh','Ъ'=> '','Ы'=> 'Y','Ь'=> '','Э'=> 'E','Ю'=> 'Yu',
    'Я'=> 'Ya',
    'а'=> 'a','б'=> 'b','в'=> 'v','г'=> 'g','д'=> 'd','е'=> 'e','ё'=> 'yo','ж'=> 'zh',
    'з'=> 'z','и'=> 'i','й'=> 'j','к'=> 'k','л'=> 'l','м'=> 'm','н'=> 'n','о'=> 'o',
    'п'=> 'p','р'=> 'r','с'=> 's','т'=> 't','у'=> 'u','ф'=> 'f','х'=> 'h','ц'=> 'c',
    'ч'=> 'ch','ш'=> 'sh','щ'=> 'sh','ъ'=> '','ы'=> 'y','ь'=> '','э'=> 'e','ю'=> 'yu',
    'я'=> 'ya',
    // Ukrainian
    'Є'=> 'Ye','І'=> 'I','Ї'=> 'Yi','Ґ'=> 'G',
    'є'=> 'ye','і'=> 'i','ї'=> 'yi','ґ'=> 'g',
    // Czech
    'Č'=> 'C','Ď'=> 'D','Ě'=> 'E','Ň'=> 'N','Ř'=> 'R','Š'=> 'S','Ť'=> 'T','Ů'=> 'U',
    'Ž'=> 'Z',
    'č'=> 'c','ď'=> 'd','ě'=> 'e','ň'=> 'n','ř'=> 'r','š'=> 's','ť'=> 't','ů'=> 'u',
    'ž'=> 'z',
    // Polish
    'Ą'=> 'A','Ć'=> 'C','Ę'=> 'e','Ł'=> 'L','Ń'=> 'N','Ó'=> 'o','Ś'=> 'S','Ź'=> 'Z',
    'Ż'=> 'Z',
    'ą'=> 'a','ć'=> 'c','ę'=> 'e','ł'=> 'l','ń'=> 'n','ó'=> 'o','ś'=> 's','ź'=> 'z',
    'ż'=> 'z',
    // Latvian
    'Ā'=> 'A','Č'=> 'C','Ē'=> 'E','Ģ'=> 'G','Ī'=> 'i','Ķ'=> 'k','Ļ'=> 'L','Ņ'=> 'N',
    'Š'=> 'S','Ū'=> 'u','Ž'=> 'Z',
    'ā'=> 'a','č'=> 'c','ē'=> 'e','ģ'=> 'g','ī'=> 'i','ķ'=> 'k','ļ'=> 'l','ņ'=> 'n',
    'š'=> 's','ū'=> 'u','ž'=> 'z',
  );

  // Make custom replacements
  $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);

  // Transliterate characters to ASCII
  if ($options['transliterate']) {
    $str = str_replace(array_keys($char_map), $char_map, $str);
  }

  // Replace non - alphanumeric characters with our delimiter
  $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);

  // Remove duplicate delimiters
  $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);

  // Truncate slug to max. characters
  $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');

  // Remove delimiter from ends
  $str = trim($str, $options['delimiter']);

  return $options['lowercase'] ? $str : $str;
}


function Slug_Title ($g, $tl) {

$g = explode(",", $g);
$g = explode("&", $g[0]);
$g = $g[0];

// echo $g;

$tl = cocheteporparentesis($tl);

$tl = $tl;
// Verificar
if (preg_match('/Remix/i', $tl) or preg_match('/feat/i', $tl)) {
// Si Existe Ambos
if (preg_match('/Remix/i', $tl) && preg_match('/feat/i', $tl)) {
$GetRx = explode(' (', $tl);
$GetRx = explode(')', $GetRx[1]);
$GetRx = $GetRx[0];

$GetFt = explode(' (', $tl);
$GetFt = explode(')', $GetFt[2]);
$GetFt = $GetFt[0];

$GetTl = explode(' (', $tl);
$GetTl = $GetTl[0];

if (preg_match('/Remix/i', $GetRx)) {

$tl = $GetTl.' '.$GetRx;
}
else {
$GetRx = $GetFt;
$GetFt = $GetRx;

$tl = $GetTl.' '.$GetRx;
}
}
}

return cano($g.' '.$tl);
}


function eliminarbasura($titulo) {

$titulo = str_replace(array('Official Video', 'Video Oficial', 'Official Audio', 'Lyric Video', 'Video oficial', 'Official Music Video', 'OFFICIAL VIDEO', "Official Lyric Video", "VIDEO OFFICIAL", "Audio Oficial"), "", $titulo);
$titulo = strtolower($titulo);
$titulo = ucwords($titulo);
  return $titulo;
}
function FormatDuration($duration){
  $FormatTime = new DateTime('@0');
  $FormatTime->add(new DateInterval($duration));
  // return $FormatTime->format('H:i:s');
  if ($FormatTime->format('H') > 0) {
  return $FormatTime->format('H:i:s');
  }
  else {
  return $FormatTime->format('i:s');
  }
}
?>