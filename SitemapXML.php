<?php
 include 'Configuracion.php';
 include 'includes/funcion.php';

$url_web = 'https://mp3k5.club';
header("Content-Type: text/xml");
print "<?xml version='1.0' encoding='utf-8'?>";
$pageLimit = 1000;
$base      = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$base      = substr($base, 0, strrpos($base, "/") + 1);
//$link = mysql_connect($database['db_host'],$database['db_user'],$database['db_pass']);
//mysql_select_db($database['db_name'],$link);
if (isset($_GET["page"])) {
  print '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:xhtml="http://www.w3.org/1999/xhtml">
  ';
  $page    = intval($_GET["page"]);
  $from    = (($page - 1) * $pageLimit);
  $sql     = "SELECT * FROM Json LIMIT " . $from . "," . $pageLimit;
  //$result = mysql_unbuffered_query($sql,$link);
  $results = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  //var_dump($results);
  foreach ($results as $result) {
    print "<url>";
    print "<loc>" . $url_web . "/m/" . $result['Slug']."/".$result['SongID']."</loc>";
    print "</url> ";
  }
  print "</urlset>";
}
else {
  print "<sitemapindex xmlns='http://www.google.com/schemas/sitemap/0.84' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/siteindex.xsd'>";
  $sql     = "SELECT count(*) as count FROM Json";
  // $result = mysql_query($sql,$link);
  $results = $database->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $row = $results[0]['count'];
  $pages   = ceil($row / $pageLimit);
  for ($i = 1; $i <= $pages; $i++) {
    print "<sitemap>";
    print "<loc>" . $url_web . "/sitemap_" . $i . ".xml</loc>";
    print "</sitemap>";
  }
  print "</sitemapindex>";
}
exit();
?>