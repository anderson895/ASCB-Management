

<?php



include('../components/admin-header.php');

$isLogin = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $isLogin = true;
}?>


<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <h4>Frequency</h4>
            <a href="function/export_subject_frequency.php" class="btn btn-primary">Export to Excel</a>
        </div>
</nav>


<!-- START -->


<div class="table-responsive">
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Code</th>
                <th>Cource Description</th>
                <th>Section Name</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <?php 

               
                $get_All_subject = $admin_db->get_All_subject_frequency();
               
                while ($subject = $get_All_subject->fetch_array()): ?>
                <tr>
                   <td><?=$subject['course_code']; ?></td>
                    <td><?=$subject['descriptive_title']; ?></td>
                    <td><?=$subject['stud_section']; ?></td>
                    <td><?=$subject['student_count']; ?></td>
                      
                </tr>
            <?php endwhile; ?>
                        
        </tbody>
    </table>
</div>




<div class="loading-spinner" id="loading-spinner" style="display:none;">


                            

<!-- END TABLE -->



<?php

include('../components/admin-footer.php');


?>

