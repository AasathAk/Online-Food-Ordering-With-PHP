<?php
include('../Dbconnect/config.php');
include('includes/header.php'); 
include('includes/navbar.php'); 




?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Category Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <!-- <span aria-hidden="true">&times;</span -->
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Category Name </label>
                <input type="text" name="cat_name" class="form-control" placeholder="Enter Category Name">
            </div>
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="categorybtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Category Details
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Category
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

      <!-- Session message end -->

    <div class="table-responsive">

    

      <table class="table" id="dataTable">
        <thead class="bg-dark text-light">
          <tr>
            <th class="text-center">ID </th>
            <th class="text-center">Name </th>
            <th class="text-center">Action </th>
            
          </tr>
        </thead>
        <tbody>
        <?php

                $num=1;
                $query = "SELECT * FROM category";
                $query_run = mysqli_query($conn, $query);
           
      
                        if(mysqli_num_rows($query_run) > 0)        
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {

                            ?>
                      
                            <tr>
                                <td class="text-center"><?php  echo $num++ ?></td>
                                <td class="text-center"><?php  echo $row['category_title']; ?></td>
                                
                        
                                <td class="text-center">
                                    <form action="code.php" method="post">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['category_id']; ?>">
                                        <button type="submit" name="delete_cat_btn" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
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