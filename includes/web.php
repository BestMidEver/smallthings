<?php
	$user = new User();
	switch ($_SERVER["SCRIPT_NAME"]) {
		case "/st/login.php":
			if($user->isLoggedIn()) Redirect::to('index.php');
			$CURRENT_PAGE = "Login"; 
			$PAGE_TITLE = "Login";
			break;
		case "/st/register.php":
			if($user->isLoggedIn()) Redirect::to('index.php');
			$CURRENT_PAGE = "Register"; 
			$PAGE_TITLE = "Register";
			break;
		default:
			$CURRENT_PAGE = "Index";
			$PAGE_TITLE = "Home";
	}
?>