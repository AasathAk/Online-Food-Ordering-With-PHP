<?php
include('includes/header.php');
include('includes/navbar.php');
include('../Dbconnect/config.php');
?>
<?php
	
	if (isset($_POST['change'])) 
	{
		$uid =  $_SESSION["u_id"];
	 	$oldpwd =md5($_POST['oldpwd']);
		$pwd = md5($_POST['pwd']);
		$cpwd = md5($_POST['cpwd']);
		
		$sql = "SELECT `password` FROM `admin` WHERE `id` = '$uid'";
		$run = mysqli_query($conn, $sql);
		$data = mysqli_fetch_assoc($run);

		$oldpwdDb = $data['password'];

		if ($oldpwd == $oldpwdDb) 
		{
			if ($pwd == $cpwd) 
			{
				$usql = "UPDATE `admin` SET `password` = '$pwd' WHERE `id` = '$uid'";
				$run = mysqli_query($conn, $usql);
				?>
				<script type="text/javascript">
					alert("Password Changed Successfully! Login Again!!");
					window.open('login.php','_self');
					
				</script>
				<?php	
				session_destroy();
			}
			else
			{
				?>
				<script type="text/javascript">
					alert("Password and Confirm Password not match!");
				</script>
				<?php	
			}
		}
		else
		{
			?>
			<script type="text/javascript">
				alert("Incorrect Current Password!");
			</script>
			<?php	
		}
	}
?>

<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Change Password </h6>
        </div>
        <div class="card-body">

    

            <form action="change-password.php" method="POST">

                <div class="form-group">
                    <label> Old Password </label>
                    <input type="password" name="oldpwd" class="form-control" placeholder="Enter Old password">
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="pwd" class="form-control" placeholder="Enter New password">
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="cpwd" class="form-control" placeholder="Enter Confirm password">
                </div>

                <a href="register.php" class="btn btn-danger"> Cancel </a>
                <button type="submit" name="change" class="btn btn-primary"> Change </button>

            </form>

        </div>
    </div>
</div>

</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>