
<?php
function youtube_name($g){
	$g = toAscii($g);
	$g = str_replace(" ", "+", $g);
	$g = strtolower($g);
	return $g;
}

$youtube_name = youtube_name($NombreArtista.' '.$TituloCancion);

$data_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q='.$youtube_name.'+audio&maxResults=5&key='.$youtube_key.'&type=video';
$response = ApiParse($data_url);


$tmp = '';
foreach($response['items'] as $key => $v) {
	if($key > 0){
	$tmp .= ",";
	}
    $tmp .= $v['id']['videoId'];
}

$stats_data_url = 'https://www.googleapis.com/youtube/v3/videos?part=contentDetails,statistics&id='.$tmp.'&key='.$youtube_key.'';
$stats_response = ApiParse($stats_data_url);

$count = 0;
foreach ($response['items'] as $video) {
$video['snippet']['title'] = eliminarbasura($video['snippet']['title']);

$url_download = 'https://perrochihuahua.xyz/music.php?title='.base64_encode(toAscii( $video['snippet']['title'] )).'&id='.base64_encode($video['id']['videoId']);
// $url_download = $url_web.'/download/'.base64_encode($video['snippet']['title']).'/'.base64_encode($video['id']['videoId']);
 ?>

 <div class="panel panel-default">
  <div class="panel-body">
<div id="item-<?php echo $video['id']['videoId'];?>">
						<ul class="media-list">
						  <li class="media">
						    <div class="media-left">
						      <amp-img class="media-object" width="120px" height="90px" title="<?php echo toAscii( $video['snippet']['title'] ); ?>" src="<?php echo $video['snippet']['thumbnails']['default']['url'];?>" alt="<?php echo toAscii($video['snippet']['title']); ?>">
						     </div>
						    <div class="media-body">
						      <h4 style="text-transform: uppercase;" class="media-heading"><i class="fa fa-bolt"></i> <?php echo toAscii( $video['snippet']['title'] ); ?></h4>
						      <div class="well1" style="padding: 10px;margin-bottom: 0px;">
							  <i class="fa fa-calendar" aria-hidden="true"></i> <?php echo substr($video['snippet']['publishedAt'],0,10); ?>
						 <?php
						// echo $count;
						echo '<i class="fa fa-clock-o" aria-hidden="true"></i>' . FormatDuration($stats_response['items'][$count]['contentDetails']['duration']);
						echo '<i class="fa fa-eye" aria-hidden="true"></i>' . number_format($stats_response['items'][$count]['statistics']['viewCount']);
						?>
						    </div>
							</div>
							<div class="media-right">
									<a title="Reproducir" href="<?php echo $Canonical; ?>" class="btn-play"><button type="button" class="btn btn-success btn-md" ><i class="fa fa-play" aria-hidden="true"></i> Escuchar</button></a>
									<a target="_blank" rel="nofollow" title="Descargar" href="<?php echo $url_download;?>"><button type="button"  class="btn btn-primary btn-md"><i class="fa fa-download" aria-hidden="true"></i> Descargar</button></a>
						    </div>
						  </li>
						</ul>
<div id="player-<?php echo $video['id']['videoId'];?>" class="player clearfix"></div>

</div>
</div>
</div>
	<?php
 $count++;
}
?>