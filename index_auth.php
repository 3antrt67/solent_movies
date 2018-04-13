<?php include('header_auth.php'); ?>
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<div id="highlightIndicator" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#highlightIndicator" data-slide-to="0" class="active"></li>
						<li data-target="#highlightIndicator" data-slide-to="1"></li>
						<li data-target="#highlightIndicator" data-slide-to="2"></li>
					</ol>
					<div class="carousel-inner" role="listbox">
						<div class="carousel-item active">
							<img class="d-block img-fluid" src="https://res.cloudinary.com/dfv2t9quc/image/upload/v1521895123/Avengers-Infinity-War-poster-slice-2-700x300.webp" alt="First slide">
							<div class="carousel-caption d-none d-md-block">
								<h5>Avengers Infinity War</h5>
								<p>Our heroes face their greatest threat yet from across the cosmos.</p>
							</div>
						</div>
						<div class="carousel-item">
							<img class="d-block img-fluid" src="https://res.cloudinary.com/dfv2t9quc/image/upload/v1521895268/Ready-Player-One-poster-digital-addicts-VR-movie-poster.jpg" alt="Second slide">
							<div class="carousel-caption d-none d-md-block">
								<h5>Ready Player One</h5>
								<p>Steven Spielberg's encomium of gaming and pop culture revolves around a VR playground of the future.</p>
							</div>
						</div>
						<div class="carousel-item">
							<img class="d-block img-fluid" src="https://res.cloudinary.com/dfv2t9quc/image/upload/v1521895528/Bill-Murray-from-Isle-of-Dogs.jpg" alt="Third slide">
							<div class="carousel-caption d-none d-md-block">
								<h5>Isle of Dogs</h5>
								<p>The latest adventure from Wes Anderson involves an island of dogs and stop-frame animation.</p>
							</div>
						</div>
					</div>
					<a class="carousel-control-prev" href="#highlightIndicator" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#highlightIndicator" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<br></br>
	<div class="container">
		<h2 id="top">Our Top Contributors:</h2>
		<div class="table-responsive">
			<div class="col-sm">
				<table class="table table-striped">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Username</th>
							<th scope="col">No. of Movies</th>
						</tr>
					</thead>
					<tbody>
					<?php
					$page_count = "SELECT created_by, COUNT(created_time) AS posts FROM `movies` WHERE created_by is not null group by created_by ORDER BY `posts` DESC LIMIT 10";
					$ex = $conn->query($page_count);
					$users = array();
					$a = 1;
					while($user = $ex->fetch()) $users[] = $user;
					foreach($users as $u) {
						echo "<tr>";
						printf("<td>%d</td>", $a++);
						printf("<td>%s</td>", $u[0]);
						printf("<td>%d</td>", $u[1]);
						echo "</tr>";
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<br></br>
	<div class="container">
    <h2 class="page-header text-left">Search Movie database:</h2>
        <div id="movies">
		<div class="alert alert-danger text-center" v-if="errorMessage">
			<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
			{{ errorMessage }}
		</div>
		<div class="alert alert-danger text-center" v-if="noMovie">
			<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
			No movie has been found... Please try again.
		</div>
 		<div class="alert alert-success text-center" v-if="successMessage">
			<button type="button" class="close" @click="clearMessage();"><span aria-hidden="true">&times;</span></button>
			{{ successMessage }}
		</div>
		</br>
		<input type="text" class="form-control" placeholder="<?php echo $counted . " movie pages.."; ?>" v-on:keyup.enter="searchMonitor" v-model="search.keyword">
		</br>
            <div class="col-md-8 col-md-offset-2">
                <b-card-group deck v-for="movie in movies">
                    <b-card v-bind:title="movie.name"
                            v-bind:img-src="movie.poster"
                            img-alt="Poster"
                            img-top>
                        <p>
                            {{ movie.synopsis }}
                        </p>
                        <p>
                            Director(s): {{ movie.director }}
                        </p>
                        <p>
                            Actor(s): {{ movie.actor }}
						</p>
						<button class="btn btn-success" @click="showEditModal = true; selectMember(member);">Edit Page</button>
                        <div slot="footer">
                            <small class="text-muted">Created by: {{ movie.created_by }} at {{ movie.created_time }}</small>
                        </div>
                    </b-card>
            	</b-card-group>
        	</div>
		</div>
	</div>
	<div class="container">
	<iframe name="contact" style="display:none;"></iframe>
	<form method="POST" name="contactForm" role="form" action="process/contact.php" formenctype="multipart/form-data" class="contact-form row" target="contact" onSubmit="show_modal();return;">
		<div class="form-group">
			<h3>Would you like to get in touch?</h3>
			<label for="name">Name</label>
			<input type="text" name="name" class="form-control" id="name" placeholder="Please enter your name">
		</div>
		<div class="form-group">
			<label for="message">Please tell me about your query.</label>
			<textarea class="form-control" id="message" rows="4" name="message"></textarea>
		</div>
		<button type="submit" name="submit" id="submit" value="Send" class="btn btn-primary">Submit</button>
	</form>
	</div>
<div class="modal fade" id="thanksModal" tabindex="-1" role="dialog">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4 class="modal-title" id="modalLabel">Thanks for getting in contact!</h4>
		</div>
		<div class="modal-body">
			<p>I will endeavour to be in touch as soon as possible!</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal" onclick="clear_form()">Close</button>
		</div>
	</div>
</div>
</div>
<div class="modal fade" id="filmModal" tabindex="-1" role="dialog">
<div class="modal-dialog">
	<div class="modal-header">
		<h3 class="modal-title" id="filmLabel"></h4>
	</div>
	<div class="modal-body" id="filmBody">
	
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" id="modifyPage">Modify Page</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
</div>
</div>
<script src="js/search_vue.js"></script>
</body>
</html>