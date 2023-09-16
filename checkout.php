<?php
include('functions/common_function.php');

$grand_total = 0;
$allItems = '';
$items = [];

$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $grand_total += $row['total_price'];
    $items[] = $row['ItemQty'];
    
}
$allItems = implode(', ', $items);
'<script>
console.log($items);
</script> '
?>

  <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sahil Kumar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Menu Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!-- Navbar start -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark" id="navbar-style">
        <a class="navbar-brand logo" href="index.php">&nbsp;&nbsp;Dine And <span>Divine</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
               
                <li class="nav-item">
                    <a class="nav-link active" href="Menu.php">Menu</a>
                </li>

                <?php
                    if(empty($_SESSION['uid'])) {
                        echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                            <li class="nav-item"><a href="register.php" class="nav-link active">Register</a> </li>';
                    } else {
                        echo  '<li class="nav-item"><a href="your-order.php" class="nav-link active">My Orders</a> </li>';
                        echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                    }
                ?>

                <form action="search-product.php" method="get">
                    <div class="d-flex search_product">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light btn-search" name="search_data_product">
                    </div>
                </form>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
                </li>


            </ul>
        </div>
    </nav>
    <!-- <h4 class="text-center mt-3"><i class="fas fa-th-list mr-2"></i>Categories</h4>
    <nav class="navbar navbar-expand-sm bg-light navbar-dark sticky-top justify-content-center">
        <ul class="navbar-nav cat-item">
            <li class="nav-item active">
                <?php  getcategory(); ?>
            </li>
        </ul>
    </nav> -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 px-4 pb-4" id="order">
                <h4 class="text-center text-info p-2">Complete your order!</h4>
                <div class="jumbotron p-3 mb-2 text-center">
                    <h6 class="lead"><b>Product(s) : </b><?= $allItems; ?></h6>
                    <h6 class="lead"><b>Delivery Charge : </b>Free</h6>
                    <h5><b>Total Amount Payable : </b><?= number_format($grand_total, 2) ?>/-</h5>
                </div>
                <form action="" method="post" id="placeOrder">
                    <input type="hidden" name="products" value="<?= $allItems; ?>">
                    <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
                   
                    <div class="form-group">
                        <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
                    </div>
                    <div class="form-group">
                        <textarea name="address" class="form-control" rows="3" cols="10" placeholder="Enter Delivery Address Here..."></textarea>
                    </div>
                    <h6 class="text-center lead">Select Payment Mode</h6>
                    <div class="form-group">
                        <select name="pmode" class="form-control">
                            <option value="" selected disabled>-Select Payment Mode-</option>
                            <option value="cod">Cash On Delivery</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Place Order" class="btn btn-danger btn-block" onclick="return confirm('Do you want to confirm the order?');">
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <?php 

include('includes/footer.php');

?>

    <script type="text/javascript">
        $(document).ready(function() {

            // Sending Form data to the server
            $("#placeOrder").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: $('form').serialize() + "&action=order",
                    success: function(response) {
                        $("#order").html(response);
                    }
                });
            });

            // Load total no.of items added in the cart and display in the navbar
            load_cart_item_number();

            function load_cart_item_number() {
                $.ajax({
                    url: 'action.php',
                    method: 'get',
                    data: {
                        cartItem: "cart_item"
                    },
                    success: function(response) {
                        $("#cart-item").html(response);
                    }
                });
            }
        });
    </script>
</body>

</html>