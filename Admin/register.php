<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include('../Dbconnect/config.php');

?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <!-- <span aria-hidden="true">&times;</span -->
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username" required="required">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter Email" required="required">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password" required="required">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" required="required">
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="register_btn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Admin Profile 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Admin Profile 
            </button>
           

    </h6>
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

    <?php
                $query = "SELECT * FROM `Admin`";
                $query_run = mysqli_query($conn, $query);
            ?>

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="bg-dark text-light">
          <tr>
            <th> ID </th>
            <th>Username </th>
            <th>Email </th>
            <th colspan="2" class="text-center">Actions </th>
            
          </tr>
        </thead>
        <tbody>
     
        <?php
                        if(mysqli_num_rows($query_run) > 0)        
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                        ?>
                            <tr>
                                <td><?php  echo $row['id']; ?></td>
                                <td><?php  echo $row['username']; ?></td>
                                <td><?php  echo $row['email']; ?></td>
                                <td class="text-center">
                                    <form action="register_edit.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="edit_btn" class="btn btn-success"> <i class="fa-solid fa-pen-to-square"></i></button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                        <button type="submit" name="delete_reg_btn" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php
                            } 
                        }
                        else {
                            echo "No Record Found";
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