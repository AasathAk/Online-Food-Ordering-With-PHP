<?php
// session_start();
include('includes/header.php');
include('includes/navbar.php');
include('../Dbconnect/config.php');
?>



<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-dark text-light">
            <h3 class="m-0 font-weight-bold text-center"> View order </h3>
        </div>
        <div class="card-body">

            <div class="table-responsive">


                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>

                        <?php
                        if(isset($_POST['edit_id']))
                        {
                        $o_id=$_POST['edit_id'];

                        $query = "SELECT users.username, orders.* FROM users INNER JOIN
                         orders ON users.uid = orders.uid WHERE orders.id = $o_id";
                        $query_run = mysqli_query($conn, $query);

                   

                        $rows=mysqli_fetch_assoc($query_run);
                        ?>

                        <tr>
                            <td><strong>Username:</strong></td>
                            <td class="text-center">
                                <?php echo $rows['username']; ?>
                            </td class="text-center">
                        </tr>
                        <tr>
                            <td><strong>Products:</strong></td>
                            <td class="text-center">
                                <?php echo $rows['products']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Total Price:</strong></td>
                            <td class="text-center">
                                Rs <?php echo $rows['amount_paid']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Address:</strong></td>
                            <td class="text-center">
                                <?php echo $rows['address']; ?>
                            </td>


                        </tr>
                        <tr>
                            <td><strong>Date:</strong></td>
                            <td class="text-center">
                                <?php echo $rows['date']; ?>
                            </td>


                        </tr>
                        <tr>
                            <td><strong>Status:</strong></td>
                            <?php
                            $status = $rows['status'];
                            if ($status == "" or $status == "NULL") {
                            ?>
                            <td class="text-center">
                                <button type="button" class="btn btn-info">
                                    <span class="fa fa-bars" aria-hidden="true">
                                    </span> Dispatch</button>
                            </td>
                            <?php
                            }
                            if ($status == "in process") { ?>
                            <td class="text-center">
                                <button type="button" class="btn btn-warning">
                                    <span class="fa fa-cog fa-spin" aria-hidden="true">
                                    </span>On a Way!</button>
                            </td>
                            <?php
                            }
                            if ($status == "closed") {
                            ?>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary">
                                    <span class="fa fa-check-circle" aria-hidden="true">
                                    </span> Delivered</button>
                            </td>
                            <?php
                            }
                            ?>
                            <?php
                            if ($status == "rejected") {
                            ?>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger">
                                    <i class="fa fa-close"></i> Cancelled</button>
                            </td>
                            <?php
                            }
                            ?>


                        </tr>

                    </tbody>

                    <?php 
                        }
                        ?>

                </table>

            </div>
            </form>

            <div class="align-item-center d-flex">
                <form action="update-order-status.php?form_id=<?php echo($rows['id']);?>" method='post'>

                    <button type='submit' name='delete_pro_btn' class='btn btn-primary mx-2'>Update Order</button>
                </form>
                <a href="user-order.php" class='btn btn-danger '>Back</a>
            </div>


        </div>
    </div>
</div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>