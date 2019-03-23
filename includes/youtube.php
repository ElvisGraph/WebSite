<?php
$id = $_GET['id'];
echo "</br>";
echo "<div class='video-embed'>";
echo '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://www.youtube.com/embed/' . $id . '?rel=0"></iframe></div>';
echo "</div>";
exit();