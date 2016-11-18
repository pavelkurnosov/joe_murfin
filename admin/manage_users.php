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
		<title>User Management</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="libs/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="libs/bootstrap-datepicker/datepicker.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">

		<script src="libs/jquery-2.1.4.min.js"></script>
		<script src="libs/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

	</head>
	<body>
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="row logo">
					<a href="index.php">
						<img src="imgs/logo.png" class="img-responsive" alt="Responsive image">
					</a>
				</div>
				<div class="row header">
					<div class="col-md-2 col-md-offset-10 menu-text">
						<a href="login.php">Log Out</a>
					</div>
				</div>			
				<div class="row content">
					<ul class="nav nav-tabs">
					  	<li><a href="stored_videos.php">Stored Videos</a></li>
					  	<li><a href="scrap_videos.php">Scrap Videos</a></li>
					  	<li class="active"><a>Manage Users</a></li>
					</ul>

					<div class="tab-content">
					  	<div id="stored_videos" class="tab-pane fade">
					    
					  	</div>

					  	<div id="get_videos" class="tab-pane fade">
					    	
					  	</div>

					  	<div id="manage_users" class="tab-pane fade in active">
					    	<table id="users_table"></table>
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
	</body>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#users_table').DataTable();
		});

		function editUser (userId) {
	    	alert('added 1 video in your database.');
	    }

	    function deleteUser (userId) {
	    	confirm('Are you sure want to delete this user?');
	    }

	    // https://datatables.net/reference/event/page
	</script>
</html>


