<?php
include('../components/admin-header.php');

$isLogin = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $isLogin = true;
}

$subject_id=$_GET['subject_id'];
$subject_code=$_GET['code'];
?>

<div id="content" class="p-4 p-md-5">

<input hidden type="text" name="subject_id" id="subject_id" value="<?=$subject_id?>">

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
    
  <div class="container-fluid" >


    <h4>List of Grades for <?= $subject_code?></h4>
    

    
  </div>
</nav>


<!-- START -->
<div class="container mt-5">
   <button class="btn btn-secondary mb-3" id="exportExcel">EXPORT ON EXCEL</button>

    <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
    <table id="studentTable" class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Number</th>
                <th>Enrollee Name</th>
                
                <th>Final Grade</th>
                <th>Gen Ave</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $get_All_student = $admin_db->get_All_studentBasedSubject($subject_id);
              
                    $count = 1;
                    while ($student = $get_All_student->fetch_array()):

                        $fullname=$student['stud_lname'].", ".$student['stud_mname'].", ".$student['stud_fname'];

                        $general_ave=$student['general_average'];
                      
                        if($general_ave<=0){
                            $remarks="NO GRADE";
                        }else if($general_ave>0 && $general_ave <= 3 ){
                            $remarks="PASSED";
                        }else if($general_ave>0 && $general_ave > 3 ){
                            $remarks="FAILED";
                        }
            ?>
            <tr>
                <td><?=$count?></td>
                <td><?=$student['stud_id']?></td>
                <td><?=strtoupper($fullname)?></td>
                <td><?=$student['ss_final_grade']?></td>
                <td><?=$student['general_average']?></td>
                <td><?=$remarks?></td>
               
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



    $('#exportExcel').on('click', function() {

        var subject_id =$("#subject_id").val();
        window.location.href = 'function/export_subject_record.php?subject_id=' + subject_id;
    });


</script>