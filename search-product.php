<?php 
include 'Dbconnect/config.php';
include('functions/common_function.php');
include('includes/header.php'); 
 ?>

    <!-- Displaying Products Start -->
    <div class="container">
        <div id="message"></div>
        <div class="row mt-5 pb-3">
            <?php
                    search_products();
                    
                    get_uniquecategory()
            ?>
        </div>
    </div>

     <!--Footer-->
<?php
    include('includes/footer.php')
?>
 <script type="text/javascript">
        $(document).ready(function() {

            // Send product details in the server
            $(".addItemBtn").click(function(e) {
                e.preventDefault();
                var $form = $(this).closest(".form-submit");
                var pid = $form.find(".pid").val();
                var pname = $form.find(".pname").val();
                var pprice = $form.find(".pprice").val();
                var pimage = $form.find(".pimage").val();
                var pcode = $form.find(".pcode").val();

                var pqty = $form.find(".pqty").val();

                $.ajax({
                    url: 'action.php',
                    method: 'post',
                    data: {
                        pid: pid,
                        pname: pname,
                        pprice: pprice,
                        pqty: pqty,
                        pimage: pimage,
                        pcode: pcode
                    },
                    success: function(response) {
                        $("#message").html(response);
                        window.scrollTo(0, 0);
                        load_cart_item_number();
                    }
                });
            });

            // Load total no.of items added in the cart and display in the navbar
            load_cart_item_number();

            function load_cart_item_number() {
                $.ajax({
                    url: 'action.php',
                    method: 'get',
                    data: {
                        cartItem: "cart_item"
                    },
                    success: function(response) {
                        $("#cart-item").html(response);
                    }
                });
            }
        });
    </script>
</body>

</html>