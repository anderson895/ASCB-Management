<?php



include('../components/admin-header.php');

$isLogin = false;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $isLogin = true;
}?>


<!-- Include Select2 CSS -->
<link href="../node_modules/select2/dist/css/select2.min.css" rel="stylesheet" />

<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <div class="container-fluid" >

  
    <h4>Manage Department</h4>

    
  </div>
</nav>


<!-- START -->


<button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".add-department-modal">Add New</button>
<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ExportDepartmentData">
    <i class="fa fa-filter"></i>
</button>

<div class="table-responsive">
<h2 class="text-center">List of Department</h2>
    <table id="myTable" class="table table-striped" style="width:100%">
      
        <thead>
            <tr>
                <th>ID</th>
                <th>DEPARTMENT</th>
                <th>DESCRIPTION</th>
                <th><div class="d-flex justify-content-center">Total Student</div></th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $get_All_department = $admin_db->get_All_department();
                while ($department = $get_All_department->fetch_array()): ?>
                <tr>
                    <td><?=$department['dept_id']; ?></td>
                    <td><?=$department['dept_name']; ?></td>
                    <td><?=$department['dept_description']; ?></td>
                    <td ><div class="d-flex justify-content-center"><?= $admin_db->get_All_TotalStudent_per_department($department['dept_id']) ?></div></td>
                    <td>
                        <div id="delLoad-<?=$department['dept_id']?>">
                            <!-- Update Button -->
                            <button type="button" class="btn btn-secondary TogglerUpdateDepartment" 
                            data-toggle="modal"
                             data-target=".edit-department-modal" 
                             data-dept_id="<?=$department['dept_id']?>" 
                             data-dept_name="<?=$department['dept_name']?>" 
                             data-dept_description="<?=$department['dept_description']?>"> <i class="fa fa-pencil"></i></button>

                             <button type="button" class="btn btn-secondary TogglerViewDepartment" 
                            data-dept_id="<?=$department['dept_id']?>">
                            <i class="fa fa-eye"></i>
                            </button>


                            
                            <button type="button" class="btn btn-secondary TogglerListEnrolledDepartment" 
                            data-dept_id="<?=$department['dept_id']?>">
                            <i class="fa fa-users"></i>
                            </button>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger TogglerDeleteDepartment" 
                            data-dept_id="<?=$department['dept_id']?>">
                            <i class="fa fa-trash"></i>
                            </button>



                            
                        </div>

                     

                    </td>
                </tr>
            <?php endwhile; ?>
                        
        </tbody>
    </table>
</div>

<!-- END TABLE -->
</div>




<!-- Modal -->
<!-- Bootstrap 5 Modal -->
<div class="modal fade" id="ExportDepartmentData" tabindex="-1" aria-labelledby="ExportDepartmentDataLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ExportDepartmentDataLabel">Export Department</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Filter Form -->
        <form id="frmDepartmentData" >
          <div class="row">
            <div class="col-12 mb-3">
              <div class="form-floating">
                <select class="form-select" name="export_dept_course" id="export_dept_course" required>
                  <option selected disabled value="">Select Course</option>
                  <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science</option>
                  <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                  <option value="Bachelor of Science in Information System">Bachelor of Science in Information System</option>
                  <option value="Bachelor of Science in Information Criminology">Bachelor of Science in Information Criminology</option>
                  <option value="Bachelor of Secondary Education in English">Bachelor of Secondary Education in English</option>
                  <option value="Bachelor of Elementary Education">Bachelor of Elementary Education</option>
                  <option value="Bachelor of Secondary Education in Social Studies">Bachelor of Secondary Education in Social Studies</option>
                  <option value="Bachelor of Secondary Education in Mathematics">Bachelor of Secondary Education in Mathematics</option>
                </select>
                <label for="export_dept_course">Course</label>
              </div>
            </div>

            <div class="col-12 mb-3">
              <div class="form-floating">
                <select class="form-select" name="export_dept_stud_department" id="export_dept_stud_department" required>
                  <option selected disabled value="">Select Department</option>
                  <?php 
                    $get_All_dept = $admin_db->get_AllDepartment();
                    while ($department = $get_All_dept->fetch_array()): ?>
                      <option value="<?=$department['dept_id']; ?>"><?=$department['dept_name']; ?></option>
                  <?php endwhile; ?>
                </select>
                <label for="export_dept_stud_department">Department</label>
              </div>
            </div>

            <div class="col-12 mb-3">
              <div class="form-floating">
                <select class="form-select" name="export_dept_yr_lvl" id="export_dept_yr_lvl" required>
                  <option selected disabled value="">Select Year Level</option>
                  <option value="1st Year">1st Year</option>
                  <option value="2nd Year">2nd Year</option>
                  <option value="3rd Year">3rd Year</option>
                </select>
                <label for="export_dept_yr_lvl">Year Level</label>
              </div>
            </div>

            <div class="col-12 mb-3">
              <!-- <div class="form-floating">
                <select class="form-select" name="export_dept_subject" id="export_dept_subject" required>
                  <option selected disabled value="">Select Subject Code</option>
                  <?php 
                    $get_All_subject = $admin_db->get_All_subject();
                    while ($subject = $get_All_subject->fetch_array()): ?>
                      <option value="<?=$subject['subject_id']; ?>"><?=$subject['course_code']; ?></option>
                  <?php endwhile; ?>
                </select>
                <label for="export_dept_subject">Subject Code</label>
              </div> -->

              <div class="form-group mb-3">
                            <label for="add_stud_subject">All available subject </label>
                            <select class="form-control custom-select-width" name="add_stud_subject" id="add_stud_subject" required style="width:100%;">
                                <?php 
                                $get_All_subject = $admin_db->get_All_subject();
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
                        </div>            </div>
          </div>
          <div class="d-grid">
            <button type="submit" id="BtnExportDeptData" class="btn btn-primary">Export</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<?php
include('../components/admin-footer.php');
?>

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
