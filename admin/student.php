<?php



include('../components/admin-header.php');
include('function/filterdata.php');

$isLogin = false;
if (isset($_SESSION['user_id'])) {
    $student_id = $_SESSION['user_id'];
    $isLogin = true;
}?>

<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light" >
  <div class="container-fluid" >

  
    <h4>Manage Student</h4>

    
  </div>
</nav>



<!-- START -->


<button type="button" class="btn btn-secondary" data-toggle="modal" data-target=".add-student-modal">Add New</button>
<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#MyFilterData">
    <i class="fa fa-filter"></i>
</button>

<!-- Export Button -->
<button id="exportExcel" class="btn btn-success">Export to Excel</button>






           


<!-- Table -->
<div class="table-responsive">
    <table id="myTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>STUDENT ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Course</th>
                <th>Year Level</th>
                <th>Trimester</th>
                <th>School Year</th>
                <th>Section</th>
                <th>Academic Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <h2 class="text-center">List of Students</h2>
            <?php 
                $get_All_student = $admin_db->get_All_student();
                while ($student = $get_All_student->fetch_array()):

                $stud_sem = $student['stud_sem'];
                $stud_sem = str_replace('_t', ' ', $stud_sem);
            ?>
                <tr data-school_year="<?=$student['stud_school_year']?>" data-semester="<?=$student['stud_sem']?>">
                    <td class="text-center"><?=$student['stud_id']; ?></td>
                    <td><?=ucfirst($student['stud_lname']); ?></td>
                    <td><?=ucfirst($student['stud_fname']); ?></td>
                    <td><?=ucfirst($student['stud_mname']); ?></td>
                    <td><?=$student['stud_course']; ?></td>
                    <td><?=$student['stud_year_level'] ?></td>
                    <td><?=$stud_sem;?></td>
                    <td><?=$student['stud_school_year']; ?></td>
                    <td><?=$student['stud_section']; ?></td>
                    <td><?=$student['stud_academic_status']; ?></td>
                    <td>
                        <div id="delLoad-<?=$student['stud_id']?>">
                            <!-- Update Button -->
                            <button type="button" class="btn btn-secondary TogglerUpdateStudent" data-toggle="modal" 
                                data-target=".update-student-modal" 
                                data-stud_id="<?=$student['stud_id']?>"
                                data-fname="<?=$student['stud_fname']?>" 
                                data-mname="<?=$student['stud_mname']?>" 
                                data-lname="<?=$student['stud_lname']?>"

                                data-phone="<?=$student['stud_phone']?>"
                                data-bday="<?=$student['stud_bday']?>"
                                data-address="<?=$student['stud_address']?>"
                                data-gender="<?=$student['stud_gender']?>"

                                data-year_level="<?=$student['stud_year_level']?>"
                                data-stud_school_year="<?=$student['stud_school_year']?>"
                                data-stud_section="<?=$student['stud_section']?>"
                                data-stud_sem="<?=$student['stud_sem']?>"
                                data-stud_academic_status="<?=$student['stud_academic_status']?>"
                                data-stud_course="<?=$student['stud_course']?>"
                            >
                                <i class="fa fa-edit"></i>
                            </button>

                            <!-- View Button -->
                            <button type="button" class="btn btn-secondary view_student" data-stud_id="<?=$student['stud_id']?>">
                                <i class="fa fa-eye"></i>
                            </button>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger TogglerDeleteStudent" data-stud_id="<?=$student['stud_id']?>">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>



<!-- END  -->

</div>






<!-- Update student Modal -->
 
<div class="modal fade update-student-modal" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectLabel">Update Student Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmUpdateStudent" enctype="multipart/form-data">

                    <input hidden type="text" class="form-control" id="update_target_stud_id" name="update_target_stud_id" required>

                    <!--start new added field --->
                    <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="new_update_stud_id" placeholder="Enter Student ID " name="new_update_stud_id" >
                            <label for="new_update_stud_id">Student ID (optional)</label>
                    </div>
                    <!--end new added field --->

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="update_stud_fname" placeholder="Enter First Name" name="update_stud_fname" required >
                        <label for="update_stud_fname">First Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="update_stud_mname" placeholder="Enter Middle Name" name="update_stud_mname" >
                        <label for="update_stud_mname">Middle Name (Optional)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="update_stud_lname" placeholder="Enter Last Name" name="update_stud_lname" required>
                        <label for="update_stud_lname">Last Name</label>
                    </div>

           
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="update_phone_num" placeholder="Enter Phone Number" name="update_phone_num" required>
                        <label for="update_phone_num">Phone Number</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="update_stud_bday" placeholder="Enter Gmail Address" name="update_stud_bday" required>
                        <label for="update_stud_bday">Birthday</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="update_stud_address" placeholder="Enter Address" name="update_stud_address" required></textarea>
                        <label for="update_stud_address">Address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-control" name="update_stud_gender" id="update_stud_gender" required>
                            
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <label for="update_stud_gender">Gender</label>
                    </div>
          



                    <div class="form-floating mb-3">

                        <select class="form-control" name="update_yr_lvl" id="update_yr_lvl" required>
                            
                            <option value="1st year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                            <option value="Graduate">Graduate</option>
                        </select>
                        <label for="update_yr_lvl">Year Level</label>
                    </div>


                    <div class="form-floating mb-3">
                        <select class="form-control" name="edit_sem" id="edit_sem" required>
                            
                            <option value="1st_s">1st Semester</option>
                            <option value="2nd_s">2nd Semester</option>
                            <option value="Summer">Summer</option>
                            <option value="1st_t">1st Trimester</option>
                            <option value="2nd_t">2nd Trimester</option>
                            <option value="3rd_t">3rd Trimester</option>
                        </select><label for="edit_sem">Trimester</label>
                        
                    </div>


                    <div class="form-floating mb-3">
                        <select class="form-control" name="edit_acadStatus" id="edit_acadStatus" required>  
                            <option value="Regular">Regular</option>
                            <option value="Irregular">Irregular</option>
                        </select>
                        <label for="edit_acadStatus">Academic Status</label>
                    </div>



                    <div class="form-floating mb-3">
                        <select class="form-select" id="update_stud_Sy" name="update_stud_Sy" aria-label="School Year" required>
                            <option value="" selected disabled>Select School Year</option>
                            <!-- Populate options with PHP -->
                            <?php
                            $schoolYears = generateSchoolYears(2021, 2025);
                            foreach ($schoolYears as $year) {
                                echo "<option value=\"$year\">$year</option>";
                            }
                            ?>
                        </select>
                        <label for="update_stud_Sy">School Year</label>
                    </div>


                    <div class="form-floating mb-3">
                    <select class="form-control" name="update_stud_course" id="update_stud_course" required>
                  <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science</option>
                  <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                  <option value="Bachelor of Science in Information System">Bachelor of Science in Information System</option>
                  <option value="Bachelor of Science in Criminology">Bachelor of Science in Criminology</option>
                  <option value="Bachelor of Secondary Education Major in English">Bachelor of Secondary Education Major in English</option>
                  <option value="Bachelor of Elementary Education">Bachelor of Elementary Education</option>
                  <option value="Bachelor of Secondary Education Major in Social Studies">Bachelor of Secondary Education Major in Social Studies</option>
                  <option value="Bachelor of Secondary Education Major in Mathematics">Bachelor of Secondary Education Major in Mathematics</option>
                  <option value="Master of Arts in Education Major in Educational Management">Master of Arts in Education Major in Educational Management</option>
                  <option value="Master of Arts in Education Major in Administration and Supervision">Master of Arts in Education Major in Administration and Supervision</option>
                  <option value="Bachelor of Science in Business Administration Major in Marketing Management">Bachelor of Science in Business Administration Major in Marketing Management</option>
                  <option value="Bachelor of Science in Business Administration Major in Financial Management">Bachelor of Science in Business Administration Major in Financial Management</option>
                  <option value="Bachelor of Science in Business Administration Major in Human Resource Development Management">Bachelor of Science in Business Administration Major in Human Resource Development Management</option>
                  <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy</option>
                    </select>

                        <label for="update_stud_course">Course</label>
                    </div>
                    
                <!--start new added field --->
                    <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="update_stud_section" placeholder="" name="update_stud_section" >
                        <label for="update_stud_section">Section (USE ALL UPPERCASE)</label>
                    </div>
                 <!--end new added field --->
                    <div class="form-floating mb-3 text-center">
                        <button type="submit" class="btn btn-success" id="btnUpdateStudent">Update Student</button>
                        <div class="loading-spinner" id="loading-spinner" style="display:none;">
                            <div class="spinner"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add Student Modal -->
<div class="modal fade add-student-modal" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectLabel">Add New Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAddStudent" enctype="multipart/form-data">

               

                   <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_stud_id" placeholder="Enter Student ID " name="add_stud_id" >
                        <label for="add_stud_id">Student ID (optional)</label>
                    </div>



                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_stud_fname" placeholder="Enter First Name" name="add_stud_fname" required >
                        <label for="add_stud_fname">First Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_stud_mname" placeholder="Enter Middle Name" name="add_stud_mname" >
                        <label for="add_stud_mname">Middle Name (Optional)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_stud_lname" placeholder="Enter Last Name" name="add_stud_lname" required>
                        <label for="add_stud_lname">Last Name</label>
                    </div>

                   
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_phone_num" placeholder="Enter Phone Number" name="add_stud_phone" required>
                        <label for="add_phone_num">Phone Number</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="add_stud_bday" placeholder="Enter Birthday" name="add_stud_bday" required>
                        <label for="add_stud_bday">Birthday</label>
                    </div>


                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="add_address" placeholder="Enter Address" name="add_stud_address" required></textarea>
                        <label for="add_address">Address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-control" name="add_stud_gender" id="add_stud_gender" required>
                            
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <label for="add_stud_gender">Gender</label>
                    </div>




                    <div class="form-floating mb-3">
                        <select class="form-control" name="add_yr_lvl" id="add_yr_lvl" required>
                            
                            <option value="1st year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                            <option value="Graduate">Graduate</option>
                        </select>
                        <label for="add_yr_lvl">Year Level</label>
                    </div>



                    <div class="form-floating mb-3">
                        <select class="form-control" name="edit_sem" id="edit_sem" required>
                            
                            <option value="1st_s">1st Semester</option>
                            <option value="2nd_s">2nd Semester</option>
                            <option value="Summer">Summer</option>
                            <option value="1st_t">1st Trimester</option>
                            <option value="2nd_t">2nd Trimester</option>
                            <option value="3rd_t">3rd Trimester</option>
                        </select><label for="edit_sem">Trimester</label>
                        
                    </div>


                    <div class="form-floating mb-3">
                        <select class="form-control" name="add_acadStatus" id="add_acadStatus" required>  
                            <option value="Regular">Regular</option>
                            <option value="Irregular">Irregular</option>
                        </select>
                        <label for="add_acadStatus">Academic Status</label>
                    </div>


                    <div class="form-floating mb-3">
                        <select class="form-select" id="add_stud_Sy" name="add_stud_Sy" aria-label="School Year" required>
                            <option value="" selected disabled>Select School Year</option>
                            <!-- Populate options with PHP -->
                            <?php
                            $schoolYears = generateSchoolYears(2021, 2025); // Adjust range if needed
                            foreach ($schoolYears as $year) {
                                echo "<option value=\"$year\">$year</option>";
                            }
                            ?>
                        </select>
                        <label for="add_stud_Sy">School Year</label>
                    </div>


                    <div class="form-floating mb-3">
                    <select class="form-control" name="update_stud_course" id="update_stud_course" required>
                  <option value="Bachelor of Science in Computer Science">Bachelor of Science in Computer Science</option>
                  <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                  <option value="Bachelor of Science in Information System">Bachelor of Science in Information System</option>
                  <option value="Bachelor of Science in Criminology">Bachelor of Science in Criminology</option>
                  <option value="Bachelor of Secondary Education Major in English">Bachelor of Secondary Education Major in English</option>
                  <option value="Bachelor of Elementary Education">Bachelor of Elementary Education</option>
                  <option value="Bachelor of Secondary Education Major in Social Studies">Bachelor of Secondary Education Major in Social Studies</option>
                  <option value="Bachelor of Secondary Education Major in Mathematics">Bachelor of Secondary Education Major in Mathematics</option>
                  <option value="Master of Arts in Education Major in Educational Management">Master of Arts in Education Major in Educational Management</option>
                  <option value="Master of Arts in Education Major in Administration and Supervision">Master of Arts in Education Major in Administration and Supervision</option>
                  <option value="Bachelor of Science in Business Administration Major in Marketing Management">Bachelor of Science in Business Administration Major in Marketing Management</option>
                  <option value="Bachelor of Science in Business Administration Major in Financial Management">Bachelor of Science in Business Administration Major in Financial Management</option>
                  <option value="Bachelor of Science in Business Administration Major in Human Resource Development Management">Bachelor of Science in Business Administration Major in Human Resource Development Management</option>
                  <option value="Bachelor of Science in Accountancy">Bachelor of Science in Accountancy</option>
                    </select>

                        <label for="update_stud_course">Course</label>
                    </div>


                <!--start new added field --->
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_stud_section" placeholder="" name="add_stud_section" >
                        <label for="add_stud_section">Section (USE ALL UPPERCASE)</label>
                    </div>
                <!--end new added field --->


                    <div class="form-floating mb-3 text-center">
                        <button type="submit" class="btn btn-success" id="btnAddstudent">Add Student</button>
                        <div class="loading-spinner" id="loading-spinner" style="display:none;">
                            <div class="spinner"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="MyFilterData" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filter Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Filter Form -->
        <form id="filterForm" class="form">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="schoolYear">School Year</label>
              <select id="schoolYear" class="form-control">
                <!-- Populate options with PHP -->
                <?php foreach ($schoolYears as $year) {
                  echo "<option value=\"$year\">$year</option>";
                } ?>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="semester">Trimester</label>
              <select id="semester" class="form-control">
                <?php
                $semesters = ['1st', '2nd', '3rd'];
                foreach ($semesters as $sem) {
                  echo "<option value=\"$sem\">$sem</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-12">
              <button type="button" id="filterButton" class="btn btn-primary">Filter</button>
              <button type="button" class="btn btn-secondary btnReset ml-2">Reset</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>




<?php

include('../components/admin-footer.php');


?>

<!-- Script -->
 
<script>
document.getElementById('exportExcel').addEventListener('click', function() {
  window.location.href = 'function/export_students.php'; 
});

</script>
