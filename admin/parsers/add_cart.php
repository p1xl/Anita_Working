<?php
 require_once './../../core/init.php';
 require_once './../../core/Database.php';

 $product_id = isset($_POST['product_id'])? sanitize($_POST['product_id']):'';
 $quantity = isset($_POST['quantity'])? sanitize($_POST['quantity']):'';
 echo $product_id and $quantity ;
 $item = array();
 $item[] = array(
  'id'       =>$product_id,
  'quantity' =>$quantity,
 );
 $domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
 $domain = '';
 $query = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
 $product = mysqli_fetch_assoc($query);
 $_SESSION['success_flash'] = $product['title'].' Was Added To Your Cart';
 // $test_cart=("INSERT INTO cart (items,expire_date) VALUES ('item','1/2/3/4')");
 // $db->query($test_cart);





 // to do code check if the cart cookie exist
 // if($cart_id != ''){
 //
 //
 // }
 //   else
 // {
  //to do code set cookiess
  $items_json = json_encode($item);
  $cart_expire = date("Y-m-d H:i:s",strtotime("+30 days"));
  $result = Database::getInstance()->query("INSERT INTO cart (items,expire_date) VALUES ('{$items_json}','{$cart_expire}')");
  var_dump($result);
  echo $result;
  // if(!$result) {
  //   echo var_dump($db);
  //  }

  // $cart_id = $db->insert_id;
  setcookie(CART_COOKIE,$cart_id,CART_COOKIE_EXPIRE,'/',$domain,false);
 // }
 $_SESSION['success_flash'];
?>﻿
