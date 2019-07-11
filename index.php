<?php 
require_once 'core/init.php';
include('includes/web.php');
?>
<!DOCTYPE html>
<html>
<?php include("includes/layouts/head.php");?>
<body>

<?php include("includes/layouts/navbar.php");?>


<div class="container">
	<?php
	if(Session::exists('home')) {
		echo '<div class="alert alert-success" role="alert">' . Session::flash('home') . '</div>';
	}

	$user = new User();
	if($user->isLoggedIn()) {
		echo '<div class="jumbotron mt-4">';
		echo '<h1 class="display-4">Your user data is below</h1>';
		echo '<hr class="my-4">';
		foreach ($user->data('public') as $column => $value) {
			if (!in_array($column, array('password', 'salt'))){
				echo "<p class=\"lead\"><b>{$column}:</b> {$value}</p>";
			}
		}
		echo '</div>';
	} else {
	?>
	<div class="jumbotron mt-4">
		<h1 class="display-4">Welcome</h1>
		<p class="lead">Please login in order to use this website.</p>
	</div>
	<?php
	}
	?>
</div>


</body>
</html>