<?php 
	$loggedIn = true;
	if ($loggedIn) {
		// header('Location: login.php');
	}
?>
<!DOCTYPE html>
<html lang="en" ng-app="myApp">
	<head>
		<meta charset="utf-8">
		<title>Scrap Videos</title>
		<meta name="../viewport" content="width=device-width, initial-scale=1.0">
		<link href="../libs/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="../libs/bootstrap-datepicker/datepicker.css" rel="stylesheet">
		<link href="../libs/datatables-1.10.12/jquery.dataTables.min.css" rel="stylesheet">
		<link href="../css/styles.css" rel="stylesheet">

		<script src="../libs/jquery-2.1.4.min.js"></script>
		<script src="../libs/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		<script src="../libs/datatables-1.10.12/jquery.dataTables.min.js"></script>

	</head>
	<body>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row logo">
					<a href="index.php">
						<img src="../imgs/logo.png" class="img-responsive" alt="Responsive image">
					</a>
				</div>
				<div class="row header">
					<div class="col-md-2 col-md-offset-10 menu-text">
						<a href="../login.php">Log Out</a>
					</div>
				</div>			
				<div class="row content">
					<ul class="nav nav-tabs">
					  	<li><a href="index.php">Stored Videos</a></li>
					  	<li class="active"><a>Scrap Videos</a></li>
					  	<!-- <li><a href="manage_users.php">Manage Users</a></li> -->
					</ul>

					<div class="tab-content">
					  	<div id="stored_videos" class="tab-pane fade">
					    
					  	</div>

					  	<div id="scrap_videos" class="tab-pane fade in active">
					    	<div class="row">
					    		<div class="form-group">
									<div class="row">
										<div class="col-sm-5">
											<div class="input-group dropdown">
									          	<input type="text" id="keyword_txt" class="form-control video_url_text dropdown-toggle" value="Wimp.com">
									          	<ul class="dropdown-menu">
										            <li><a href="#" data-value="Wimp.com">Wimp.com</a></li>
										            <li><a href="#" data-value="Devour.com">Devour.com</a></li>
										            <li><a href="#" data-value="mostwatchedtoday.com">mostwatchedtoday.com</a></li>
										        </ul>
									          	<span role="button" class="input-group-addon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></span>
									        </div>
										</div>
										<div class="col-sm-2">
											<button class="form-control btn btn-lg btn-primary" id="scrap_video">Scrap</button>
										</div>
										<div class="col-sm-5">
											<div class="progress progress-striped active">
										        <div class="progress-bar progress-bar-success" style="width:0%"></div>
										    </div>
										</div>
									</div>
								</div>
					    	</div>
					    	<div class="row data-div">
					    		<table id="example1" class="table" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							                <th class="text-center">No</th>
							                <th class="text-center">Title</th>
							                <th class="text-center">Description</th>
							                <th class="text-center">Video</th>
							                <th class="text-center">Add</th>
							            </tr>
							        </thead>
							        <tbody id="tbody">

							        </tbody>
							    </table>
					    	</div>
					  	</div>

					  	<div id="manage_users" class="tab-pane fade">
					    	
					  	</div>
					</div>
				</div>
				<div class="row footer ">
					
				</div>
				<div class="row copyright">
					COPYRIGHT © THEBESTOFJUICE ON THE COPYRIGHT BIT
				</div>
			</div>
		</div>
		<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-body">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <div>
		                    <iframe width="100%" height="350" src=""></iframe>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
	</body>
	<script type="text/javascript">
		var table;
		$(document).ready(function() {
		    table = $('#example').DataTable();

		    $('.dropdown-menu a').click(function() {
			    // console.log($(this).attr('data-value'));
			    $(this).closest('.dropdown').find('input.video_url_text').val($(this).attr('data-value'));
		  	});

		  	$('#scrap_video').click(function () {
		  		scrapVideo();
		  	});
		  	
		  	$("#keyword_txt").keyup(function (e) {
			  if (e.keyCode == 13) {
			    scrapVideo();
			  }
			})
		  	// scrapVideo();
		});

		function scrapVideo () {
	    	$(".progress-bar").animate({width: "0%"}, 10, null, function () {
	  			$(".progress-bar").animate({width: "100%"}, 30000);
	  		});

	  		$.get('../controller.php?flag=scrap_videos&site_url=' + $('.video_url_text').val(), function (response) {
	  			rows = eval(response);
	  			html = '';
	  			for (r in rows) {
	  				data = rows[r];
		  			html += '<tr>';
		                html += '<td class="text-center">' + (++ r) + '</td>';
		                html += '<td class="title">' + data['title'] + '</td>';
		                html += '<td class="description">' + data['description'] + '</td>';
		                html += '<td class="video_url text-center">';
		                	html += '<a href="#" data-toggle="modal" data-target="#videoModal" data-theVideo="' + data['video_url'] + '">';
		                		html += '<img src="' + data['thumbnail'] + '" alt="" class="img-responsive"/>';
		                	html += '</a>';
		                	html += '<span class="thumbnail hide">' + data['thumbnail'] + '</span>';
		                	html += '<span class="video_url_span hide">' + data['video_url'] + '</span>';
		                html += '</td>';
		                html += '<td class="text-center">';
		                	html += '<button type="button" onclick="saveVideo(this.parentNode.parentNode);" class="btn btn-primary">';
						      	html += '<span class="glyphicon glyphicon-floppy-disk"></span>';
						    html += '</button>';
		                html += '</td>';
		            html += '</tr>';
		        }
		        
		        $('#tbody').html(html);
		        
		        function autoPlayYouTubeModal() {
			      	var trigger = $("body").find('[data-toggle="modal"]');
			      	trigger.click(function () {
			          	var theModal = $(this).data("target"),
			              	videoSRC = $(this).attr("data-theVideo"),
			              	videoSRCauto = videoSRC + "?autoplay=1";
				          	$(theModal + ' iframe').attr('src', videoSRCauto);
				          	$(theModal + ' button.close').click(function () {
			              	$(theModal + ' iframe').attr('src', videoSRC);
		    	      	});
			      	});
			  	}
			  	autoPlayYouTubeModal();

		        $(".progress-bar").stop().animate({width: "100%"}, 100, null, function () {
		        	$(".progress-bar").stop();
		        	setTimeout(function () {
						$(".progress-bar").animate({width: "0%"}, 10);
			        }, 3000);
		        });
		        
	  		});
	    }

	    function saveVideo (rowObj) {
	    	if (confirm('Are you sure want to save this video to your database?')) {
	    		$.ajax({
					type: "POST",
					url: '../controller.php?flag=save_video',
					data: {
			    		title : $('.title', rowObj).html(),
			    		description : $('.description', rowObj).html(),
			    		thumbnail : $('.thumbnail', rowObj).html(),
			    		video_url : $('.video_url_span', rowObj).html()
		    		},
					success: function (response) {
					}
				});
	    	}
	    }
	</script>
</html>


