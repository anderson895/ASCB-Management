





<!-- Update User Modal -->
<div class="modal fade edit-user-modal" tabindex="-1" role="dialog" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserLabel">Update Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditAdmin" enctype="multipart/form-data">

                    <input hidden type="text" class="form-control" id="edit_admin_id" name="edit_admin_id" required>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edit_user_fname" placeholder="Enter First Name" name="edit_user_fname" required>
                        <label for="edit_user_fname">First Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edit_user_mname" placeholder="Enter Middle Name" name="edit_user_mname" >
                        <label for="edit_user_mname">Middle Name (Optional)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edit_user_lname" placeholder="Enter Last Name" name="edit_user_lname" required>
                        <label for="edit_user_lname">Last Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edit_user_email" placeholder="Enter Email" name="edit_user_email" required>
                        <label for="edit_user_email">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edit_user_username" placeholder="Enter Username" name="edit_user_username" required>
                        <label for="edit_user_username">username</label>
                    </div>


                  

                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" name="edit_user_profile_img" id="edit_user_profile_img" >
                        <label for="edit_user_profile_img">Profile image</label>
                    </div>

                    <div class="form-floating mb-3 text-center">
                        <button type="submit" class="btn btn-success" id="btnEditAdmin">Update Information</button>
                        <div id="loading-spinner" style="display:none;">
                            <div class="spinner"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Add User Modal -->
<div class="modal fade add-user-modal" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectLabel">Add New Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAddAdmin" enctype="multipart/form-data">


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_user_fname" placeholder="Enter First Name" name="add_user_fname" required>
                        <label for="add_user_fname">First Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_user_mname" placeholder="Enter Middle Name" name="add_user_mname" >
                        <label for="add_user_mname">Middle Name (Optional)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_user_lname" placeholder="Enter Last Name" name="add_user_lname" required>
                        <label for="add_user_lname">Last Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_user_email" placeholder="Enter Email" name="add_user_email" required>
                        <label for="add_user_email">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_user_username" placeholder="Enter Username" name="add_user_username" required>
                        <label for="add_user_username">username</label>
                    </div>


                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="add_user_password" placeholder="Enter Username" name="add_user_password" required>
                        <label for="add_user_password">password</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="file" class="form-control" name="add_user_profile_img" id="add_user_profile_img" required>
                        <label for="add_user_profile_img">Profile image</label>
                    </div>

                    <div class="form-floating mb-3 text-center">
                        <button type="submit" class="btn btn-success" id="btnAddAdmin">Add Admin</button>
                        <div class="loading-spinner" id="loading-spinner" style="display:none;">
                            <div class="spinner"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>











<!-- Add Department Modal -->
<div class="modal fade add-department-modal" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectLabel">Add New Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAddDepartment">


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_dept_name" placeholder="Enter Department Name" name="add_dept_name" required>
                        <label for="add_dept_name">Department Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_dept_description" placeholder="Enter Description" name="add_dept_description" required>
                        <label for="add_dept_description">Description</label>
                    </div>

                  
                   
                    <div class="form-floating mb-3 text-center">
                        <button type="submit" class="btn btn-success" id="btnAddDepartment">Add Department</button>
                        
                        <div class="loading-spinner" style="display:none; text-align:center;">
                            <div class="spinner-border mt-3 text-primary" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- Update Departmentt Modal -->
<div class="modal fade edit-department-modal" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectLabel">Update Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditDepartment">

                        <input hidden type="text" class="form-control" id="edit_dept_id" name="edit_dept_id" required>

                        
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edit_dept_name" placeholder="Enter Department Name" name="edit_dept_name" required>
                        <label for="edit_dept_name">Department Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edit_dept_description" placeholder="Enter Description" name="edit_dept_description" required>
                        <label for="edit_dept_description">Description</label>
                    </div>

                  
                   
                    <div class="form-floating mb-3 text-center">
                        <button type="submit" class="btn btn-success" id="btnEditDepartment">Add Department</button>
                        
                        <div class="loading-spinner" style="display:none; text-align:center;">
                            <div class="spinner-border mt-3 text-primary" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Add Subject Modal -->
<div class="modal fade add-subject-modal" tabindex="-1" role="dialog" aria-labelledby="addSubjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectLabel">Add New Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAddSubject">


                    <div class="form-floating mb-3">
                    <select class="form-control" name="add_stud_department" id="add_stud_department" required>
                            <?php 
                        $get_All_dept = $admin_db->get_AllDepartment();
                        while ($department = $get_All_dept->fetch_array()): ?>
                        
                                    <option value="<?=$department['dept_id']; ?>"><?=$department['dept_name']; ?></option>
                                
                    <?php endwhile; ?>
                    </select>
                                <label for="add_stud_department">Department</label>
                    </div>



                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_course_code" placeholder="Enter Course Code" name="course_code" required>
                        <label for="add_course_code">Course Code</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_descriptive_title" placeholder="Enter Descriptive Title" name="descriptive_title" >
                        <label for="add_descriptive_title">Descriptive Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="add_units" placeholder="Enter Units" name="units">
                        <label for="add_units">Units</label>
                    </div>



                  

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="add_pre_requisite" placeholder="Enter Pre-requisite" name="pre_requisite">
                        <label for="add_pre_requisite">Pre-Requisite</label>
                    </div>


                    <div class="form-floating mb-3">
                      
                        <select class="form-control" name="for_yr_lvl" id="for_yr_lvl" required>
                            
                            <option value="1st year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                            <option value="Graduate">Graduate</option>
                        </select>
                        <label for="for_yr_lvl">Subject For</label>
                    </div>

                    <div class="form-floating mb-3 text-center">
                        <button type="submit" class="btn btn-success" id="btnAddSubject">Add Subject</button>
                        
                        <div class="loading-spinner" style="display:none; text-align:center;">
                            <div class="spinner-border mt-3 text-primary" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





<!-- Edit Subject Modal -->
<div class="modal fade edit-subject-modal" tabindex="-1" role="dialog" aria-labelledby="editSubjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubjectLabel">Update Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditSubject">

                    <div class="form-floating mb-3">
                        <select class="form-control" name="edit_stud_department" id="edit_stud_department" required>
                                <?php 
                            $get_All_dept = $admin_db->get_AllDepartment();
                            while ($department = $get_All_dept->fetch_array()): ?>
                            
                                        <option value="<?=$department['dept_id']; ?>"><?=$department['dept_name']; ?></option>
                                    
                        <?php endwhile; ?>
                        </select>
                                <label for="edit_stud_department">Department</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="hidden" class="form-control" name="edit_subject_id" id="edit_subject_id">
                        <input type="text" class="form-control" id="edit_course_code" placeholder="Enter Course Code" name="course_code" required>
                        <label for="edit_course_code">Course Code</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edit_descriptive_title" placeholder="Enter Descriptive Title" name="descriptive_title">
                        <label for="edit_descriptive_title">Descriptive Title</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="edit_units" placeholder="Enter Units" name="units">
                        <label for="edit_units">Units</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="edit_pre_requisite" placeholder="Enter Pre-requisite" name="pre_requisite">
                        <label for="edit_pre_requisite">Pre-Requisite</label>
                    </div>

                    <div class="form-floating mb-3">
                      
                      <select class="form-control" name="edit_for_year_level" id="edit_for_year_level" required>
                          
                          <option value="1st year">1st Year</option>
                          <option value="2nd Year">2nd Year</option>
                          <option value="3rd Year">3rd Year</option>
                          <option value="4th Year">4th Year</option>
                          <option value="Graduate">Graduate</option>
                      </select>
                      <label for="edit_for_year_level">Subject For</label>
                  </div>


                    <div class="form-floating mb-3 text-center">
                        <button type="submit" class="btn btn-success" id="btnEditSubject">Update Subject</button>

                        <div class="loading-spinner" style="display:none; text-align:center;">
                            <div class="spinner-border mt-3 text-primary" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>







<!-- Edit Subject Modal -->
<div class="modal add-Subgrade-modal" tabindex="-1" role="dialog" aria-labelledby="editAddStudentgradeLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAddStudentgradeLabel"> <span id="subjectTarget">subjectTarget</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAddStudentgrade">

                    <div hidden class="form-floating mb-3">
                        <input type="text" class="form-control" name="stud_id" id="stud_id" placeholder="stud_id">
                        <label for="stud_id">stud_id</label>
                    </div>

                    <div hidden class="form-floating mb-3">
                        <input type="text" class="form-control" name="ss_id" id="ss_id" placeholder="ss_id">
                        <label for="ss_id">ss_id</label>
                    </div>
                   


                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="SubGrade" id="SubGrade" placeholder="Enter grade" required>
                        <label for="SubGrade">Subject grade</label>
                    </div>

                                <button type="submit" class="btn btn-secondary mt-2" id="btnGradeSave">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>






<script src="../node_modules/alertifyjs/build/alertify.min.js"></script>


<script src="../js/jquery-3.5.1.slim.min.js"></script>
<script src="../node_modules/@popperjs/core/dist/umd/popper.min.js"></script>

<script src="../js/jquery.min.js"></script>

<script src="../js/4.5.2/js/bootstrap.min.js"></script>


<script src="../js/main.js"></script>

<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/dataTables.js"></script>
<script src="../js/dataTables.bootstrap5.js"></script>

<script>
    new DataTable('#myTable');

</script>



