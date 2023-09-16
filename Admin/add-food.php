<?php
include('includes/header.php'); 

include('includes/navbar.php'); 
 include('../Dbconnect/config.php');

?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add food details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <!-- <span aria-hidden="true">&times;</span -->
        </button>
      </div>
      <form action="code.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
        <div class="form-group">
                <label> Food-Code</label>
                <input type="text" name="pr_code" class="form-control" placeholder="Food code" autocomplete="off" required="required">
            </div>
            <div class="form-group">
                <label> Food Name </label>
                <input type="text" name="pr_title" class="form-control" placeholder="Enter food Name" autocomplete="off" required="required">
            </div>
           
            <div class="form-group">
                <label> Product Keywords</label>
                <input type="text" name="pr_keywords" class="form-control" placeholder="Enter keywords" autocomplete="off" required="required">
            </div>
            <div class="form-group">
                <label> Select Category</label>
                <select name="pr_category" class="form-select">
                  <option value="">Select a category</option>
                  <?php
                      $select_query="Select * from `category`";
                      $result=mysqli_query($conn,$select_query);
                      while($row=mysqli_fetch_assoc($result))
                      {
                        $category_title=$row['category_title'];
                        $category_id=$row['category_id'];

                        echo "<option value='$category_id'>$category_title</option>";

                      }
                  ?>
           
                </select>
            </div>
            <div class="form-group">
                <label> Price </label>
                <input type="text" name="pr_price" class="form-control" placeholder="Enter food Price" autocomplete="off" required="required">
            </div>
            <div class="form-group">
                <label> Food Image </label>
                <input type="file" name="pr_image" class="form-control" placeholder="Upload the image" required="required">
            </div>
           
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="foodbtn" class="btn btn-primary">Add</button>
        </div>
      </form>

    </div>
  </div>
</div>

<div class="container-fluid">

<!-- DataTables Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Food Details
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add food
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

      <table class="table table-bordered" id="dataTable" width="80%" cellspacing="0">
        <thead class="bg-dark text-light">
       
          <tr>
            <th class="text-center">P-ID </th>
            <th class="text-center">Food code </th>
            <th class="text-center">Image </th>
            <th class="text-center">Name </th>
            <th class="text-center">Price </th>
            <th class="text-center" colspan="2">Actions</th>
            
            
          </tr>
        </thead>
        <tbody>

        <?php
                $query = "SELECT * FROM product";
                $query_run = mysqli_query($conn, $query);

                
      
                        if(mysqli_num_rows($query_run) > 0)        
                        {
                            while($row = mysqli_fetch_assoc($query_run))
                            {
                              $p_id=$row['id'];
                              $p_image=$row['product_image'];
                              $p_code=$row['product_code'];
                              $p_title=$row['product_name'];
                              $category_id=$row['category_id'];
                              $p_price=$row['product_price'];

                              echo "<tr>
                              <td class='text-center'>$p_id</td>
                              <td class='text-center'>$p_code</td>
                              <td class='text-center'><img src='$p_image' width='50px'></td>
                              <td class='text-center'>$p_title</td>
                              <td class='text-center'>$p_price</td>
                           

                              <td class='text-center'>
                                  <form action='edit-food.php' method='post'>
                                      <input type='hidden' name='edit_pro_id' value=$p_id>
                                      <button type='submit' name='edit_pro_btn' class='btn btn-success'> <i class='fa-solid fa-pen-to-square'></i></button>
                                  </form>
                              </td>
                              

                              <td class='text-center'>
                                  <form action='code.php' method='post'>
                                      <input type='hidden' name='delete_id' value=$p_code>
                                      <button type='submit' name='delete_pro_btn' class='btn btn-danger'><i class='fa-solid fa-trash'></i></button>
                                  </form>
                              </td>
                          </tr>";
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