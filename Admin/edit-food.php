<?php
// session_start();
include('includes/header.php'); 
include('includes/navbar.php'); 
include('../Dbconnect/config.php');

?>



<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> EDIT Food Profile </h6>
        </div>
    <div class="card-body">

    <?php
    if(isset($_POST['edit_pro_btn']))
    {
        $p_id=$_POST['edit_pro_id'];           
               
        $select_product = "SELECT * FROM `product` WHERE id='$p_id' ";
               
        $query_run = mysqli_query($conn, $select_product);

                foreach($query_run as $rows)
                {

                   
            ?>
        
    <form action="code.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="edit_pr_id" value="<?php echo $rows['id'] ?>">

<div class="modal-body">
<div class="form-group">
        <label> Food-Code</label>
        <input type="text" name="edit_pr_code" class="form-control" placeholder="Food code" value="<?php  echo $rows['product_code'] ?>" autocomplete="off" required="required">
    </div>
    <div class="form-group">
        <label> Food Name </label>
        <input type="text" name="edit_pr_title" class="form-control" placeholder="Enter food Name" value="<?php  echo $rows['product_name'] ?>"autocomplete="off" required="required">
    </div>
   
    <div class="form-group">
        <label> Product Keywords</label>
        <input type="text" name="edit_pr_keywords" class="form-control" placeholder="Enter keywords" value="<?php  echo $rows['product_keywords'] ?>"autocomplete="off" required="required">
    </div>
    <div class="form-group">
        <label> Select Category</label>
        <select name="edit_pr_category" class="form-select" required="required">
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
    <input type="text" name="edit_pr_price" class="form-control" placeholder="Enter food Price" value="<?php echo $rows['product_price'] ?>"
     autocomplete="off" required="required">
    </div>


    <div class="form-group">
        <label> Food Image </label>
        <input type="file" name="file" class="form-control" placeholder="Upload the image" value="<?php  echo $rows['product_image'] ?>" required="required">
    </div>
              
    <a href="add-food.php" class="btn btn-danger"> Cancel </a>
                <input type="submit" name="update_pr_btn" class="btn btn-primary" value="Update">

   
</div>

             
</form>

<?php

    }
}
?>
        </div>
    </div>
 </div>



<?php
include('includes/scripts.php');
include('includes/footer.php');
?>