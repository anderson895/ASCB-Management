<?php
include('../db/class.php');
$db = new global_class();


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['SubmitType'])) {
        if ($_POST['SubmitType'] == 'Login') {
            if ($_POST['SubmitType'] == 'Login') {
                $password = $_POST['password'];
                $loginResult = $db->login($_POST['username']);
                
                if ($loginResult->num_rows > 0) {
                    $user = $loginResult->fetch_assoc();
                    
                    if (password_verify($password, $user['password'])) {
                        session_start();
                        $_SESSION['admin_id'] = $user['admin_id'];
                        $_SESSION['USERNAME'] = $user['username'];
                        
                        $response['status'] = 'success';
                        $response['message'] = 'Login successful';
                        $response['user'] = array(
                            'username' => $user['username'],
                            'admin_id' => $user['admin_id'],
                            'type' => $user['type']
                        );
                    } else {
                        $response['status'] = 'error';
                        $response['message'] = 'Login Failed super admin';
                    }
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Login Failed';
                }
            } else {
                $response['status'] = 'info';
                $response['message'] = 'test';
            }

            echo json_encode($response);
            
        } elseif ($_POST['SubmitType'] == 'AddSubject') {


            $addSubject = $db->AddSubject(
                $_POST['stud_department'],
                $_POST['course_code'], 
                $_POST['descriptive_title'],
                $_POST['units'],
                $_POST['pre_requisiteL'],
                $for_yr_lvl=$_POST['for_yr_lvl']
            );
            if ($addSubject == 200) {  
                
                echo 200;
            }

        } elseif ($_POST['SubmitType'] == 'UpdateSubject') {
            

         
            $editSubject = $db->EditSubject(
                $_POST['stud_department'],
                $_POST['subject_id'],
                $_POST['course_code'],
                $_POST['descriptive_title'],
                $_POST['units'],
                $_POST['pre_requisiteL'],
                $_POST['for_year_level']
            );
            if ($editSubject == 200) {  
                
                echo 200;
            }
         
        } elseif ($_POST['SubmitType'] == 'AddUser') {
                                                                
                        $fname = $_POST['add_user_fname'];
                        $mname = $_POST['add_user_mname'];
                        $lname = $_POST['add_user_lname'];
                        $email = $_POST['add_user_email'];
                        $username = $_POST['add_user_username'];
                        $password = $_POST['add_user_password'];

                        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                        $profile_img = '';

                        $emailExists = $db->checkEmailExists($email);
                        if ($emailExists) {
                            echo 'EmailAlready';
                            exit;
                        }

                        $userNameExists = $db->checkUserNameExists($username);
                        if ($userNameExists) {
                            echo 'UserNameAlready';
                            exit;
                        }

                        $result = $db->addUser($fname, $mname, $lname, $email, $username, $hashedPassword, $profile_img);

                        if ($result) {
                            if (isset($_FILES['add_user_profile_img']) && $_FILES['add_user_profile_img']['error'] === UPLOAD_ERR_OK) {
                                $uploadDir = '../assets/admin_upload/'; 
                                
                                $fileExtension = pathinfo($_FILES['add_user_profile_img']['name'], PATHINFO_EXTENSION);
                                $uniqueFilename = uniqid('profile_', true) . '.' . $fileExtension;
                                $uploadFile = $uploadDir . $uniqueFilename;
                                
                                if (move_uploaded_file($_FILES['add_user_profile_img']['tmp_name'], $uploadFile)) {
                                    $profile_img = $uniqueFilename;
                                    $updateResult = $db->addUserProfileImage($username, $profile_img);

                                    if ($updateResult) {
                                        echo '200';
                                    } else {
                                        echo 'Error updating profile image';
                                    }
                                } else {
                                    echo 'File upload failed';
                                }
                            } else {
                                if ($_FILES['add_user_profile_img']['error'] !== UPLOAD_ERR_NO_FILE) {
                                    echo 'File upload error: ' . $_FILES['add_user_profile_img']['error'];
                                } else {
                                    echo '200'; 
                                }
                            }
                        } else {
                            echo 'Error adding user';
                        }
          
        } elseif ($_POST['SubmitType'] == 'EditUser') {
                                                                
               //// Get form data
$admin_id = $_POST['edit_admin_id'];
$fname = $_POST['edit_user_fname'];
$mname = $_POST['edit_user_mname'];
$lname = $_POST['edit_user_lname'];
$email = $_POST['edit_user_email'];
$username = $_POST['edit_user_username'];
$profile_img = ''; 

$result = $db->UpdateUser($admin_id, $fname, $mname, $lname, $email, $username, $profile_img);

if ($result) {
    $existingProfileImg = $db->getUserProfileImage($admin_id); 

    if (isset($_FILES['edit_user_profile_img']) && $_FILES['edit_user_profile_img']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/admin_upload/'; 

        $fileExtension = pathinfo($_FILES['edit_user_profile_img']['name'], PATHINFO_EXTENSION);
        $uniqueFilename = uniqid('profile_', true) . '.' . $fileExtension;
        $uploadFile = $uploadDir . $uniqueFilename;

        if (move_uploaded_file($_FILES['edit_user_profile_img']['tmp_name'], $uploadFile)) {
            $profile_img = $uniqueFilename;

            if (!empty($existingProfileImg) && file_exists($uploadDir . $existingProfileImg)) {
                unlink($uploadDir . $existingProfileImg);
            }
            $updateResult = $db->updateUserProfileImage($admin_id, $username, $profile_img);

            if ($updateResult) {
                echo '200'; 
            } else {
                echo 'Error updating profile image';
            }
        } else {
            echo 'File upload failed';
        }
    } else {
        echo '200';
    }
} else {
    echo 'Error adding user';
}


        } elseif ($_POST['SubmitType'] == 'DeleteSubject') {

             $db->deleteSub($_POST['subject_id']);

                echo 200;
        } elseif ($_POST['SubmitType'] == 'deactivateDepartment') {

             $db->deleteDept($_POST['dept_id']);

                echo 200;
        } elseif ($_POST['SubmitType'] == 'deactivateUser') {

             $db->deactivateUser($_POST['admin_id']);
       
                echo 200;
        }elseif ($_POST['SubmitType'] == 'deactivateStudent') {

            $db->deactivateStudent($_POST['stud_id']);
      
               echo 200;
       } elseif ($_POST['SubmitType'] == 'AddStudent') {    
        
            
                                     
                                        $fname = $_POST['add_stud_fname'];
                                        $mname = $_POST['add_stud_mname'];
                                        $lname = $_POST['add_stud_lname'];
                                        $yr_lvl = $_POST['add_yr_lvl'];
                                        $add_stud_Sy = $_POST['add_stud_Sy'];
                                        $add_sem = $_POST['add_sem'];
                                        $add_acadStatus = $_POST['add_acadStatus'];
                                        $stud_course = $_POST['stud_course'];

                                        //start new added
                                        $stud_phone = $_POST['add_stud_phone'];
                                        $stud_email = $_POST['add_stud_email'];
                                        $stud_address = $_POST['add_stud_address'];
                                        $stud_gender = $_POST['add_stud_gender'];
                                        //end new added
                                       

                                        $result = $db->addStudent($stud_course, $fname, $mname, $lname,$stud_phone, $stud_email,$stud_address,$stud_gender,$yr_lvl,$add_stud_Sy,$add_sem,$add_acadStatus);
                                        if ($result) {
                                            echo '200'; 
                                        }
                                       
                            } elseif ($_POST['SubmitType'] == 'EditStudent'){

                                
                                                        $stud_id = $_POST['update_stud_id'];
                                                        $fname = $_POST['update_stud_fname'];
                                                        $mname = $_POST['update_stud_mname'];
                                                        $lname = $_POST['update_stud_lname'];
                                                        $yr_lvl = $_POST['update_yr_lvl'];

                                                        $sem = $_POST['edit_sem'];
                                                        $acadStatus = $_POST['edit_acadStatus'];

                                                        $stud_Sy= $_POST['update_stud_Sy'];
                                                        $stud_course = $_POST['update_stud_course'];
                                    
                                                        
                                                        //start new added
                                                        $stud_phone = $_POST['update_phone_num'];
                                                        $stud_email = $_POST['update_stud_email'];
                                                        $stud_address = $_POST['update_stud_address'];
                                                        $stud_gender = $_POST['update_stud_gender'];
                                                        //end new added
                                        
                                        $result = $db->UpdateStudent($stud_id, $stud_course, $fname, $mname, $lname,$stud_phone, $stud_email,$stud_address,$stud_gender,$yr_lvl,$stud_Sy,$sem,$acadStatus);
                                        

                                        
                                        if ($result) {
                                                        echo '200'; 
                                        } else {
                                            echo 'Error adding user';
                                        }
                                        
                 
                         }elseif($_POST['SubmitType'] == 'AddStudentsSubject'){

                            $stud_id=$_POST['stud_id'];
                            $subject_id =$_POST['subject_id'];

                                        $result = $db->AddStudentsSubject($stud_id, $subject_id);

                                        echo "200";

                            
                         }elseif($_POST['SubmitType'] == 'DeleteStudentSubject'){

                            $ss_id=$_POST['ss_id'];
                          

                                        $result = $db->DeleteStudentsSubject($ss_id);

                                        echo "200";

                            
                         }elseif($_POST['SubmitType'] == 'AddDepartment'){

                            $dept_name=$_POST['dept_name'];
                            $dept_description =$_POST['dept_description'];

                                        $result = $db->AddDepartment($dept_name, $dept_description);

                                        echo "200";

                            
                         }elseif($_POST['SubmitType'] == 'EditDepartment'){

                            $dept_id=$_POST['dept_id'];
                            $dept_name=$_POST['dept_name'];
                            $dept_description =$_POST['dept_description'];

                                        $result = $db->EdiDepartment($dept_id,$dept_name, $dept_description);

                                        echo "200";

                            
                         }elseif ($_POST['SubmitType'] == 'UpdateAdminProfile') {
                                                                
            $profile_id = $_POST['update_profile_id'];
             $profile_fname = $_POST['update_profile_fname'];
             $profile_mname = $_POST['update_profile_mname'];
             $profile_lname = $_POST['update_profile_lname'];
             $profile_email = $_POST['update_profile_email'];
             $profile_username = $_POST['update_profile_username'];
             $profile_password = $_POST['update_profile_password'];

             $hashed_password = password_hash($profile_password, PASSWORD_DEFAULT);
             
             $profile_img = ''; 
             
             $result = $db->UpdateProfile($profile_id, $profile_fname, $profile_mname, $profile_lname, $profile_email, $profile_username,$hashed_password);
             
             if ($result) {
                 $existingProfileImg = $db->getUserProfileImage($profile_id); 
             
                 if (isset($_FILES['update_profile_img']) && $_FILES['update_profile_img']['error'] === UPLOAD_ERR_OK) {
                     $uploadDir = '../assets/admin_upload/'; 
             
                     $fileExtension = pathinfo($_FILES['update_profile_img']['name'], PATHINFO_EXTENSION);
                     $uniqueFilename = uniqid('profile_', true) . '.' . $fileExtension;
                     $uploadFile = $uploadDir . $uniqueFilename;
             
                     if (move_uploaded_file($_FILES['update_profile_img']['tmp_name'], $uploadFile)) {
                         $profile_img = $uniqueFilename;
             
                         if (!empty($existingProfileImg) && file_exists($uploadDir . $existingProfileImg)) {
                             unlink($uploadDir . $existingProfileImg);
                         }
                         $updateResult = $db->updateUserProfileImage($profile_id, $profile_username, $profile_img);
             
                         if ($updateResult) {
                             echo '200'; 
                         } else {
                             echo 'Error updating profile image';
                         }
                     } else {
                         echo 'File upload failed';
                     }
                 } else {
                     echo '200';
                 }
             } else {
                 echo 'Error adding user';
             }
             
             
                     }elseif ($_POST['SubmitType'] == 'updateSubGrade') {

                        $ss_id = $_POST['ss_id'];
                        $SubGrade = $_POST['SubGrade'];


                        $result = $db->UpdateSubGrade($ss_id,$SubGrade);
                                        
                        if ($result) {
                            echo "200";
                        }
                     }




                         
        
    }
}
