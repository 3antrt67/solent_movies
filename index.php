<?php include('header.php'); ?>
<body>
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
						<div class="item active">
							<img class="d-block img-fluid" src="https://res.cloudinary.com/dfv2t9quc/image/upload/v1521895123/Avengers-Infinity-War-poster-slice-2-700x300.webp" alt="First slide">
							<div class="carousel-caption d-none d-md-block">
								<h5>Avengers Infinity War</h5>
								<p>Our heroes face their greatest threat yet from across the cosmos.</p>
							</div>
						</div>
						<div class="item">
							<img class="d-block img-fluid" src="https://res.cloudinary.com/dfv2t9quc/image/upload/v1521895268/Ready-Player-One-poster-digital-addicts-VR-movie-poster.jpg" alt="Second slide">
							<div class="carousel-caption d-none d-md-block">
								<h5>Ready Player One</h5>
								<p>Steven Spielberg's encomium of gaming and pop culture revolves around a VR playground of the future.</p>
							</div>
						</div>
						<div class="item">
							<img class="d-block img-fluid" src="https://res.cloudinary.com/dfv2t9quc/image/upload/v1521895528/Bill-Murray-from-Isle-of-Dogs.jpg" alt="Third slide">
							<div class="carousel-caption d-none d-md-block">
								<h5>Isle of Dogs</h5>
								<p>The latest adventure from Wes Anderson involves an island of dogs and stop-frame animation.</p>
							</div>
						</div>
					</div>
					<a class="left carousel-control" href="#highlightIndicator" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#highlightIndicator" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="jumbotron" id ="searchResults">

		</div>
	</div>
	<div class="container">
	<iframe name="contact" style="display:none;"></iframe>
	<form method="POST" name="contactForm" role="form" action="process/contact.php" formenctype="multipart/form-data" class="contact-form row" target="contact" onSubmit="thanks_modal();return;">
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
		
</body>
</html>