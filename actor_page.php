<?php
include "includes/database.php";
session_start();
	
	if(!isset($_SESSION['username'])) {
		header('Location: index.php');
	}
$actors_count = "SELECT * FROM actors";
$count = $conn->query($actors_count);
$act = $count->rowCount();
?>
<html>
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
	<div class="container">
	<nav class="navbar">
		<a class="navbar-brand" href="index_auth.php">
			<img src="images/ssu-logo.svg">
		</a>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a class="dash" href="dashboard.php">Dashboard</a>
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
</head>
<div class="container">
	<h2 class="page-header text-left">Search Actors:</h2>
		<div id="actors">
			<Input type="text" class="form-control" placeholder="<?php echo $act . " actor/actress pages.."; ?>" v-on:keyup.enter="searchActor" v-model="search.keyword"></Input>
				<div class="col-md-8 col-md-offset-2">
					<br/>
				<b-modal id="actorModal" ref="actorModal" title="Edit Actor" @ok="updateActor()" v-model="showActorModal">
				<b-form>
	    			<b-form-group id="nameInputGroup" label="Name:" label-for="nameInput">
	        			<b-form-input id="nameInput" type="text" v-model="clickPage.name"></b-form-input>
					</b-form-group>
					<b-form-group id="profileInputGroup" label="Profile Picture:" label-for="profileInput">
		    			<b-form-input id="profileInput" type="text" v-model="clickPage.profile"></b-form-input>
					</b-form-group>
					<b-form-group id="ageInputGroup" label="Age:" label-for="ageInput">
		    			<b-form-input id="ageInput" type="number" v-model="clickPage.age"></b-form-input>
					</b-form-group>
					<b-form-group id="bioInputGroup" label="Bio:" label-for="bioInput">
						<b-form-textarea id="bioInput" :rows="3" :max-rows="6" v-model="clickPage.bio"></b-form-textarea>
					</b-form-group>
				</b-form>
				</b-modal>
		<div class="alert alert-danger text-center" v-if="errorMessage">
			<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
			{{ errorMessage }}
		</div>
		<div class="alert alert-danger text-center" v-if="noActor">
			<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
			No actor has been found... Please try again.
		</div>
 		<div class="alert alert-success text-center" v-if="successMessage">
			<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
			{{ successMessage }}
		</div>
					<b-card-group deck v-for="actor in actors">
						<b-card v-bind:title="actor.name"
                        	v-bind:img-src="actor.profile"
                        	img-alt="Profile"
                        	img-top>
							<p>
								Age: {{ actor.age }}
							</p>
							<p>
								{{ actor.bio }}
							</p>
							<button class="btn btn-success" @click="showActorModal=true; selectActor(actor);">Edit Actor</button>
						</b-card>
					</b-card-group>
				</div>
		</div>
</div>
<script src="js/search_actors.js"></script>
