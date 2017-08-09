<?php
require_once './../../core/init.php';
$mode = isset($_POST['mode'])? sanitize($_POST['mode']):'';
$edit_id = isset($_POST['edit_id '])? sanitize($_POST['edit_id ']):'';
$cartQ= $db->query("SELECT * FROM cart WHERE id ='{$cart_id}'");
$result = mysqli_fetch_assoc($cartQ);
$items = json_decode($result['items'],true);
$updated_items=array();
$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;

if($mode == 'removeone'){
  foreach ($items as $item ) {
      $item['quantity'] =$item['quantity'] - 1;
      if($item['quantity'] > 0){
        $updated_items[] = $item;

          }

      }
}

else {
  foreach ($items as $item ) {
      $item['quantity'] = $item['quantity'] + 1;
      $updated_items[] = $item;
  }

}

if(!empty($updated_items)){
  $json_updated = json_encode($updated_items);
  $db->query("UPDATE cart SET items = '{$json_updated}' WHERE id = '{$cart_id}'");
  $_SESSION['success_flash']=  'Your cart has been updated';
  echo json_encode($json_updated);
  exit;
}
else {
  $db->query("DELETE FROM cart WHERE id = '{$cart_id}'");
  setcookie(CART_COOKIE,'',1,"/",$domain,false);
 }


 ?>
