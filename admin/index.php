<?php 
	require_once('../controller.php');

	$loggedIn = true;
	if ($loggedIn) {
		// header('Location: login.php');
	}

	// $allCount = getAllVideoCount("a");
?>
<!DOCTYPE html>
<html lang="en" ng-app="myApp">
	<head>
		<meta charset="utf-8">
		<title>Stored Videos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="../libs/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="../libs/bootstrap-datepicker/datepicker.css" rel="stylesheet">
		<link href="../libs/datatables-1.10.12/jquery.dataTables.min.css" rel="stylesheet">
		<link href="../libs/flaviusmatis-pagination/simplePagination.css" rel="stylesheet">
		<link href="../css/styles.css" rel="stylesheet">

		<script src="../libs/jquery-2.1.4.min.js"></script>
		<script src="../libs/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		<script src="../libs/flaviusmatis-pagination/jquery.simplePagination.js"></script>
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
					<div class="col-md-3 col-md-offset-7 menu-text">
						<a href="#" data-toggle="modal" data-target="#addModal">Add Video</a>
					</div>
					<div class="col-md-2 menu-text">
						<a href="../login.php">Log Out</a>
					</div>
				</div>			
				<div class="row content">
					<ul class="nav nav-tabs">
					  	<li class="active"><a>Stored Videos</a></li>
					  	<li><a href="scrap_videos.php">Scrap Videos</a></li>
					  	<!-- <li><a href="manage_users.php">Manage Users</a></li> -->
					</ul>

					<div class="tab-content">
					  	<div id="stored_videos" class="tab-pane fade in active">
					    	<div class="row">
					    		<table id="example" class="table" cellspacing="0" width="100%">
							        <thead>
							            <tr>
							                <th class="text-center">No</th>
							                <th class="text-center">Title</th>
							                <th class="text-center">Description</th>
							                <th class="text-center">Video</th>
							                <th class="text-center">Edit/Delete</th>
							            </tr>
							        </thead>
							        <tbody id="tbody"> </tbody>
							    </table>
							    <div class="custom-pagination"></div>
					    	</div>
					  	</div>

					  	<div id="get_videos" class="tab-pane fade">
					    	
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

		<!-- line modal -->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Add New Video Link</h3>
				</div>
				<div class="modal-body">
					
		            <!-- content goes here -->
					<form>
		              <div class="form-group">
		                <label for="title_txt">Video Title</label>
		                <input type="text" class="form-control" id="title_txt1" placeholder="Video Title">
		              </div>
		              <div class="form-group">
		                <label for="description_txt">Description</label>
		                <textarea rows=2 class="form-control" id="description_txt1" placeholder="Description"></textarea>
		              </div>
		              <div class="form-group">
		                <label for="description_txt">Video URL</label>
		                <input type="text" class="form-control" id="video_url_txt" placeholder="Video URL">
		              </div>
		            </form>

				</div>
				<div class="modal-footer">
					<div class="btn-group btn-group-justified" role="group" aria-label="group button">
						<div class="btn-group" role="group">
							<button type="button" id="saveImage" onclick="addVideoLink();" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
						</div>
					</div>
				</div>
			</div>
		  </div>
		</div>

		<!-- line modal -->
		<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
					<h3 class="modal-title" id="lineModalLabel">Edit Video Information</h3>
				</div>
				<div class="modal-body">
					
		            <!-- content goes here -->
					<form>
		              <div class="form-group">
		                <label for="title_txt">Video Title</label>
		                <input type="text" class="form-control" id="title_txt" placeholder="Video Title">
		              </div>
		              <div class="form-group">
		                <label for="description_txt">Description</label>
		                <textarea rows=4 class="form-control" id="description_txt" placeholder="Description"></textarea>
		              </div>
		            </form>

				</div>
				<div class="modal-footer">
					<div class="btn-group btn-group-justified" role="group" aria-label="group button">
						<div class="btn-group" role="group">
							<button type="button" id="saveImage" onclick="changeVideoInfo();" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
						</div>
						<div class="btn-group" role="group">
							<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
						</div>
					</div>
				</div>
			</div>
		  </div>
		</div>
	</body>
	<script type="text/javascript">
		$(document).ready(function() {
		    /*$('#example').DataTable({
		    	"searching": false,
		    	"ordering": false,
		    	"bFilter" : false,               
				"bLengthChange": false
		    });*/
		    
		    /*$('.custom-pagination').pagination({
		    	items: <?php echo $allCount; ?>, 
		    }).first().css({'float':'right'});*/

		    loadVideos();
		});

		function loadVideos () {
			url = '../controller.php?flag=get_stored_videos';
			url += '&pagenum=0';
			$.get(url, function (response) {
				rows = eval(response);
	  			html = '';
	  			for (r in rows) {
	  				data = rows[r];
		  			html += '<tr id="row_' + data['id'] + '">';
		                html += '<td class="text-center">' + (++ r) + '</td>';
		                html += '<td class="title">' + data['title'] + '</td>';
		                html += '<td class="description">' + data['description'] + '</td>';
		                html += '<td class="video_url text-center">';
		                	html += '<a href="#" data-toggle="modal" data-target="#videoModal" data-theVideo="' + data['video_url'] + '">';
		                		html += '<img src="' + data['thumbnail'] + '" alt="" class="img-responsive"/>';
		                	html += '</a>';
		                html += '</td>';
		                html += '<td class="text-center">';
		                	html += '<button onclick="editVideo(' + data['id'] + ')" data-toggle="modal" data-target="#editModal" class="btn btn-primary">';
						      	html += '<span class="glyphicon glyphicon-edit"></span>';
						    html += '</button> ';
		                	html += '<button onclick="deleteVideo(' + data['id'] + ');" class="btn btn-danger">';
						      	html += '<span class="glyphicon glyphicon-remove"></span>';
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
			});
		}

	    currVideoId = 0;
	    function editVideo (videoId) {
	    	currVideoId = videoId;
	    	row = $('#row_' + videoId);
	    	$('#title_txt').val($('.title', row).html());
	    	$('#description_txt').val($('.description', row).html());
	    }

	    function addVideoLink () {
	    	url = '../controller.php?flag=add_video_link';
	    	url += '&title=' + $('#title_txt1').val();
	    	url += '&description=' + $('#description_txt1').val();
	    	url += '&video_url=' + $('#video_url_txt').val();
    		$.get(url, function (response) {
    			location.reload();
    		});
	    }

	    function changeVideoInfo () {
	    	url = '../controller.php?flag=change_video_info&video_id=' + currVideoId;
	    	url += '&title=' + $('#title_txt').val();
	    	url += '&description=' + $('#description_txt').val();
    		$.get(url, function (response) {
    			location.reload();
    		});
	    }

	    function deleteVideo (videoId) {
	    	if (confirm('Are you sure want to delete this video?')) {
	    		$.get('../controller.php?flag=delete_video&video_id=' + videoId, function (response) {
	    			location.reload();
	    		});
	    	}
	    }

	    // https://datatables.net/reference/event/page
	</script>
</html>


