<?php
session_start();
$url_web = 'http://localhost/1';
// $url_web = '//mp3k5a.club';
$Site_name = 'MP3K5.CLUB';

$pais = 'ar';

$admin_user='ElvisGraph';
$admin_pass='Winbinbo08';

$config_url='index.php';


$site_name = "LyricsTunes";
$api_fm = '7af09c5f06aab849cf50fbbf6556ef00';
$youtube_key = 'AIzaSyCi38rvwpawBBGzWk8nB3m_1LLPU3-7uPw';

include 'includes/Medoo.php';
include 'vendor/autoload.php';
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

?>