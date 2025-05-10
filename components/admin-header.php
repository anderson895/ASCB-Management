<?php
include('../db/class.php');
$admin_db = new global_class();

session_start();
$isLogin = false;
$admin_restrictions="";


if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    $isLogin = true;
    $getUserDetails = $admin_db->get_user_info($admin_id);
    $user = $getUserDetails->fetch_array();
    $name = $user['fname'];
    $admin_id =$user['admin_id'];
    $username=$user['username'];
    $profile_img=$user['profile_img'];
    $type = $user['type'];

    if($type !=='super_admin'){

      $admin_restrictions ="hidden";

    }
}
if($isLogin==false){ 
  header("location: ../index.php");
}
?>




<!doctype html>
<html lang="en">
  <head>
  	<title>SRM</title>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="icon" type="image/x-icon" href="../assets/images/logo.jpg">

		<link rel="stylesheet" href="../node_modules/font-awesome/css/font-awesome.min.css">


    <link rel="stylesheet" href="../node_modules/alertifyjs/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="../node_modules/alertifyjs//build/css/themes/default.min.css"/>


    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css"/>




  
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.css">
	

		<link rel="stylesheet" href="../css/admin.css">

 

  </head>
  <body>
		
		<div class="wrapper d-flex align-items-stretch" >
			<nav id="sidebar" class="active" >
				<h1><a href="profile.php?profile_id=<?=$admin_id?>" class="logo" style="background-color:gray;"><?=ucfirst($username[0])?></a></h1>
        <ul class="list-unstyled components mb-5">
          <li class="active">
            <a href="dashboard.php"><span class="fa fa-bar-chart"></span> Dashboard</a>
          </li>

          

          
          <li <?=$admin_restrictions?>>
            <a href="user.php"><span class="fa fa-sticky-note"></span>Admin Staff</a>
          </li>

          <li <?=$admin_restrictions?>>
            <a href="subject.php"><span class="fa fa-book"></span> Subjects</a>
          </li>

          <li <?=$admin_restrictions?>>
            <a href="department.php"><span class="fa fa-building"></span> Department</a>
          </li>
          

        

          <li>
              <a href="student.php"><span class="fa fa-user"></span> Students</a>
          </li>


          <li>
              <a href="frequency.php"><span class="fa fa-line-chart"></span> frequency</a>
          </li>



          <li>
              <a href="studGrade.php"><span class="fa fa-clipboard"></span> Student Grade</a>
          </li>


                
         
          
          
         


          <li>
            <a href="Logout.php"><span class="fa fa-sign-out"></span> Logout</a>
          </li>


        </ul>

       
    	</nav>

        <!-- Page Content  -->
       









    
      
    <!-- End Example Code -->
  </body>
</html>



