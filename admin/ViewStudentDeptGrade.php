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
    $dept_name=$view_department['dept_name'];
    $dept_description=$view_department['dept_description'];
?>

<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <div class="container-fluid" >

  
    <h4>List of Student Grade</h4>

    
  </div>
</nav>

<!-- START -->

<!-- Export Button -->
<form method="POST" action="function/export-to-excel_studentDeptGrade.php">
    <input type="hidden" name="dept_id" value="<?=$dept_id?>">
    <button type="submit" class="btn btn-success mb-3">Export to Excel</button>
</form>

    <!-- Table Content -->
    <div class="table-responsive ">
        <div class="card shadow p-4">
            <h4 class="text-center mb-4">Promotional Report</h4>
            <div class="mb-3">
                <strong>Program:</strong> <?=$dept_description?> <br />
            </div>

            <div class="table-responsive">
                <table id="studentTable" class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Student Number</th>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Date of Birth</th>
                            <th>Gender</th>
                            <th>Home Address</th>
                            <th>Year</th>
                            <th>Course Code</th>
                            <th>Course Description</th>
                            <th>Grades</th>
                            <th>Units</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
$student_grade = $admin_db->view_student_grade_per_department($dept_id);

$students = [];

while ($row = $student_grade->fetch_assoc()) {
    $stud_id = $row['stud_id'];
    
    if (!isset($students[$stud_id])) {
        $students[$stud_id] = [
            'info' => $row,
            'subjects' => []
        ];
    }

    $students[$stud_id]['subjects'][] = [
        'course_code' => $row['course_code'],
        'descriptive_title' => $row['descriptive_title'],
        'ss_final_grade' => $row['ss_final_grade'],
        'units' => $row['units']
    ];
}
?>

<tbody>
<?php 
$count = 1;
foreach ($students as $stud_id => $student) {
    $subjectCount = count($student['subjects']);
    $first = true;
    foreach ($student['subjects'] as $index => $subject) {
?>
    <tr>
        <?php if ($first): ?>
            <td rowspan="<?=$subjectCount?>"><?=$count?></td>
            <td rowspan="<?=$subjectCount?>"><?=$student['info']['stud_id']?></td>
            <td rowspan="<?=$subjectCount?>"><?=$student['info']['stud_lname']?></td>
            <td rowspan="<?=$subjectCount?>"><?=$student['info']['stud_fname']?></td>
            <td rowspan="<?=$subjectCount?>"><?=$student['info']['stud_mname']?></td>
            <td rowspan="<?=$subjectCount?>"><?=$student['info']['stud_bday']?></td>
            <td rowspan="<?=$subjectCount?>"><?=$student['info']['stud_gender']?></td>
            <td rowspan="<?=$subjectCount?>"><?=$student['info']['stud_address']?></td>
            <td rowspan="<?=$subjectCount?>"><?=$student['info']['stud_year_level']?></td>
        <?php endif; ?>
        
        <td><?=$subject['course_code']?></td>
        <td><?=$subject['descriptive_title']?></td>
        <td><?=$subject['ss_final_grade']?></td>
        <td><?=$subject['units']?></td>
    </tr>
<?php 
        $first = false;
    }
    $count++;
}
?>
</tbody>


                    </tbody>
                </table>
            </div>
        </div>
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