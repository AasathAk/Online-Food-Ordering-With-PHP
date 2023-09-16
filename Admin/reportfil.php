<?php
include('includes/header.php');
include('includes/navbar.php');
include('../Dbconnect/config.php');

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Order Details Filtering</h4>
                </div>
                <div class="card-body">

                    <form action="" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>From Date</label>
                                    <input type="date" name="from_date" value="<?php if (isset($_GET['from_date'])) {
                                                                                    echo $_GET['from_date'];
                                                                                } ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>To Date</label>
                                    <input type="date" name="to_date" value="<?php if (isset($_GET['to_date'])) {
                                                                                    echo $_GET['to_date'];
                                                                                } ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Click to Filter</label> <br>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>View Report</label> <br>
                                    <a href="pdf.php" class="btn btn-secondary">Report</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <table class="table table-borderd">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Products</th>
                                <th>Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                                $from_date = $_GET['from_date'];
                                $to_date = $_GET['to_date'];
                            
                                $query = "SELECT orders.id, users.username, users.email, orders.products, orders.amount_paid
                                          FROM orders
                                          INNER JOIN users ON orders.uid = users.uid
                                          WHERE orders.date BETWEEN '$from_date' AND '$to_date'";
                                $result = mysqli_query($conn, $query);
                            
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                        <tr>
                                            <td><?= $row['id']; ?></td>
                                            <td><?= $row['username']; ?></td>
                                            <td><?= $row['email']; ?></td>
                                            <td><?= $row['products']; ?></td>
                                            <td><?= $row['amount_paid']; ?></td>
                                            <td><a href="pdf.php?order_id=<?php echo $row['id'];?>" class="btn btn-secondary">view online</a></td>
                                        </tr>
                            <?php
                                    }
                                } else {
                                    echo "No Record Found";
                                }
                            }
                            
                            ?>


                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
</div>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>