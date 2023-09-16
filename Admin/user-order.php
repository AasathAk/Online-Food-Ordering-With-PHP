<?php
include('includes/header.php');
include('includes/navbar.php');
include('../Dbconnect/config.php');

?>

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
                            <th class="text-center">Address</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Order-date</th>
                            <th colspan="2" class="text-center">Actions </th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php



                        $sql = "SELECT users.*, orders.* FROM users INNER JOIN orders ON users.uid=orders.uid ";
                        $query = mysqli_query($conn, $sql);

                        if (!mysqli_num_rows($query) > 0) {
                            echo
                            "
                            <tr>
                            <td colspan='8' class='text-center'>No Record Found</td>
                            </tr>
                        ";
                        } else {
                            while ($row = mysqli_fetch_assoc($query)) {
                                $status = $row['status'];

                        ?>

                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['username'] ?></td>
                            <td><?php echo $row['products']; ?></td>
                            <td><?php echo $row['amount_paid']; ?>/-</td>
                            <td><?php echo $row['address']; ?></td>
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
                                <form action="view-order.php" method="post">
                                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="edit_btn" class="btn btn-success">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="code.php" method="post">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete_order_btn" class="btn btn-danger">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
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
include('includes/scripts.php');
include('includes/footer.php');
?>