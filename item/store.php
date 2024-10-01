<?php
session_start();
include('../includes/config.php');
var_dump($_POST);
$_SESSION['cost'] = $_POST['cost_price'];
$_SESSION['sell'] = $_POST['sell_price'];
$_SESSION['desc'] = $_POST['description'];
$_SESSION['qty'] = $_POST['quantity'];
if(empty($_POST['description'])  ) {
    $_SESSION['descError'] = 'Please input a Product description';
    
    header("Location: create.php" );
  }
  if(empty($_POST['cost_price'])  ) {
    $_SESSION['costError'] = 'Please input a Product cost price';
    
    header("Location: create.php" );
  }

?>