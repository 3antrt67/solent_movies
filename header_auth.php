<?php
include "includes/database.php";
session_start();
	
	if(!isset($_SESSION['username'])) {
		header('Location: index.php');
	}
$query = "SELECT * FROM movies";
$final = $conn->query($query);
$counted = $final->rowCount();
?>
<head>
	<title>Solent Movies</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<meta charset="UTF-8">
	<script type="text/javascript" src="js/modal_clear.js"></script>
</head>
<div id="navbar-collapse" class="collapse navbar-collapse">
		<ul class="nav navbar-nav navbar-left">
			<img src="images/ssu-logo.svg">
		</ul>
		<ul class="nav nabar-nav navbar-left">
			<form action="process/search.php" method="GET">
			<label for="search_term">Search from:</label>
			<input name="search_term" type="text" placeholder="<?php echo $counted . " movie pages.."; ?>" />
			<input type="submit" name="search" value="Submit" />
			</form>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a class="latestRelease" href="#">New Releases</a>
			</li>
			<li>
				<a class="about" href="#">About</a>
			</li>
			<li>
				<a data-toggle="modal" class="createMoviemod" data-target="#createMovie">Create Page</a>
			</li>
			<li>
				<a href="process/logout.php">
				<span class="glyphicon glyphicon-log-out"></span> Logout</a>
			</li>
		</ul>
</div>

<div id="createMovie" class="modal fade" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h3>Create Page</h3>
		</div>
		<div class="modal-body">
			<form method="POST" action="process/create.php">
			<div class="form-group">
				<label class="sr-only" for="filmTitle">Title</label>
				<input type="text" class="form-control input" placeholder="Title" id="filmTitle" name="filmTitle">
			</div>
			<div class="form-group">
				<label class="sr-only" for="poster">Poster/Art</label>
				<input type="text" class="form-control input" placeholder="https://i.imgur.com/kRVWz0C.png" id="poster" name="poster">
				<small id="posterHelp" class="form-text text-muted">Please use the full image URL. E.G. https://imgur.com/PxySgh.png</small>
			</div>
			<div class="form-group">
				<label class="sr-only" for="directors">Director(s)</label>
				<input type="text" class="form-control input" placeholder="Director(s)" id="directors" name="directors">
			</div>
			<div class="form-group">
				<label class="sr-only" for="actors">Actor(s)</label>
				<input type="text" class="form-control input" placeholder="Actor(s)" id="actors" name="actors">
			</div>
			<div class="form-group">
				<label class="sr-only" for="releaseDate">Release Date - YYYY-MM-DD</label>
				<input data-format="yyyy/MM/dd" type="text" class="form-control input" placeholder="YYY-MM-DD" id="releaseDate" name="releaseDate">
			</div>
			<div class="form-group">
				<textarea class="form-control" id="synopsis" rows="6" name="synopsis"></textarea>
			</div>
			<br>
			<button type="submit" name="createPage" id="createPage" class="btn btn-success">Create</button>
			</br>
			</form>
		</div>
	</div>
	</div>
</div>
			
				
				
			