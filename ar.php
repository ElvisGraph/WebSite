<?php
define ('DB_USER', "mllhmbdf_web");
define ('DB_PASSWORD', "Winbinbo08");
define ('DB_DATABASE', "mllhmbdf_web");
define ('DB_HOST', "198.20.126.132");
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$sql = "SELECT * FROM Artista 
		WHERE NombreArtista LIKE '%".$_GET['q']."%'
		LIMIT 10"; 
$result = $mysqli->query($sql);
$json = [];
while($row = $result->fetch_assoc()){
     $json[] = ['id'=>$row['NombreArtista'], 'text'=>$row['NombreArtista']];
}
echo json_encode($json);