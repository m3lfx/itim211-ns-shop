<?php
session_start();
include('../includes/header.php');
include('../includes/config.php');
// include('../include/alert.php');
// var_dump($_SESSION);
?>

<body>
    <div class="container">

        <form method="POST" action="store.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Item Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter item name" name="description"  />

                <label for="cost">Cost Price</label>

                <input type="text" class="form-control" id="cost" placeholder="Enter item cost price" name="cost_price" required >

                <label for="sell">sell price</label>

                <input type="text" class="form-control" id="sell" placeholder="Enter sell price" name="sell_price" required >

                <label for="qty">quantity</label>

                <input type="number" class="form-control" id="qty" placeholder="1" name="quantity" />
                <input class="form-control" type="file" name="img_path" /><br />
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="index.php" role="button" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
<?php
include('../includes/footer.php');
?>