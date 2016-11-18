<?php
require_once('controller.php');

$keyword = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
$videos = getStoredVideos($keyword);
?>
<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
    <meta charset="utf-8">
    <title>Video List</title>
    <?php common('common_libraries'); ?>
    <?php common('google_tag_header'); ?>
</head>
<body>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
        <div class="row logo">
            <a href="index.php">
                <img src="imgs/logo.png" class="img-responsive" alt="Responsive image">
            </a>
        </div>

        <?php common('header_menu'); ?>

        <div class="row content" id="containerDiv">
            <?php
            if (sizeof($videos)) {
                foreach ($videos as $key => $video) {
                    $title = isset($video['title']) ? $video['title'] : '';
                    echo '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 video-div">';
                    echo '<a href="single.php?id=' . $video['id'] . '" class="video-sub-title">';
                    echo '<div class="zoomed-wrapper">';
                    echo '<img src="' . $video['thumbnail'] . '" class="img-responsive max-width zoomed" alt="Responsive image"/>';
                    echo '<div class="h4 video-title middle">' . $title . '</div>';
                    echo '</div>';
                    $title = $video['title'];
                    if ($keyword != '') {
                        $pattern = preg_quote($keyword);
                        $title = preg_replace("/($pattern)/i", '<b>$1</b>', $title);
                    }
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<div class="h3 text-center"><br/>There is no any results.<br/><br/></div>';
            }
            ?>
        </div>
        <div class="row more">
            <button id="moreVideosBtn" class="btn btn-lg btn-block btn-warning">MORE VIDEOS</a>
        </div>

        <?php common('footer_menu'); ?>

    </div>
</div>
</body>
<script type="text/javascript">
    var pageNum = 2;

    $(document).ready(function () {
        $('#moreVideosBtn').click(function () {
            getMoreVideos();
        });
    });

    function getMoreVideos() {
        url = 'controller.php?flag=more_videos';
        url += '&keyword=<?php echo $keyword; ?>';
        url += '&pagenum=' + pageNum;
        $.get(url, function (response) {
            rows = eval(response);
            html = '';
            for (r in rows) {
                row = rows[r];
                html += '<div class="col-xs-12 col-sm-6 col-md-6 video-div">';
                html += '<a href="single.php?id=' + row['id'] + '" class="video-sub-title">';
                html += '<img src="' + row['thumbnail'] + '" class="img-responsive max-width" alt="Responsive image">';

                html += '<div class="h4 ">' + row['title'] + '</div>';
                html += '</a>';
                html += '</div>';
            }
            $('#containerDiv').append(html);
        });
        pageNum++;
    }
</script>
<?php common('google_tag_footer'); ?>
</html>

