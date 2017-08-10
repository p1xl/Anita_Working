<?php
  require_once './../../core/init.php';
  $name = isset($_POST['full_name'])? sanitize($_POST['full_name']):'';
  $email = isset($_POST['email'])? sanitize($_POST['email']):'';
  $street = isset($_POST['street'])? sanitize($_POST['street']):'';
  $street2= isset($_POST['street2'])? sanitize($_POST['street2']):'';
  $parish = isset($_POST['parish'])? sanitize($_POST['parish']):'';
  $errors = array();
  $required = array(
    'full_name'=> 'Full Name',
    'email'    => 'Email',
    'street'   => 'Address Line 1',
    'parish'   => 'Parish'
   );

// check required fields

foreach ($required as $f => $d) {
  if(empty($_POST[$f]) || $_POST[$f] == ''){
    $errors[] = $d.' is required.';
  }
}

//check if valid addreess
if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
  $errors[] = 'Please enter a valid email.';
}
if(!empty($errors)){
  echo display_errors($errors);
}
  else {
    echo 'passed';
  }


?>
