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
<h5>Report</h5>
<p><strong>Department:</strong> <?=$department?></p>

<!-- Export Button -->
<form method="POST" action="function/export-to-excel_department.php">
    <input type="hidden" name="dept_id" value="<?=$dept_id?>">
    <button type="submit" class="btn btn-success mb-3">Export to Excel</button>
</form>

<div class="table-responsive shadow p-3 mb-5 bg-white rounded">
    <!-- Table Content -->
    <table id="studentTable" class="table table-bordered table-hover table-xl fs-5 w-100">
        <thead class="table-light">
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