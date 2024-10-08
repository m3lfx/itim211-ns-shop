<?php
session_start();
include('includes/header.php');
include('includes/config.php');

if (isset($_POST["type"]) && $_POST["type"] == 'add' && $_POST["item_qty"] > 0) {
    foreach ($_POST as $key => $value) { //add all post vars to new_product array
        $new_product[$key] = $value;
    }
    unset($new_product['type']);
    $sql = "SELECT * FROM item where item_id = {$new_product['item_id']}";
    $result = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($result);
    echo "There are currently $num_rows rows in the table<P>";
    echo "<table border=1>\n";

    while ($row = mysqli_fetch_array($result)) {
        //fetch product name, price from db and add to new_product array
        $new_product["item_name"] = $row['description'];
        $new_product["item_price"] = $row['sell_price'];

        if (isset($_SESSION["cart_products"])) {  //if session var already exist
            if (isset($_SESSION["cart_products"][$new_product['item_id']])) //check item exist in products array
            {
                unset($_SESSION["cart_products"][$new_product['item_id']]); //unset old array item
            }
        }

        $_SESSION["cart_products"][$new_product['item_id']] = $new_product; //update or create product session with new item  

    }
    
}



if (isset($_POST["product_qty"]) || isset($_POST["remove_code"])) {
    var_dump($_POST["remove_code"]);
    //update item quantity in product session

    if (isset($_POST["product_qty"]) && is_array($_POST["product_qty"])) {

        foreach ($_POST["product_qty"] as $key => $value) {
            if (is_numeric($value)) {
                // var_dump( $key, $value);
                $_SESSION["cart_products"][$key]["item_qty"] = $value;
            }
        }
    }

    if (is_array($_POST["remove_code"])) {
        foreach ($_POST["remove_code"] as $key) {
            // var_dump($key);
            unset($_SESSION["cart_products"][$key]);
        }
    }
}
// print_r($new_product);
// echo "<pre>";
// print_r($_SESSION['cart_products']);
// //print_r($new_product);
// echo "</pre>";
header('Location: index.php');
?>
