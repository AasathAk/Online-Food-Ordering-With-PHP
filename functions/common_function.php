
<?php
     include('Dbconnect/config.php');
?>

      
<?php
         //show category list
       function getcategory()
       {
        global $conn;
        $select_query="select * from `category`";
            $result=mysqli_query($conn,$select_query);
            while($row_data=mysqli_fetch_assoc($result))
            {
                $category_title=$row_data['category_title'];
                $category_id=$row_data['category_id'];
                
                echo "<a href='Menu.php?category=$category_id' class='btn bg-light text-dark p-1 mx-1 px-2'>$category_title</a>";
            }
       }
       
     

?>



<!-- get product -->

<?php
            function getproduct(){
            global $conn;
            if(!isset($_GET['category'])){
            $stmt = $conn->prepare('SELECT * FROM product order by rand() LIMIT 0,8');
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) :
            ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                    <div class="card-deck">
                        <div class="card p-2 border-secondary mb-2">
                            <img src="admin/<?= $row['product_image'] ?>" class="card-img-top" height="175">
                            <div class="card-body p-1">
                                <h4 class="card-title text-center text-info"><?= $row['product_name'] ?></h4>
                                <h5 class="card-text text-center text-danger">Rs&nbsp;&nbsp;<?= number_format($row['product_price'], 2) ?>/-</h5>

                            </div>
                            <div class="card-footer p-1">
                                <form action="" class="form-submit">
                                    <div class="row p-2">
                                        <div class="col-md-6 py-1 pl-4">
                                            <b>Quantity : </b>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control pqty" value="1" min="1" max="30">
                                        </div>
                                    </div>
                                    <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                    <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                                    <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                                    <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                                    <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                                    <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>
                                    &nbsp;&nbsp;Add to cart</button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            <?php endwhile;}} ?>

            <?php
            function get_uniquecategory(){
            global $conn;
            if(isset($_GET['category'])){
            $category_id=$_GET['category'];
            $stmt = $conn->prepare('SELECT * FROM product where category_id=?');
            $stmt->bind_param('i',$category_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $num_of_rows=mysqli_num_rows($result);
             if($num_of_rows==0){
                echo "<div id='echo-msg'><h2 class='text-center text-info '>No product found this category</h2></div>";
               }
            while ($row = $result->fetch_assoc()) :
            ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                    <div class="card-deck">
                        <div class="card p-2 border-secondary mb-2">
                            <img src="admin/<?= $row['product_image'] ?>" class="card-img-top" height="200">
                            <div class="card-body p-1">
                                <h4 class="card-title text-center text-info"><?= $row['product_name'] ?></h4>
                                <h5 class="card-text text-center text-danger">Rs&nbsp;&nbsp;<?= number_format($row['product_price'], 2) ?>/-</h5>

                            </div>
                            <div class="card-footer p-1">
                                <form action="" class="form-submit">
                                    <div class="row p-2">
                                        <div class="col-md-6 py-1 pl-4">
                                            <b>Quantity : </b>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control pqty" value="1"  min="1" max="30">
                                        </div>
                                    </div>
                                    <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                    <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                                    <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                                    <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                                    <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                                    <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>
                                    &nbsp;&nbsp;Add to cart</button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            <?php endwhile;}} ?>


            <?php
            function search_products(){
            global $conn;
            if(isset($_GET['search_data_product'])){
                $search_data_value=$_GET['search_data'];
                if($search_data_value==""){
                    echo "<h2 class='text-warning p-15'>No results match. Search any Product</h2>";
                }
                else{
                $search_query="select * from `product` where product_keywords like '%$search_data_value%'";
                $result=mysqli_query($conn,$search_query);
                $num_of_rows=mysqli_num_rows($result);
                if($num_of_rows==0){
                 echo "<h2 class='text-warning p-15'>No results match. No product found this category</h2>";
                }
            while ($row = $result->fetch_assoc()) :
            ?>
                <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
                    <div class="card-deck">
                        <div class="card p-2 border-secondary mb-2">
                            <img src="admin/<?= $row['product_image'] ?>" class="card-img-top" height="200">
                            <div class="card-body p-1">
                                <h4 class="card-title text-center text-info"><?= $row['product_name'] ?></h4>
                                <h5 class="card-text text-center text-danger">Rs&nbsp;&nbsp;<?= number_format($row['product_price'], 2) ?>/-</h5>

                            </div>
                            <div class="card-footer p-1">
                                <form action="" class="form-submit">
                                    <div class="row p-2">
                                        <div class="col-md-6 py-1 pl-4">
                                            <b>Quantity : </b>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control pqty" value="1"  min="1" max="30">
                                        </div>
                                    </div>
                                    <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                    <input type="hidden" class="pname" value="<?= $row['product_name'] ?>">
                                    <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                                    <input type="hidden" class="pimage" value="<?= $row['product_image'] ?>">
                                    <input type="hidden" class="pcode" value="<?= $row['product_code'] ?>">
                                    <button class="btn btn-info btn-block addItemBtn"><i class="fas fa-cart-plus"></i>
                                    &nbsp;&nbsp;Add to cart</button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            <?php endwhile;}}} ?>

            