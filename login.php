<?php 
require_once 'core/init.php';
include('includes/web.php');

if(Input::exists()) {
  if(Token::check(Input::get('token'))) {

    $validate = new validate();
    $validation = $validate->check($_POST, array(
      'email_or_username' => array('required' => true),
      'password' => array('required' => true)
    ));

    if($validation->passed()) {
      $user = new User();
      $login = $user->login(Input::get('email_or_username'), Input::get('password'));

      if($login) {
        Redirect::to('index.php');
      }
    }
  }
}
?>
<!DOCTYPE html>
<html>
<?php include("includes/layouts/head.php");?>
<body>

<?php include("includes/layouts/navbar.php");?>

<div class="container mt-5">
  <?php
  if(isset($validation)) {
    foreach ($validation->errors() as $error) {
      echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
    }
  }
  if(isset($login)) {
    echo '<div class="alert alert-danger" role="alert">These credentials do not match our records</div>';
  }
  ?>
  <form method="post" action="login.php">
    <div class="form-group">
      <label for="email-username-input">Email address or username</label>
      <input type="text" class="form-control" id="email-username-input" name="email_or_username" value="<?php echo escape(Input::get('email_or_username')); ?>" autocomplete="off" >
    </div>
    <div class="form-group">
      <label for="password-input">Password</label>
      <input type="password" class="form-control" id="password-input" name="password" autocomplete="off" >
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>


</body>
</html>