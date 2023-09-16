<?php
session_start();
include('functions/common_function.php');
// include('includes/header.php');
?>

<?php
if (isset($_POST['delete_order_btn'])) {
    $id = $_POST['delete_id'];

    $query_del = "DELETE FROM `orders` WHERE id='$id' ";
    $query_run_del = mysqli_query($conn, $query_del);

    if ($query_run_del) {
        $_SESSION['showAlert'] = 'block';
        $_SESSION['success'] = "Order Deleted Successfully";
        header('location:your-order.php');
    } else {
        $_SESSION['showAlert'] = 'block';
        $_SESSION['error'] = "Order not Deleted";
        header('location:your-order.php');
    }
}
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
                    if(empty($_SESSION["uid"])) {
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


<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">All Orders </h4>
        </div>

        <div class="card-body">

            <!-- Session message start -->
            <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                                    echo $_SESSION['showAlert'];
                                } else {
                                    echo 'none';
                                }
                                unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php if (isset($_SESSION['success'])) {
                            echo $_SESSION['success'];
                        }
                        unset($_SESSION['showAlert']); ?></strong>
            </div>

            <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                                    echo $_SESSION['showAlert'];
                                } else {
                                    echo 'none';
                                }
                                unset($_SESSION['showAlert']); ?>" class="alert alert-danger alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php if (isset($_SESSION['error'])) {
                            echo $_SESSION['error'];
                        }
                        unset($_SESSION['showAlert']); ?></strong>
            </div>


            <div style="display:<?php if (isset($_SESSION['Alert'])) {
                                    echo $_SESSION['Alert'];
                                } else {
                                    echo 'none';
                                }
                                unset($_SESSION['showAlert']); ?>" class="alert alert-warning alert-dismissible mt-2">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong><?php if (isset($_SESSION['status'])) {
                            echo $_SESSION['status'];
                        }
                        unset($_SESSION['Alert']); ?></strong>
            </div>


            <!-- Session message end -->

            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-dark text-light">
                        <tr>
                            <th class="text-center"> ID </th>
                            <th class="text-center">Username </th>
                            <th class="text-center">Products</th>
                            <th class="text-center">Total Price</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Order-date</th>
                            <th class="text-center">Actions </th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        if (isset($_SESSION["uid"])) {
                            $userid = $_SESSION["uid"];
                            $query = "SELECT * FROM `orders` where uid='$userid'";
                            $query_run = mysqli_query($conn, $query);

                            $select_query2 = "SELECT username FROM users WHERE uid = '$userid'";
                            $result2 = mysqli_query($conn, $select_query2);
                            $row2 = mysqli_fetch_assoc($result2);

                            $username = isset($row2['username']) ? $row2['username'] : '';

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    $status = $row['status'];
                        ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo  $username ?></td>
                                        <td><?php echo $row['products']; ?></td>
                                        <td><?php echo $row['amount_paid']; ?>/-</td>
                                        <?php
                                        if ($status == "0" or $status == "NULL") {
                                        ?>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-info">
                                                    <span class="fa fa-bars" aria-hidden="true"></span> Dispatch
                                                </button>
                                            </td>
                                        <?php
                                        } else if ($status == "in process") {
                                        ?>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-warning">
                                                    <span class="fa fa-cog fa-spin" aria-hidden="true"></span> On a Way!
                                                </button>
                                            </td>
                                        <?php
                                        } else if ($status == "closed") {
                                        ?>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-primary">
                                                    <span class="fa fa-check-circle" aria-hidden="true"></span> Delivered
                                                </button>
                                            </td>
                                        <?php
                                        } else if ($status == "rejected") {
                                        ?>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-danger">
                                                    <i class="fa fa-close"></i> Cancelled
                                                </button>
                                            </td>
                                        <?php
                                        } else {
                                        ?>
                                            <td class="text-center">Unknown Status</td>
                                        <?php
                                        }
                                        ?>
                                        <td><?php echo $row['date']; ?></td>
                                        <td>
                                            <form action="your-order.php" method="post">
                                                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete_order_btn" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel your order?');">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                        <?php
                                }
                            } else {

                                echo
                                "
                                            <tr>
                                            <td colspan='8' class='text-center'>No Record Found</td>
                                            </tr>
                                        ";
                            }
                        }
                        ?>





                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php

include('includes/footer.php');

?>