<?php
	header('Cache-Control: no-cache, must-revalidate');
	header("Content-Type: application/json");
	echo $content_for_layout;
?>