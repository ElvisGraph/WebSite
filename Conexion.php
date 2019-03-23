<?php 
include 'includes/Medoo.php';
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'mllhmbdf_web',
	'server' => '198.20.126.132',
	'username' => 'mllhmbdf_web',
	'password' => 'Winbinbo08',
	'collation' => 'utf8_unicode_ci'
]);
$database->insert("Music", [
	"artistId" => "ddddddddd",
]);



// $datas = $database->select("Letras", "*", array( "id"=> 10,'LIMIT' => 1, ));

// echo $datas[0]['name'];
 ?>
