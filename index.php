<!DOCTYPE html>
<head>
	<title>Solent Movies</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<meta charset="UTF-8">
	<script type="text/javascript" src="js/modal_clear.js"></script>
</head>
<?php include('header.php'); ?>
<body>
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
<div class="modal fade" id="thanksModal" tabindex="-1" role="dialog">
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="modalLabel">Thanks for getting in contact!</h4>
		</div>
		<div class="modal-body">
			<p>I will endeavour to be in touch as soon as possible!</p>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>
</div>
		
</body>
</html>