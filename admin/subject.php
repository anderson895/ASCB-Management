

<?php



include('../components/admin-header.php');

$isLogin = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $isLogin = true;
}?>


<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <div class="container-fluid" >

  
    <h4>Manage Subject</h4>

    
  </div>
</nav>



<!-- START -->


<button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".add-subject-modal">Add New</button>


<div class="table-responsive">
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Code</th>
                <th>Department</th>
                <th>Descriptive Title</th>
                <th>Unit</th>
                <th>Pre-Requisite</th>
                <th>Subject For</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <h2 class="text-center">List of Subjects</h2>
            <?php 

               
                $get_All_subject = $admin_db->get_All_subject();
               
                while ($subject = $get_All_subject->fetch_array()): ?>
                <tr>
                   <td><?=$subject['course_code']; ?></td>
                    <td><?=$subject['dept_name']; ?></td>
                    <td><?=$subject['descriptive_title']; ?></td>
                    <td><?=$subject['units']; ?></td>
                    <td><?=$subject['pre_requisite']; ?></td>
                    <td><?=$subject['for_year_level']; ?></td>
                    <td>
                       
                            <!-- Update Button -->
                            <button type="button" class="btn btn-secondary TogglerUpdateSubject" 
                            data-toggle="modal"
                             data-target=".edit-subject-modal" 
                             data-subject_id="<?=$subject['subject_id']?>" 
                             data-code="<?=$subject['course_code']?>" 
                             data-title="<?=$subject['descriptive_title']?>" 
                             data-units="<?=$subject['units']?>" 
                             data-dept_id="<?=$subject['sub_dept_id']?>" 
                             data-pre="<?=$subject['pre_requisite']?>"
                            data-for_year_level="<?=$subject['for_year_level']?>"
                             > <i class="fa fa-pencil"></i>
                            </button>


                            <button type="button" class="btn btn-secondary TogglerViewSubject" 
                            data-subject_id="<?=$subject['subject_id']?>"
                            data-code="<?=$subject['course_code']?>"
                            >
                            <i class="fa fa-eye"></i>
                            </button>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger TogglerDeleteSubject" 
                            data-subject_id="<?=$subject['subject_id']?>"
                            data-code="<?=$subject['course_code']?>">
                            <i class="fa fa-trash"></i>
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

