<?php
include "includes/database.php";
session_start();
	
	if(!isset($_SESSION['username'])) {
		header('Location: index.php');
	}
$query = "SELECT * FROM movies";
$final = $conn->query($query);
$counted = $final->rowCount();
$actors_count = "SELECT * FROM actors";
$count = $conn->query($actors_count);
$act = $count->rowCount();
?>
<head>
	<title>Solent Movies</title>
	<meta charset-"utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-117697579-1"></script>
	<script>
  	window.dataLayer = window.dataLayer || [];
  	function gtag(){dataLayer.push(arguments);}
  	gtag('js', new Date());

  	gtag('config', 'UA-117697579-1');
	</script>
	<link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<link type="text/css" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="https://unpkg.com/vue"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/babel-polyfill@latest/dist/polyfill.min.js"></script>
    <script src="https://unpkg.com/bootstrap-vue@latest/dist/bootstrap-vue.js"></script>
	<script type="text/javascript" src="js/modal_clear.js"></script>
	<link rel="stylesheet" href="style/index.css" type="text/css"/>
</head>
<body>
<div class="container">
	<nav class="navbar">
		<a class="navbar-brand" href="#">
			<img src="images/ssu-logo.svg">
		</a>
		<ul class="nav navbar-nav navbar-left" id="searchWin">
			<label for="search_term">Search from:</label>
			<input id="search_term" name="search_term" type="text" placeholder="<?php echo $counted . " movie pages.."; ?>" />
			<input type="submit" id="searchMov" name="searchMov" value="Submit" />
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a class="dash" href="dashboard.php">Dashboard</a>
			</li>
			<li>
				<a class="actors" href="actor_page.php">Search Actors</a>
			<li>
				<a href="#" data-toggle="modal" data-target="#createActor" v-on:click="showActorModal = true">Create Actor</a>
			</li>
			<li>
				<a href="#createMovie" data-toggle="modal" data-target="#createMovie">Create Film</a>
			</li>
			<div class="dropdown">
				<button class="btn btn-secondary dropdown-toggle" id="navbarDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<?php if(isset($_SESSION['username'])) : ?>	
						Hello <strong><?php echo $_SESSION['username']; ?></strong>
					<?php endif ?>
				</button>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="process/change_password.php">Change Password</a>
					<a class="dropdown-item" href="#">My Films</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="process/logout.php">Logout</a>
				</div>
			</div>
		</ul>
	</nav>
</div>
<div id="createMovie" class="modal fade" role="dialog" tabindex="-1">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<h3>Create Page</h3>	
			<button type="button" class="close" data-dismiss="modal">&times;</button>
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
				<input data-format="yyyy/MM/dd" type="text" class="form-control input" placeholder="YYYY-MM-DD" id="releaseDate" name="releaseDate">
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
<div id="createActor" class="modal fade" role="dialog" tabindex="-1">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Create Actor Page</h3>	
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger text-center" v-if="errorMessage">
					<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
					{{ errorMessage }}
				</div>
				<div class="alert alert-success text-center" v-if="successMessage">
					<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
					{{ successMessage }}
				</div>
				<div class="form-group">
					<input type="text" class="form-control input" placeholder="Name" id="actorName" name="actorName" v-model="actor.name">
				</div>
				<div class="form-group">
					<input type="text" class="form-control input" placeholder="https://i.imgur.com/kRVWz0C.png" id="actorProfile" name="actorProfile" v-model="actor.profile">
					<small id="profileHelp" class="form-text text-muted">Please use the full image URL. E.G. https://imgur.com/PxySgh.png</small>
				</div>	
				<div class="form-group">
					<input class="form-control input" type="text" placeholder="Age" id="actorAge" name="actorAge" v-model="actor.age">
				</div>
				<div class="form-group">
					<textarea class="form-control input" placeholder="Bio" id="actorBio" rows="5" name="actorBio" v-model="actor.bio"></textarea>
				</div>
				<br>
				<button type="submit" name="createActor" id="createActor" class="btn btn-success" v-on:click="createPage();">Create</button>
				</br>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="create_actor_vue.js"></script>
			
				
				
			