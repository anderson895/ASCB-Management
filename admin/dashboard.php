<?php

include('../components/admin-header.php');

$isLogin = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $isLogin = true;
}

$get_All_subject_count = $admin_db->get_All_subject_count();
$total_subjects = $get_All_subject_count; 


$get_All_student_count = $admin_db->get_All_student_count();
$total_student = $get_All_student_count; 


$get_All_user_count = $admin_db->get_All_user_count();
$total_user = $get_All_user_count; 




?>





<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <div class="container-fluid">
    <h4>Dashboard</h4>
  </div>
</nav>

<div id="wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card border-primary">
          <div class="card-body">
            <h5 class="card-title"><?=$total_user;?></h5>
            <div id="spark1" class="sparkline">Total User</div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card border-primary">
          <div class="card-body">
            <h5 class="card-title"><?=$total_student;?></h5>
            <div id="spark2" class="sparkline">Total Student</div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card border-primary">
          <div class="card-body">
            <h5 class="card-title"><?=$total_subjects;?></h5>
            <div id="spark3" class="sparkline">Total Subject</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<?php

include('../components/admin-footer.php');

?>
