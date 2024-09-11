<?php



include('../components/admin-header.php');

$isLogin = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $isLogin = true;
}

$dept_id=$_GET['dept_id'];

$get_department = $admin_db->view_department($dept_id);

    $view_department = $get_department->fetch_array();
    $department=$view_department['dept_name'];

?>

<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <div class="container-fluid" >

  
    <h4>Manage Department</h4>

    
  </div>
</nav>


<!-- START -->
<div class="container mt-5">
    <h5>Report</h5>
    <p><strong>Department:</strong> <?=$department?></p>
    <!-- <p><strong>School:</strong> Andres Soriano Colleges of Bislig</p>
    <p><strong>Program:</strong> Master of Arts in Education major in Administration and Supervision</p>
    <p><strong>Academic Year:</strong> AY 2023-2024</p>
    <p><strong>Semester:</strong> 2nd Semester</p> -->

    <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
    <table id="studentTable" class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Number</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Sex</th>
                <th>Address</th>
                <th>Year Level</th>
                <th>Course</th>
                <th>Subject Code</th>
                <th>Subject Description</th>
                <th>Grade</th>
                <th>Units</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $get_All_student = $admin_db->get_All_studentBasedOnDepartment($dept_id);
              
                    $count = 1;
                    while ($student = $get_All_student->fetch_array()):
            ?>
            <tr>
                <td><?=$count?></td>
                <td><?=$student['stud_id']?></td>
                <td><?=$student['stud_lname']?></td>
                <td><?=$student['stud_fname']?></td>
                <td><?=$student['stud_mname']?></td>
                <td><?=$student['stud_gender']?></td>
                <td><?=$student['stud_address']?></td>
                <td><?=$student['stud_year_level']?></td>
                <td><?=$student['stud_course']?></td>
                <td><?=$student['course_code']?></td>
                <td><?=$student['descriptive_title']?></td>
                <td><?=$student['ss_final_grade']?></td>
                <td><?=$student['units']?></td>
            </tr>
            <?php 
                    $count++; 
                    endwhile; 
                
            ?>
        </tbody>
    </table>
</div>



</div>
<!-- END -->



<?php

include('../components/admin-footer.php');


?>


<script>
    $(document).ready(function() {
        $('#studentTable').DataTable();
    });

$('#studentTable').DataTable({
    "searching": true, // Enable or disable search
    "paging": true,    // Enable or disable pagination
    "info": true,      // Show information about the table
    "lengthChange": true, // Show entries-per-page dropdown
    "ordering": true   // Enable column sorting
});

</script>