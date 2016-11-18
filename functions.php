<?php
/*function getParams()
{
    $segments = explode('/', $_SERVER['PATH_INFO']);
    $params = array();
    for ($s = 1; $s < sizeof($segments); $s = $s + 2) {
        if ($segments[$s] == '') break;
        $params[$segments[$s]] = $segments[$s + 1];
    }
    return $params;
}*/

function getDB()
{
    global $config;

    $db = mysqli_connect($config['hostname'], $config['username'], $config['password'], $config['database']);

    if (!$db) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    return $db;
}

function getRows($result)
{
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function getRow($result)
{
    $rows = getRows($result);
    return sizeof($rows) ? $rows[0] : NULL;
}

function saveVideoInfo($title, $description, $videoURL, $thumbnail)
{
    $db = getDB();
    $result = mysqli_query($db, "
    		INSERT INTO `videos` (`title`, `description`, `video_url`, `thumbnail`, `reg_ymd`) 
    	 	VALUES ('" . $title . "', '" . $description . "', '" . $videoURL . "', '" . $thumbnail . "', '" . date('Y-m-d H:i:s') . "');
	 	") or die (mysqli_error($db));
    mysqli_close($db);
    return 'OK';
}

function getVideoInfo($videoId)
{
    $db = getDB();
    $result = mysqli_query($db, "
			SELECT * FROM `videos` 
			WHERE id = '" . $videoId . "'
			ORDER BY reg_ymd DESC 
			LIMIT 0, 10
		") or die (mysqli_error($db));
    mysqli_close($db);
    return getRow($result);
}

function getAllVideoCount($keyword = '')
{
    $db = getDB();
    $where = 1;
    if ($keyword != '') {
        $where = " title LIKE '%" . $keyword . "%'/* OR description LIKE '%" . $keyword . "%'*/";
    }

    $cnt = 12;    // amount of videos in one list.
    $result = mysqli_query($db, "
			SELECT * FROM `videos` 
			WHERE " . $where . " 
		") or die (mysqli_error($db));
    mysqli_close($db);
    return sizeof(getRows($result));
}

function getStoredVideos($keyword = '', $pageNum = 1)
{
    $db = getDB();
    $where = 1;
    if ($keyword != '') {
        $where = " title LIKE '%" . $keyword . "%'/* OR description LIKE '%" . $keyword . "%'*/";
    }
    $cnt = 12;    // amount of videos in one list.
    $result = mysqli_query($db, "
			SELECT * FROM `videos` 
			WHERE " . $where . " 
			ORDER BY reg_ymd DESC 
			" . ($pageNum == 0 ? "" : "LIMIT " . (($pageNum * 1 - 1) * $cnt) . ", " . $cnt . "") . "
		") or die (mysqli_error($db));
    mysqli_close($db);
    return getRows($result);
}

function addVideoLink($title, $description, $videoURL)
{
    $db = getDB();
    $ary = explode('/', $videoURL);
    $videoId = $ary[sizeof($ary) - 1];
    $thumbnail = 'http://img.youtube.com/vi/' . $videoId . '/0.jpg';
    $videoLink = 'https://www.youtube.com/embed/' . $videoId;
    $result = mysqli_query($db, "
    		INSERT INTO `videos` (`title`, `description`, `video_url`, `thumbnail`, `reg_ymd`) 
    	 	VALUES ('" . $title . "', '" . $description . "', '" . $videoLink . "', '" . $thumbnail . "', '" . date('Y-m-d H:i:s') . "');
	 	") or die (mysqli_error($db));
    mysqli_close($db);
    return 'OK';
}

function changeVideoInfo($videoId, $title, $description)
{
    $db = getDB();
    $result = mysqli_query($db, "
    		UPDATE `videos` 
    		SET title='" . $title . "',
    			description='" . $description . "'
			WHERE id='" . $videoId . "'
		") or die (mysqli_error($db));
    mysqli_close($db);
    return 'OK';
}

function deleteVideo($videoId)
{
    $db = getDB();
    $result = mysqli_query($db, "DELETE FROM `videos` WHERE id='" . $videoId . "'") or die (mysqli_error($db));
    mysqli_close($db);
    return 'OK';
}

function getLoggableStatus($username, $password)
{
    $db = getDB();
    $result = mysqli_query($db, "SELECT * FROM users WHERE user_name='" . $username . "'") or die (mysqli_error($db));
    $row = getRow($result);
    if (sizeof($row)) {
        $result = mysqli_query($db, "SELECT * FROM users WHERE user_pwd='" . $password . "'") or die (mysqli_error($db));
        $row = getRow($result);
        if (sizeof($row)) {
            return 'OK';
        } else {
            return 'BAD_PASSWORD';
        }
    } else {
        return 'BAD_USERNAME';
    }
    mysqli_close($db);
    return 'BAD';
}

function getRandomVideoId($oldId = 1)
{
    $db = getDB();
    $result = mysqli_query($db, "SELECT * FROM videos WHERE id<>" . $oldId . " ORDER BY rand() limit 1") or die (mysqli_error($db));
    $row = getRow($result);
    mysqli_close($db);
    return $row['id'];
}

function common($flag, $params = NULL)
{
    $code = "";
    if ($flag == 'header_menu') {
        $code = '
				<div class="row header">
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-text">
						<a href="index.php">VIDEOS</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-text">
						<a href="random.php?old_id=' . (isset($params['old_id']) ? $params['old_id'] : 1) . '">RANDOM</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-text">
						<a href="#" onclick="setFocus();" data-toggle="modal" data-target="#searchModal">SEARCH</a>
						<!-- Search Box -->
						<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-body">
								    <!-- content goes here -->
								  	<div class="form-group">
					                	<input type="text" onkeyup="keyEvent(event);" class="form-control" id="keyword" placeholder="Give me a keyword.">
					              	</div>
									<div class="btn-group btn-group-justified" role="group" aria-label="group button">
										<div class="btn-group" role="group">
											<button type="button" id="saveImage" onclick="searchVideos();" class="btn btn-default btn-hover-green" data-action="save" role="button">Search</button>
										</div>
										<div class="btn-group" role="group">
											<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
										</div>
									</div>
									<script>
										function setFocus () {
											setTimeout(function () {
												$("#keyword").focus().select();
											}, 500)
										}
										function searchVideos () {
											keyword = $("#keyword").val();
											if (keyword == "") {
												$("#keyword").focus().select();
											} else {
												window.open("search.php?keyword=" + keyword, "_self");
											}
										}
										function keyEvent(e) {
											if (e.keyCode == 13) {
												searchVideos();
											}
										}
									</script>
								</div>
							</div>
						  </div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-text">
						<a href="mailto:joe@thebestofjuice.com?Subject=Hello">CONTACT</a>
					</div>
				</div>
			';
    } else if ($flag == 'footer_menu') {
        $code = '
				<div class="row footer ">
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-text">
						<a href="index.php">VIDEOS</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-text">
						<a href="random.php">RANDOM</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-text">
						<a href="#" onclick="setFocus();" data-toggle="modal" data-target="#searchModal">SEARCH</a>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 menu-text">
						<a href="#">CONTACT</a>
					</div>
				</div>
				<div class="row copyright">
					COPYRIGHT © THEBESTOFJUICE 
				</div>
			';
    } else if ($flag == 'google_tag_header') {
        $code = "
    			<!-- Google Tag Manager -->
				<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
				j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
				'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
				})(window,document,'script','dataLayer','GTM-M5M3TB');</script>
				<!-- End Google Tag Manager -->
    		";
    } else if ($flag == 'google_tag_footer') {
        $code = '
    			<!-- Google Tag Manager (noscript) -->
				<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M5M3TB"
				height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
				<!-- End Google Tag Manager (noscript) -->
    		';
    } else if ($flag == 'common_libraries') {
        $code = '
    			<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				
				<link href="libs/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
				<link href="libs/bootstrap-datepicker/datepicker.css" rel="stylesheet" type="text/css"/>
				<link href="css/styles.css" rel="stylesheet" type="text/css"/>
				<link rel="icon" href="imgs/favicon.ico" type="image/x-icon"/>

				<script src="libs/jquery-2.1.4.min.js"></script>
				<script src="libs/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
			';
    } else if ($flag == 'footasdfer') {

    } else {

    }
    echo $code;
}

?>