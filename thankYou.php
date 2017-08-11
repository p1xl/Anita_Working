<?php
require_once 'core/init.php';




\Stripe\Stripe::setApiKey(STRIPE_PRIVATE);

// Token is created using Stripe.js or Checkout!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
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
$description = ((isset($_POST['description'])&& $_POST['description'] != '')?sanitize($_POST['description']):'');
$charge_amount = number_format($grand_total,2) *100;
$metadata = array(
  "cart_id" => $cart_id,
  "tax" => $tax,
  "sub_total" => $sub_total,
);

// Charge the user's card:
try{
  $charge = \Stripe\Charge::create(array(
    "amount" => $charge_amount,
    "currency" => CURRENCY,
    "description" => $description,
    "source" => $token,
    "metadata" => $metadata,)
  );
  $db->query("UPDATE cart SET paid = 1 WHERE id = '$cart_id'");
  $db->query("INSERT INTO transactions
  (charge_id,cart_id,full_name,email,street,street2,parish,tax,sub_total,grand_total,description,txn_type) VALUES
  ('$charge->id','$cart_id'),'$full_name','$email','$street','$street2','$parish','$tax','$sub_total','$grand_total','$description','$charge->object'");

$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
setcookie(CART_COOKIE,'',1,"/",$domain,false);
include 'includes/head.php';
include 'includes/headerfull.php'
?>

<h1 class="text-center text-success">Thank You</h1>
<p> Your cart has been successfully charged <?=money($grand_total):?>. You have been emailed as receipt</p>
<p> Your reciept number is : <strong><?=$cart_id;?></strong></p>
<p> Your order will be shipped to the addres below.</p>
<addresss>
  <?=$full_name;?><br>
  <?=$street;?>
  <?=(($street2 != '')?$street2.'<br>':'');?>
  <?=$parish;?>

</address>

<?php
include 'includes/footer.php'
} catch(\Stripe\Error\Card $e){
  echo $e;
}



 ?>
