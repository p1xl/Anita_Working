<?php
require_once dirname(__FILE__).'/../core/init.php';
include 'includes/head.php';

$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors = array();


?>
<style>
body{
  background-image: url(/anita/images/headerlogo/background.png);
  background-size: 100vw 100vw;
  background-attachment: fixed;
}
</style>
<div id ="login-form">
  <div>

    <?php

      if($_POST){
        //form validation
        if(empty($_POST['email']) || empty($_POST['password'])){
          $errors[] = 'You must provide an email and a password.';
        }

        // validate email
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
          $errors[]= 'You must enter a valid email.';
        }
        //password is more than 6 chars
        if(strlen($password) <4){
          $errors[]= 'Password must be atleast 4 characters.';
        }

        // check database for email
      $query = $db->query("SELECT * FROM users WHERE email ='$email'");
      $user = mysqli_fetch_assoc($query);
      $userCount = mysqli_num_rows($query);
      if($userCount < 1){
        $errors[] = 'That email doesn\'t exist in our datatbase.';
      }

      if(!password_verify($password,$user['password'])){
        $errors[] = 'Password doesn\'t match our records pleas try again';
      }

          //check errors
          if(!empty($errors)){
            echo display_errors($errors);
        }else{
              // log in user
              $user_id = $user['id'];
              login($user_id);

        }

      }

     ?>


  </div>
  <h2 class="text-center">Login</h2><hr>
  <form action="login.php" method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type ="email" name="email" id="email" class="form-control" value="<?=$email;?>">
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type ="password" name="password" id="password" class="form-control" value="<?=$password;?>">
    </div>
    <div class="form-group">
      <input type="submit" name="" value="Login" class="btn btn-primary">
    </div>
      </form>
      <p class ="text-right"><a href="/anita/index.php" alt="home">Vist Site</a></p>
</div>
<?php include 'includes/footer.php' ;?>
