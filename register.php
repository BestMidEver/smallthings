<?php 
require_once 'core/init.php';
include('includes/web.php');

if(Input::exists()) {
  if(Token::check(Input::get('token'))) {
    $validate = new validate();
    $validation = $validate->check($_POST, array(
      'username' => array(
        'required' => true,
        'min' => 2,
        'max' => 20,
        'unique' => 'users'
      ),
      'first_name' => array(
        'required' => true,
        'max' => 50
      ),
      'last_name' => array(
        'required' => true,
        'max' => 50
      ),
      'mobile' => array(
        'required' => true
      ),
      'email' => array(
        'required' => true,
        'max' => 100,
        'unique' => 'users'
      ),
      'password' => array(
        'required' => true,
        'min' => 6
      ),
      'password_confirm' => array(
        'required' => true,
        'matches' => 'password'
      ),
    ));
    
    if($validation->passed()) {
      $user = new User();

      $salt = Hash::salt(32);

      try {
        $user->create(array(
          'username' => Input::get('username'),
          'first_name' => Input::get('first_name'),
          'last_name' => Input::get('last_name'),
          'email' => Input::get('email'),
          'mobile' => Input::get('mobile'),
          'password' => Hash::make(Input::get('password'), $salt),
          'salt' => $salt
        ));

        Session::flash('home', 'You have been registered and can now log in!');
        Redirect::to('index.php');

      } catch(Exception $e) {
        die($e->getMessage());
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
  ?>
  <form method="post" action="register.php">
    <div class="form-group">
      <label for="user-name-input">Username</label>
      <input type="text" class="form-control" id="user-name-input" name="username" value="<?php echo escape(Input::get('username')); ?>" autocomplete="off" >
    </div>
    <div class="form-group">
      <label for="first-name-input">First name</label>
      <input type="text" class="form-control" id="first-name-input" name="first_name" value="<?php echo escape(Input::get('first_name')); ?>" autocomplete="off" >
    </div>
    <div class="form-group">
      <label for="last-name-input">Last name</label>
      <input type="text" class="form-control" id="last-name-input" name="last_name" value="<?php echo escape(Input::get('last_name')); ?>" autocomplete="off" >
    </div>
    <div class="form-group">
      <label for="email-input">Email address</label>
      <input type="email" class="form-control" id="email-input" name="email" value="<?php echo escape(Input::get('email')); ?>" autocomplete="off" >
    </div>
    <div class="form-group">
      <label for="mobile-input">Mobile</label>
      <input type="text" class="form-control" id="mobile-input" name="mobile" value="<?php echo escape(Input::get('mobile')); ?>" autocomplete="off" >
    </div>
    <div class="form-group">
      <label for="password-input">Password</label>
      <input type="password" class="form-control" id="password-input" name="password" autocomplete="off" >
    </div>
    <div class="form-group">
      <label for="confirmation-input">Confirm password</label>
      <input type="password" class="form-control" id="confirmation-input" name="password_confirm" autocomplete="off" >
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <button type="submit" class="btn btn-primary">Register</button>
  </form>
</div>


</body>
</html>