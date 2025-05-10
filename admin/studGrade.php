

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
            <h4>List of Student Grade</h4>
        </div>
</nav>


<!-- START -->


<div class="table-responsive">
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Student</th>
                <th>Subject</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 

               
                $get_All_subject = $admin_db->view_all_student_grade();


                while ($subject = $get_All_subject->fetch_array()): ?>
                <tr>
                   <td><?=$subject['stud_lname']; ?> , <?=$subject['stud_fname']; ?></td>
                    <td><?=$subject['course_code']; ?></td>
                    <td><?=$subject['ss_final_grade']; ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm update-btn TogglerSubgrade" 
                            data-toggle="modal" data-target=".add-Subgrade-modal"
                            data-stud_id="<?=$subject['stud_id'];?>"
                            data-ss_id="<?=$subject['ss_id'];?>"
                            data-name="<?=$subject['stud_lname'];?>, <?=$subject['stud_fname'];?>"
                            data-code="<?=$subject['course_code'];?>"
                            data-ss_final_grade="<?=$subject['ss_final_grade'];?>">
                            Update
                        </button>
                    </td>
                  
                      
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

