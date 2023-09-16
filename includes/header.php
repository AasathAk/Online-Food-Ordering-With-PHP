<!-- <!DOCTYPE html>
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
    <h4 class="text-center mt-3"><i class="fas fa-th-list mr-2"></i>Categories</h4>
    <nav class="navbar navbar-expand-sm bg-light navbar-dark sticky-top justify-content-center">
        <ul class="navbar-nav cat-item">
            <li class="nav-item active">
                <?php  getcategory(); ?>
            </li>
        </ul>
    </nav> -->
