<?php



include('../components/admin-header.php');

$isLogin = false;
if (isset($_SESSION['admin_id'])) {


    $admin_id = $_SESSION['admin_id'];

    $get_admin_info = $admin_db->get_admin_info($admin_id);
    $admin_data = $get_admin_info->fetch_assoc();
         
   
    


   
    $isLogin = true;
}



$stud_id=$_GET['stud_id'];

 $get_student_info = $admin_db->get_student_info($stud_id);
  $student = $get_student_info->fetch_array();

  $fullname = $student['stud_fname'] . ' ' . $student['stud_mname'] . ' ' . $student['stud_lname'];
  $stud_course=$student['stud_course'];
  $stud_year_level=$student['stud_year_level'];


  $stud_sy=$student['stud_school_year'];
  $stud_gender=$student['stud_gender'];
  
  $stud_sem = $student['stud_sem'];
  $stud_sem = str_replace('_t', ' trimester', $stud_sem);

  $stud_academic_status=$student['stud_academic_status'];
  $stud_section=$student['stud_section'];
  
 

  
?>


<link rel="stylesheet" href="../css/view_student_info.css">
<link rel="stylesheet" href="../css/grading_layout.css">
<!-- Include Select2 CSS -->
<link href="../node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />



<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <div class="container-fluid" >

  
    <h4><?=ucfirst($student['stud_fname']);?>'s Profile</h4>

    
  </div>

                            <div class="text-center mt-4">
                                <button class="btn btn-primary print-hidden" onclick="printContent()">Print</button>
                            </div>
</nav>

<section class="bg-light">
  <div class="container resume-container">
    <div class="row">
      <div class="col-lg-12 mb-4 mb-sm-5">
        <div class="card card-style1 border-0">
          <div class="card-body p-1-9 p-sm-2-3 p-md-6 p-lg-7">
            <div class="container mt-5" id="print-section">

              <!-- HEADER START -->
              <div class="container text-center mb-4 border-bottom pb-3">
                <div class="row align-items-center">
                  <div class="col-md-2">
                    <img src="../assets/images/ascob_logo.jpg" alt="Andres Soriano Colleges of Bislig Logo" width="100">
                  </div>
                  <div class="col-md-10">
                    <h4 class="mb-0 fw-bold">Andres Soriano Colleges of Bislig</h4>
                    <p class="mb-1">Andres Soriano Avenue, Mangagoy, Bislig City, Surigao del Sur</p>
                    <h5 class="mt-2 fw-bold text-uppercase">Certificate of Registration</h5>
                  </div>
                </div>
              </div>

              <!-- STUDENT DETAILS -->
              <div class="container mt-3">
                <div class="row mb-3">
                  <div class="col-md-6">
                    <p><strong>Student Name:</strong> <u><?= strtoupper($fullname) ?></u></p>
                    <p><strong>Course:</strong> <u><?= $stud_course ?></u></p>
                    <p><strong>Year:</strong> <u><?= $stud_year_level ?></u></p>
                    <p><strong>Gender:</strong> <u><?= ucfirst($stud_gender) ?></u></p>
                  </div>
                  <div class="col-md-6">
                    <p><strong>Semester:</strong> <u><?= $stud_sem ?></u></p>
                    <p><strong>School Year:</strong> <u><?= strtoupper($stud_sy) ?></u></p>
                  </div>
                </div>
              </div>
              <!-- HEADER END -->

              <!-- SUBJECT LIST -->
              <div class="row mb-3">
                <div class="col-12">
                  <table class="table table-bordered">
                    <thead class="table-light">
                      <tr>
                        <th scope="col">Course No.</th>
                        <th scope="col">Course Title</th>
                        <th scope="col">Final</th>
                        <th scope="col">Units</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                        $get_subject = $admin_db->getAllSubjectsForSpecificStudent($stud_id);
                        $total_weighted_grade = 0;
                        $total_units = 0;

                        while ($subject = $get_subject->fetch_array()):
                          if ($subject['ss_final_grade'] <= 0) {
                            $grade = "NO GRADE";
                          } else if ($subject['ss_final_grade'] > 0 && $subject['ss_final_grade'] <= 3) {
                            $grade = "PASSED";
                          } else {
                            $grade = "FAILED";
                          }

                          if ($subject['ss_final_grade'] > 0 && $subject['ss_final_grade'] <= 5) {
                            $total_weighted_grade += $subject['ss_final_grade'] * $subject['units'];
                            $total_units += $subject['units'];
                          }
                      ?>
                      <tr>
                        <td><?= $subject['course_code']; ?></td>
                        <td><?= $subject['descriptive_title']; ?></td>
                        <td><?= $subject['ss_final_grade']; ?></td>
                        <td><?= $subject['units']; ?></td>
                      </tr>
                      <?php endwhile; ?>
                    </tbody>
                  </table>

                  <p><strong>GWA:</strong> 
                    <?php 
                      if ($total_units > 0) {
                        $gwa = $total_weighted_grade / $total_units;
                        echo number_format($gwa, 2);
                      } else {
                        echo "N/A";
                      }
                    ?>
                  </p>
                </div>
              </div>

              <!-- CERTIFICATION FOOTER -->
              <div class="row mt-4">
                <div class="col-12 text-center">
                  <p>Certified true and correct:</p>
                  <p><strong>REBECCA P. CAPONONG, MA</strong></p>
                  <p>Registrar</p>
                </div>
              </div>

            </div> <!-- /print-section -->
          </div> <!-- /card-body -->
        </div> <!-- /card -->
      </div>
    </div>
  </div>
</section>






<!-- START -->
<section class="bg-light">
    
    <div class="container">

    
        <div class="row">

        
        <nav class="navbar navbar-expand-lg navbar-light bg-light" >
            <div class="container-fluid " >
              <h2> Subject List</h2>

              <button type="button" class="togglerAddSubjectForStudent btn btn-secondary" data-toggle="modal" data-target=".add-StudentSubject-modal" data-stud_id="<?=$stud_id?>">Add Subject</button>
                
            </div>
            
        </nav>

        


            <div class="container" id="listGrade">
            <div class="table-responsive shadow p-3 mb-5 bg-white rounded">
    <table id="myTable" class="table table-striped table-bordered table-hover">
        <thead class="thead-dark ">
            <tr>
                <th class="col-md-1 text-center text-dark">Code</th>
                <th class="col-md-2 text-center text-dark">Department</th>
                <th class="col-md-4 text-center text-dark">Descriptive Title</th>
                <th class="col-md-1 text-center text-dark">Unit</th>
                <th class="col-md-2 text-center text-dark">Pre-Requisite</th>
                <th class="col-md-1 text-center text-dark">Grade</th>
                <th class="col-md-1 text-center text-dark">Remarks</th>
                <?php 
                    if($admin_data['type']==="super_admin"){
                        echo $authorization='<th  class="col-md-2 text-center text-dark" >Actions</th>';
                    }
                ?>
                
               
                

            </tr>
        </thead>
        <tbody>
            <?php 
            $get_subject = $admin_db->getAllSubjectsForSpecificStudent($stud_id);
            $total_weighted_grade = 0;
            $total_units = 0;

            while ($subject = $get_subject->fetch_array()):
                if($subject['ss_final_grade']<=0){
                    $grade="NO GRADE";
                }else if($subject['ss_final_grade']>0 && $subject['ss_final_grade'] <= 3 ){
                    $grade="PASSED";
                }else if($subject['ss_final_grade']>0 && $subject['ss_final_grade'] >3 ){
                    $grade="FAILED";
                }

                // Calculate total weighted grades and units
                if($subject['ss_final_grade'] > 0 && $subject['ss_final_grade'] <= 5) {
                    $total_weighted_grade += $subject['ss_final_grade'] * $subject['units'];
                    $total_units += $subject['units'];
                }
            ?>
            <tr>
                <td class="text-center"><?=$subject['course_code']; ?></td>
                <td class="text-center"><?=$subject['dept_name']; ?></td>
                <td><?=$subject['descriptive_title']; ?></td>
                <td class="text-center"><?=$subject['units']; ?></td>
                <td class="text-center"><?=$subject['pre_requisite']; ?></td>
                <td class="text-center"><?=$subject['ss_final_grade']; ?></td>
                <td class="text-center"><?=$grade?></td>

                <?php 
                    if($admin_data['type'] === "super_admin") {
                      echo  $authorization = '
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-danger btn-sm TogglerDeleteStudentSubject" 
                                        data-ss_id="' . $subject['ss_id'] . '"
                                        data-student_id="' . $stud_id . '"
                                        data-subject_id="' . $subject['subject_id'] . '" 
                                        data-code="' . $subject['course_code'] . '">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    <!-- Input Grade Button -->
                                    <button type="button" class="btn btn-success btn-sm TogglerSubgrade" 
                                        data-toggle="modal" data-target=".add-Subgrade-modal"
                                        data-stud_id="' . $stud_id . '"
                                        data-ss_id="' . $subject['ss_id'] . '" 
                                        data-code="' . $subject['course_code'] . '"
                                        data-ss_final_grade="' . $subject['ss_final_grade'] . '">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </div>
                            </td>
                        ';
                    }
                ?>

               
            </tr>
            <?php endwhile; ?>

        </tbody>
    </table>


    <div class="d-flex justify-content-center">
        <span class="text-center">GWA: 
        <?php 
            // Compute GWA
            if ($total_units > 0) {
                $gwa = $total_weighted_grade / $total_units;
                echo number_format($gwa, 2);
            } else {
                echo "N/A";
            }
        ?>
        </span>
    </div>

    <div class="container text-center mt-5">
        <h2 class="grading-system-title" style='color:gray;'>GRADING SYSTEM</h2>

        <div class="row">
            <div class="col-md-4 grading-section">
                <ul class="grading-list">
                    <li>1.0 – 95 – 100%</li>
                    <li>1.1 – 94</li>
                    <li>1.2 – 93</li>
                    <li>1.3 – 92</li>
                    <li>1.4 – 91</li>
                    <li>1.5 – 90</li>
                    <li>1.6 – 89</li>
                    <li>1.7 – 88</li>
                </ul>
            </div>
            <div class="col-md-4 grading-section">
                <ul class="grading-list">
                    <li>1.8 – 87</li>
                    <li>1.9 – 86</li>
                    <li>2.0 – 85</li>
                    <li>2.1 – 84</li>
                    <li>2.2 – 83</li>
                    <li>2.3 – 82</li>
                    <li>2.4 – 81</li>
                    <li>2.5 – 80</li>
                </ul>
            </div>
            <div class="col-md-4 grading-section">
                <ul class="grading-list">
                    <li>2.6 – 79</li>
                    <li>2.7 – 78</li>
                    <li>2.8 – 77</li>
                    <li>2.9 – 76</li>
                    <li>3.0 – 75</li>
                    <li>5.0 – (Failed)</li>
                    <li>Dr. – Dropped</li>
                </ul>
            </div>
        </div>
    </div>
</div>

                
            </div>

        </div>
    </div>
</section>
<!-- END  -->

                        <div class="loading-spinner" id="loading-spinner" style="display:none;">
                            <div class="spinner"></div>
                        </div>





                </div>
            </div>
            
    </div>
</section>
</div>






<?php

include('../components/admin-footer.php');


?>



    <div class="modal fade add-StudentSubject-modal" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addSubjectLabel">Add Student Subject</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmAddStudentSubject" enctype="multipart/form-data">
                        <input type="hidden" id="add_stud_id" name="add_stud_id" required>

                        <div class="form-group mb-3">
                            <label for="add_stud_subject">Available Subject for <?php if($stud_academic_status=="Irregular"){ echo "<b class='text-primary'>Irregular</b>"; }else{ ?><b class="text-success"><?= htmlspecialchars($stud_year_level) ?></b><?php } ?></label>
                            <select class="form-control custom-select-width" name="add_stud_subject" id="add_stud_subject" required style="width:100%;">
                                <?php 

                                if($stud_academic_status=="Irregular"){
                                    $get_All_subject = $admin_db->get_All_subject_Irregular($stud_id);
                                }else{
                                    $get_All_subject = $admin_db->get_StudentSubject($stud_id, $stud_year_level);
                                }
                              
                                $subjects_found = false;

                                while ($subject = $get_All_subject->fetch_array()) {
                                    $subjects_found = true;
                                    echo '<option value="' . $subject['subject_id'] . '">' . $subject['course_code'] . '</option>';
                                }

                                if (!$subjects_found) {
                                    echo '<option disabled>No Available Subject</option>';
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group mb-3 text-center">
                            <button type="submit" class="btn btn-success" id="btnAddStudentSubject">Add Subject</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  

<script src="../node_modules/select2//dist/js/select2.min.js"></script>

<!-- Update student Modal -->
 
<script>
    $(document).ready(function() {
        $('#add_stud_subject').select2({
            placeholder: 'Select a subject',
            allowClear: true
        });
    });
</script>
