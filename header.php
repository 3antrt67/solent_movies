<div id="navbar-collapse" class="collapse navbar-collapse">
		<ul class="nav navbar-nav navbar-left">
			<img src="images/ssu-logo.svg">
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a class="latestRelease" href="#">New Releases</a>
			</li>
			<li>
				<a class="about" href="#">About</a>
			</li>
			<li>
				<a data-toggle="modal" class="login" data-target="#loginModal">
				<span class="glyphicon glyphicon-log-in"></span> Login</a>
			</li>
		</ul>
	</div>

<div id="loginModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4>Login</h4>
		</div>
		<div class="modal-body">
			<form action="process/login.php">
			<div class="form-group">
				<label class="sr-only" for="email">Email</label>
				<input type="email" class="form-control input-sm" placeholder="Email" id="email" name="email">
			</div>
			<div class="form-group">
			<label class="sr-only" for="password">Password</label>
			<input type="password" class="form-control input-sm" placeholder="Password" id="password" name="password">
			</div>
			<div class="checkbox">
				<label><input type="checkbox">Remember Me</label>
			</div>
			<button type="submit" class="btn btn-info">Sign In</button>
			</form>
			<br>
			<button type="button" class="btn btn-default" onClick="register_modal()" data-target="#registerModal">Not Registered?</button>
			</br>
		</div>
	</div>
	</div>
</div>

<div id="registerModal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<h4>Registration</h4>
		</div>
		<div class="modal-body">
			<form method="POST" action="process/register.php">
			<div class="form-group">
				<label class="sr-only" for="username">Username</label>
				<input type="text" class="form-control" placeholder="Username" id="username" name="username">
			</div>
			<div class="form-group">
				<input type="email" class="form-control" placeholder="Email" id="email_reg" name="email_reg">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Password" id="password_1" name="password_1">
			</div>
			<div class="form-group">
				<input type="password" class="form-control" placeholder="Please enter password again" id="password_2" name="password_2">
			</div>
			<div class="g-recaptcha" data-sitekey="6LfsN08UAAAAAHNwMkMpYpcL3gnZvmAhvsnY3WdZ"></div>
			<br>
			<button type="submit" class="btn btn-lg">Register</button>
			</br>
			</form>
		</div>
	</div>
	</div>
</div>
		