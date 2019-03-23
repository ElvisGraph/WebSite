
<?php
function youtube_name($g){
	$g = toAscii($g);
	$g = str_replace(" ", "+", $g);
	$g = strtolower($g);
	return $g;
}
if (isset($_GET['q'])) {
$youtube_name = youtube_name($_GET['q']);
}
else {
$youtube_name = youtube_name($NombreArtista.' '.$TituloCancion); }

$data_url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q='.$youtube_name.'+audio&maxResults=5&key='.$youtube_key.'&type=video&order=relevance';
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
						<ul class="media-list" style=" margin: 0; ">
						  <li class="media">
						    <div class="media-left">
						      <img class="media-object" width="120px" height="90px" title="<?php echo htmlspecialchars( $video['snippet']['title'] ); ?>" src="<?php echo $video['snippet']['thumbnails']['default']['url'];?>" alt="<?php echo $video['snippet']['title']; ?>">
						     </div>
						    <div class="media-body">
						      <h4 style="text-transform: uppercase;" class="media-heading"><i class="fa fa-bolt"></i> <?php echo toAscii( $video['snippet']['title'] ); ?></h4>
						      <div class="well1" style="padding: 10px;margin-bottom: 0px;">
							  <span class="glyphicon glyphicon-calendar " style="margin-right: 5px"></span> <?php echo substr($video['snippet']['publishedAt'],0,10); ?>
						 <?php
						// echo $count;
						echo '<span class="	glyphicon glyphicon-time" style="margin-left: 5px;margin-right: 2px;"></span>' . FormatDuration($stats_response['items'][$count]['contentDetails']['duration']);
						echo '<span class="	glyphicon glyphicon-eye-open" style="margin-left: 5px;margin-right: 2px;"></span>' . number_format($stats_response['items'][$count]['statistics']['viewCount']);
						?>
						    </div>
							</div>
							<div class="media-right">
									<a title="Reproducir" href="javascript:;" data-id="<?php echo $video['id']['videoId'];?>" data-title="<?php echo htmlspecialchars( $video['snippet']['title'] ); ?>" data-source="youtube" id="ic<?php echo $video['id']['videoId'];?>" class="btn-play" rel="nofollow"><button type="button" class="btn btn-success btn-md" style="width: 100%;margin-bottom: 10px; color: #fff; background-color: #449d44; border-color: #398439;"><i class="fa fa-play" aria-hidden="true"></i> Play</button></a>
									<a title="Parar" href="javascript:;" data-id="<?php echo $video['id']['videoId'];?>" class="btn-stop" style="display: none;" rel="nofollow"> <button type="button" class="btn btn-warning btn-md" style="width: 100%;margin-bottom: 10px; color: #fff; background-color: #f0ad4e; border-color: #eea236;"><i class="fa fa-stop"></i> Stop</button></a>
									<a target="_blank" rel="nofollow" title="Descargar" href="<?php echo $url_download;?>"><button type="button"  style="margin: 0px; width: 100%; color: #fff; background-color: #286090; border-color: #204d74;" class="btn btn-primary btn-md" style="margin: 0px;"><i class="fa fa-download" aria-hidden="true"></i> Descargar</button></a>
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