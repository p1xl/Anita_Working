<?php
require_once 'core/init.php';





// Token is created using Stripe.js or Checkout!
// Get the payment token ID submitted by the form:

// post data
$full_name = ((isset($_POST['full_name'])&& $_POST['full_name'] != '')?sanitize($_POST['full_name']):'');
$email = ((isset($_POST['email'])&& $_POST['email'] != '')?sanitize($_POST['email']):'');
$street = ((isset($_POST['street'])&& $_POST['street'] != '')?sanitize($_POST['street']):'');
$street2= ((isset($_POST['street2'])&& $_POST['street2'] != '')?sanitize($_POST['street2']):'');
$parish = ((isset($_POST['parish'])&& $_POST['parish'] != '')?sanitize($_POST['parish']):'');
$tax = ((isset($_POST['tax'])&& $_POST['tax'] != '')?sanitize($_POST['tax']):'');
$sub_total= ((isset($_POST['sub_total'])&& $_POST['sub_total'] != '')?sanitize($_POST['sub_total']):'');
$grand_total = ((isset($_POST['grand_total'])&& $_POST['grand_total'] != '')?sanitize($_POST['grand_total']):'');
$cart_id = ((isset($_POST['cart_id'])&& $_POST['cart_id'] != '')?sanitize($_POST['cart_id']):'');


  $db->query("UPDATE cart SET paid = 1 WHERE id = '$cart_id'");
  $db->query("INSERT INTO transactions
  (cart_id,full_name,email,street,street2,parish,tax,sub_total,grand_total) VALUES ({'$cart_id}','{$full_name}','{$email}','{$street}','{$street2}','{$parish}','{$tax}','{$sub_total}','{$grand_total}'");

$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
setcookie(CART_COOKIE,'',1,"/",$domain,false);
include 'includes/head.php';
include 'includes/headerfull.php';
include 'includes/navigation.php';
?>

<h1 class="text-center text-success">Thank You</h1>
<p> Your cart has been successfully charged and you have been emailed a receipt</p>
<p> Your order will be delivered to the address below.</p>
<addresss>
  <?=$full_name;?><br>
  <?=$street;?>
  <?=(($street2 != '')?$street2.'<br>':'');?>
  <?=$parish;?>

</address>

<?php
include 'includes/footer.php'



 ?>
