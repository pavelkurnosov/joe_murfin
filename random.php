<?php
	require_once('controller.php');
	$oldId = isset($_REQUEST['old_id']) ? $_REQUEST['old_id'] * 1 : 1;
	$videoId = getRandomVideoId($oldId);
	header('location: single.php?id=' . $videoId);