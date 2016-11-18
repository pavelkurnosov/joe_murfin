<?php
	require_once('controller.php');
	$keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : 1;
	header('location: index.php?keyword=' . $keyword);