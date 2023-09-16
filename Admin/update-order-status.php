<?php
include('includes/header.php');
include('includes/navbar.php');
include('../Dbconnect/config.php');
?>

<?php
if (isset($_POST['update'])) {
    $form_id = $_GET['form_id'];
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    $query = mysqli_query($conn, "INSERT into remark(frm_id,status,remark) values('$form_id','$status','$remark')");
    $sql = mysqli_query($conn, "UPDATE orders set status='$status' where id='$form_id'");

    if ($query) {
        echo "<script>alert('Form Details Updated Successfully');</script>";
    }
}
?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive">

                <form method="post">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tbody>


                            <tr>
                                <td><b>Form Number</b></td>
                                <td><?php echo htmlentities($_GET['form_id']); ?></td>
                            </tr>
                            <tr>
                                <td><b>Status</b></td>
                                <td><select name="status" required="required">
                                        <option value="">Select Status</option>
                                        <option value="in process">On the way</option>
                                        <option value="closed">Delivered</option>
                                        <option value="rejected">Cancelled</option>

                                    </select></td>
                            </tr>


                            <tr>
                                <td><b>Message</b></td>
                                <td><textarea name="remark" cols="50" rows="4" required="required"></textarea></td>
                            </tr>



                            <tr>
                                <td><b>Action</b></td>
                                <td><input type="submit" name="update" class="btn btn-primary" value="Submit">

                                    <a href="user-order.php" class="btn btn-danger"> Close </a>
                                </td>
                            </tr>

                        </tbody>

                </form>



            </div>
        </div>
    </div>




</div