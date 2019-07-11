<nav class="navbar navbar-expand navbar-light bg-light">
  <div class="container">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item <?php if ($CURRENT_PAGE == 'Index') echo 'active'; ?>">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <?php 
        $user = new User();
        if($user->isLoggedIn()) {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Log out</a>
        </li>
        <?php } else { ?>
        <li class="nav-item <?php if ($CURRENT_PAGE == 'Login') echo 'active'; ?>">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item <?php if ($CURRENT_PAGE == 'Register') echo 'active'; ?>">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <?php } ?>
      </ul>
  </div>
</nav>