<?php
session_start();
include('../Dbconnect/config.php');

if(isset($_POST['register_btn']))

 {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['confirmpassword']);

    $email_query = "SELECT * FROM `Admin` WHERE email='$email' ";
    $email_query_run = mysqli_query($conn, $email_query);

    $username_query = "SELECT * FROM `Admin` WHERE username='$username' ";
    $username_query_run = mysqli_query($conn, $username_query);
    
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['Alert'] = 'block';
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        header('Location: register.php'); 
    }
    elseif(mysqli_num_rows($username_query_run) > 0)
    {
        $_SESSION['Alert'] = 'block';
        $_SESSION['status'] = "User Name Already Taken. Please Try Another one.";
        header('Location: register.php'); 
    }
    else
    {
        if($password === $cpassword)
        {

            
            $query_add = "INSERT INTO `Admin`(username,email,password) VALUES('$username','$email','$password')";
            $reg_query_run_add = mysqli_query($conn, $query_add);
            
            if($reg_query_run_add)
             {
            $_SESSION['showAlert'] = 'block';
            $_SESSION['success']="Admin Profile is Added Successfully";
            header('Location:register.php');        
            }

            else
             {
            $_SESSION['showAlert'] = 'block';
            $_SESSION['error']="Admin Profile is not Added";
            header('Location:register.php');
             }  
        }
        
        else{

            $_SESSION['Alert'] = 'block';
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            header('Location:register.php'); 
          }

           
    }
    }
 
?>


<?php

if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    // $password = md5($_POST['edit_password']);

    $query_upd = "UPDATE `Admin` SET username='$username', email='$email' WHERE id='$id' ";
    $reg_query_run_upd = mysqli_query($conn, $query_upd);

    if( $reg_query_run_upd)
    {
        $_SESSION['showAlert'] = 'block';
        $_SESSION['success']="Your Data is Updated";
        header('Location:register.php');
        
    }
    else{

        $_SESSION['showAlert'] = 'block';
        $_SESSION['error']="Your Data is NOT Updated";
        header('Location:register.php');
    }  
}

?>


<?php


if(isset($_POST['delete_reg_btn']))
{
    $id = $_POST['delete_id'];

    $reg_query_del = "DELETE FROM `Admin` WHERE id='$id' ";
    $reg_query_run = mysqli_query($conn, $reg_query_del);
 
    if($reg_query_run)
    {
        $_SESSION['showAlert'] = 'block';
        $_SESSION['success']="Your Data is Deleted Successfully";
        header('Location:register.php');
        
    }
    else{

        $_SESSION['showAlert'] = 'block';
        $_SESSION['error']="Your Data is NOT DELETED";
        header('Location:register.php');
    }  
}
?>



<!-- category details -->


<!-- category Add -->

<?php

    if(isset($_POST['categorybtn']))
    { 
        $name=$_POST['cat_name'];
        $select_query="select * from category where category_title='$name'";
        $result=mysqli_query($conn,$select_query);
        $number=mysqli_num_rows($result);
        if($number>0)
        {
            echo "<script> alert('This category is present inside the database')</script>";
        }
        else{
        $query = "INSERT INTO category (category_title) VALUES ('$name')";
        $query_run = mysqli_query($conn, $query);
            
        if($query_run)
        {
            $_SESSION['showAlert'] = 'block';
            $_SESSION['success']="Category Added Successfully";
            header('location:add-category.php');
            
        }
        else
        {

            $_SESSION['showAlert'] = 'block';
            $_SESSION['error']="Category Not added";
            header('location:add-category.php');
        } 
     }
}

?>

<!-- category Remove -->
<?php
if(isset($_POST['delete_cat_btn']))
{
    $id = $_POST['delete_id'];

    $cat_query_del = "DELETE FROM `category` WHERE category_id='$id' ";
    $cat_query_run_del = mysqli_query($conn, $cat_query_del);

    if($cat_query_run_del)
    {
        $_SESSION['showAlert'] = 'block';
        $_SESSION['success']="Category is Deleted Successfully";
        header('location:add-category.php');
        
    }
    else{

        $_SESSION['showAlert'] = 'block';
        $_SESSION['error']="Category is NOT DELETED";
        header('location:add-category.php');
    } 
}
?>





<!-- Add food -->

<?php

    if(isset($_POST['foodbtn']))
    {
        $p_title=$_POST['pr_title'];
        $p_code=$_POST['pr_code'];
        $p_keywords=$_POST['pr_keywords'];
        $p_category=$_POST['pr_category'];
        $p_price=$_POST['pr_price'];
        
        //accessisng images
        $p_image=$_FILES['pr_image']['name'];

        //accessing image temp name
        $temp_image=$_FILES['pr_image']['tmp_name'];

        //checking empty conditions

        if($p_title==''  or $p_code=='' or $p_category=='' or $p_price=='' 
           or $p_image=='' or $p_keywords==''){

            echo "<script> alert('please fil the available filed')</script>" ;

           }
        else

        {
            $upload_image="img/".$p_image;
            move_uploaded_file($temp_image,$upload_image);
        

            $pr_query_add = "INSERT INTO `product`(product_name,product_price,product_image,product_code,category_id,product_keywords) 
            VALUES('$p_title','$p_price','$upload_image','$p_code','$p_category','$p_keywords')";

            $pr_result_add=mysqli_query($conn, $pr_query_add);
            
            if($pr_result_add)
            {
                $_SESSION['showAlert'] = 'block';
                $_SESSION['success']="Product added Successfully";
                header('location:add-food.php');
                
            }
            else{
        
                $_SESSION['showAlert'] = 'block';
                $_SESSION['error']="Product not added";
                header('location:add-food.php');
            }
        }
    }

?>



<!-- edit-food -->

<?php

if(isset($_POST['update_pr_btn']))
{
    $p_id = $_POST['edit_pr_id'];
    $p_title = $_POST['edit_pr_title'];
    $p_code = $_POST['edit_pr_code'];
    $p_price = $_POST['edit_pr_price'];
    $p_category = $_POST['edit_pr_category'];
    $p_keywords = $_POST['edit_pr_keywords'];

    $p_image=$_FILES['file']['name'];

        //accessing image temp name
        $temp_image=$_FILES['file']['tmp_name'];

        //checking empty conditions
            $upload_image="img/".$p_image;
            move_uploaded_file($temp_image,$upload_image);

            $product_update = "UPDATE `product` SET `product_name`=?, 
            `product_price`=?, `product_image`=?, `product_code`=?, 
            `category_id`=?, `product_keywords`=? WHERE `id`=?";
            $stmt = mysqli_prepare($conn, $product_update);
            mysqli_stmt_bind_param($stmt, "ssssisi", $p_title, $p_price, $upload_image, $p_code, $p_category, $p_keywords, $p_id);
            $product_update_res = mysqli_stmt_execute($stmt);
    
    if($product_update_res)
    {
        $_SESSION['showAlert'] = 'block';
        $_SESSION['success']="Product data is Updated";
        header('location:add-food.php');
        
    }
    else{

        $_SESSION['showAlert'] = 'block';
        $_SESSION['error']="Product data is Not Updated";
        header('location:add-food.php');
    }

}
?>

<!--food deleted -->

<?php
if(isset($_POST['delete_pro_btn']))
{
    $p_code = $_POST['delete_id'];

    $pr_query_del = "DELETE FROM `product` WHERE product_code='$p_code' ";
    $pr_query_run_del = mysqli_query($conn,  $pr_query_del);


    if($pr_query_run_del)
    {
        $_SESSION['showAlert'] = 'block';
        $_SESSION['success']="product is Deleted Successfully";
        header('location:add-food.php');
        
    }
    else{

        $_SESSION['showAlert'] = 'block';
        $_SESSION['error']="product is NOT DELETED";
        header('location:add-food.php');
    }

}
?>



<!-- orders delete -->
<?php
if(isset($_POST['delete_order_btn']))
{
    $id = $_POST['delete_id'];

    $query_del = "DELETE FROM `orders` WHERE id='$id' ";
    $query_run_del = mysqli_query($conn,$query_del);

    if($query_run_del)
    {
        $_SESSION['showAlert'] = 'block';
        $_SESSION['success']="order Deleted Successfully";
        header('location:user-order.php');
    }
    else
    {
        $_SESSION['showAlert'] = 'block';
        $_SESSION['error']="order not Deleted";
         header('location:user-order.php');
    }    
}
?>

