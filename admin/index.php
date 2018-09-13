<?php
require_once dirname(__FILE__).'/../core/init.php';
	if(!is_logged_in()){
		header('Location : login.php');
	}
	include 'includes/head.php';
	include 'includes/navigation.php';

?>

<h1>Administrator</h1>

<?php
	include 'includes/footer.php';
