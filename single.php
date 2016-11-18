<?php
require_once('controller.php');

$video = getVideoInfo($_REQUEST['id']);
?>
<!DOCTYPE html>
<html lang="en" ng-app="myApp">
<head>
    <title>Single Video</title>

    <?php common('common_libraries') ?>
    <?php common('google_tag_header'); ?>

    <meta property="og:url" content="http://thebestofjuice.com/single.php?id=<?php echo $video['id']; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="<?php echo $video['title']; ?>"/>
    <meta property="og:description" content="<?php echo $video['description']; ?>"/>
    <meta property="og:image" content="<?php echo $video['thumbnail']; ?>"/>
</head>
<body>
<div class="row">
    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-sm-offset-1 col-md-offset-2 col-lg-offset-3">
        <div class="row logo">
            <a href="index.php">
                <img src="imgs/logo.png" class="img-responsive" alt="Responsive image">
            </a>
        </div>

        <?php common('header_menu', array('old_id' => $_REQUEST['id'])); ?>

        <div class="row content">
            <div class="col-md-12">
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="<?php echo $video['video_url']; ?>" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-12 video-title-single"><?php echo $video['title']; ?></div>
            <div class="col-md-12 video-description"><?php echo $video['description']; ?></div>
        </div>
        <div class="row more">
            <a href="index.php" type="button" class="btn btn-lg btn-block btn-warning">MORE VIDEOS</a>
        </div>

        <?php common('footer_menu'); ?>

    </div>
</div>
</body>
<?php common('google_tag_footer'); ?>
</html>

