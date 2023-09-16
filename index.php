<?php
include('functions/common_function.php');


if (isset($_SESSION['uid'])) 
	{
		include('Dbconnect/config.php');
		$uid = $_SESSION['uid'];
		$query = "SELECT * FROM `user` WHERE `uid` = '$uid'";
		$run = mysqli_query($conn, $query);
		$data = mysqli_fetch_assoc($run);
	}
	else{

	}
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="Sahil Kumar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dine & divine</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* span .auto-type{
            color: yellow;
        } */
    </style>
</head>

<body>
    <!-- Navbar start -->
    <section id="Home">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark" id="navbar-style">
        <a class="navbar-brand logo" href="index.php">&nbsp;&nbsp;Dine And <span>Divine</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#About">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="Menu.php">Menu</a>
                </li>
                

            </ul>
        </div>
    </nav>

        <div class="main">

            <div class="men_text">
                <h1>Get <span class="auto-type"> <br></span></h1>

                
            </div>

            <div class="main_btn">
            <a href="menu.php">Order Now</a>
            <i class='fas fa-angle-right'></i>
             </div>
            </div>
        
        

    </section>
    
    <div class="about" id="About">
    <div class="about_main">

        <div class="image ">
            <img src="image/Food-Plate.png">
        </div>

        <div class="about_text">
            <h1><span>About</span>Us</h1>
            
            
                <h3>What Makes Our Foods And Sweets Special?</h3>
                <p>We Are Making All Our Products In Unique Taste And Style. We Avoid Our Maximum Of Using Artificial Colours Are Flavours. This Make Our Customers To Feel The Natural Taste.
                Also We Are Giving Only Freshly Made Products To Our Customers</p>
            
        </div>

    </div>



</div>



<?php 

include('includes/footer.php');

?>

<script>
        var typed =new Typed(".auto-type", {
            strings:[" Fast Food In Easy Way...","Bigins your day With Sweet....","Have a Nice day..."],
            typeSpeed:150,
            backSpeed:150,
            loop: true
        })
    
       
    
    </script>

</body>

</html>



