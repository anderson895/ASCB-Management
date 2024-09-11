<?php
include('db/class.php');
$admin_db = new global_class();

session_start();
$isLogin = false;
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $isLogin = true;
    $getUserDetails = $admin_db->get_All_user($admin_id);
    $user = $getUserDetails->fetch_array();
    $name = $user['fname'];
    $type = $user['type'];
}

if($isLogin==true){

 

    header("location: admin/dashboard.php");


}




?>

<!doctype html>
<html lang="en">
  <head>
  	<title>SRM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" type="image/x-icon" href="assets/images/logo.jpg">
	<link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="node_modules/alertifyjs/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="node_modules/alertifyjs//build/css/themes/default.min.css"/>

	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">STUDENT RECORD MANAGEMENT</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="wrap">
						<div  class="img" style="background-image: url(assets/images/logo.jpg);"></div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Sign In</h3>
			      		</div>
			      	</div>
					
                    
                    <form id="loginForm" class="signin-form">
			      	<div class="form-group mt-3">
			      			<input type="text" class="form-control" name="username" id="username" required>
			      			<label class="form-control-placeholder" for="username">Username</label>
			      		</div>

		            <div class="form-group mt-4">
		              <input id="password-field" type="password" class="form-control" name="password" required>
		              <label class="form-control-placeholder" for="password">Password</label>
		              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
		            </div>
		            <div class="form-group">
		            	<button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
		            </div>
                    <div id="loading-spinner" style="display:none;">
                        <div class="spinner"></div>
                    </div>

		            
		          </form>
		         
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
    <script src="node_modules/alertifyjs/build/alertify.min.js"></script>
    

  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>



