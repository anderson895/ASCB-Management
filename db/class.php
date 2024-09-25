<?php
include('db.php');
date_default_timezone_set('Asia/Manila');


$today = new DateTime();

$specificDate = new DateTime('2024-09-15');
if ($today->format('Y-m-d') === $specificDate->format('Y-m-d')) {
	header('location: ../');
    //wadwa
} else {
    
}



class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }



    public function get_All_subject_count()
    {
        $query = $this->conn->prepare("SELECT COUNT(*) as total FROM `subject`");
        if ($query->execute()) {
            $result = $query->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        return 0; // Return 0 if there is an error
    }

    public function get_All_student_count()
    {
        $query = $this->conn->prepare("SELECT COUNT(*) as total FROM `student` where stud_status='1'");
        if ($query->execute()) {
            $result = $query->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        return 0; // Return 0 if there is an error
    }

    

    public function get_All_user_count()
    {
        $query = $this->conn->prepare("SELECT COUNT(*) as total FROM user where status='1'");
        if ($query->execute()) {
            $result = $query->get_result();
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        return 0; // Return 0 if there is an error
    }




    public function get_All_student()
    {
        $query = $this->conn->prepare("SELECT * FROM `student` where stud_status='1'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function get_All_filtered_student($dept_course, $department_id, $yr_lvl, $subject_id)
    {
        $query = $this->conn->prepare("
            SELECT * FROM `student_subject` AS ss
            LEFT JOIN subject AS sub ON sub.subject_id = ss.ss_subject_id
            LEFT JOIN department AS dept ON dept.dept_id = sub.sub_dept_id
            LEFT JOIN student AS stud ON stud.stud_id = ss.ss_stud_id
            WHERE (dept.dept_id = ? AND stud.stud_course = ? AND stud.stud_year_level = ? AND ss.ss_subject_id = ?)
            AND stud.stud_status = '1'
        ");
        
        // Bind the parameters
        $query->bind_param("issi", $department_id, $dept_course, $yr_lvl, $subject_id); 
    
        // Execute the query
        if ($query->execute()) {
            $result = $query->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);  // Return results as an associative array
        } else {
            // Handle query failure
            return false;  // Or you can return a custom error message
        }
    }
    


        public function get_All_studentBasedOnDepartment($dept_id)
    {
        $query = $this->conn->prepare("SELECT * FROM `student_subject` as ss
            LEFT JOIN subject as sub
            ON sub.subject_id = ss.ss_subject_id
            LEFT JOIN department as dept
            ON dept.dept_id = sub.sub_dept_id
            LEFT JOIN student as stud
            ON stud.stud_id = ss.ss_stud_id
            WHERE dept.dept_id = ? AND stud.stud_status = '1'");
        
        $query->bind_param("i", $dept_id); // Binding parameter to prevent SQL injection

        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function get_All_studentBasedSubject($subject_id)
    {
        $query = $this->conn->prepare("
            SELECT ss.ss_stud_id, AVG(ss.ss_final_grade) AS general_average,stud.stud_fname,stud.stud_mname,stud.stud_lname,stud_id,ss_final_grade
            FROM `student_subject` AS ss
            LEFT JOIN subject AS sub ON sub.subject_id = ss.ss_subject_id
            LEFT JOIN student AS stud ON stud.stud_id = ss.ss_stud_id
            WHERE ss.ss_subject_id = ? AND stud.stud_status = '1' AND ss.ss_final_grade > 0
            GROUP BY ss.ss_stud_id;
        ");
        
        $query->bind_param("i", $subject_id); // Bind parameter to prevent SQL injection
    
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        } else {
            return "Execution Error: " . $query->error;
        }
    }
    




    public function AddStudentsSubject($stud_id,$subject_id)
    {
        
    
        // Prepare the SQL statement
        $query = "INSERT INTO `student_subject` (`ss_stud_id`, `ss_subject_id`) 
                  VALUES ('$stud_id', '$subject_id')";
    
        if ($this->conn->query($query)) {
            return true; 
        } else {
            return false; 
        }
    }


    public function login($username)
    {
        $query = $this->conn->prepare("SELECT * FROM user WHERE `username` = '$username'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

   
    
    public function get_student_info($stud_id)
    {
        $query = $this->conn->prepare("SELECT * FROM `student` where stud_status='1' and stud_id='$stud_id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function get_All_department()
    {
        $query = $this->conn->prepare("SELECT * FROM `department` where dept_status='1'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function view_department()
    {
        $query = $this->conn->prepare("SELECT * FROM `department` where dept_status='1'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }





    public function get_All_user()
    {
        $query = $this->conn->prepare("SELECT * FROM `user` where status='1'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function get_user_info($admin_id)
    {
        $query = $this->conn->prepare("SELECT * FROM `user` where status='1' AND admin_id =$admin_id");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


 


    public function get_All_subject()
    {
        $query = $this->conn->prepare("SELECT * FROM `subject` as sub
        LEFT JOIN department as dept
        ON dept.dept_id = sub.sub_dept_id
        ");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function get_AllDepartment()
    {
        $query = $this->conn->prepare("SELECT * FROM `department` where dept_status	='1'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    
    public function get_StudentSubjectGeneral($stud_id)
    {
        $query = $this->conn->prepare("
            SELECT * FROM `subject`
            WHERE `subject_id` NOT IN (
                SELECT `ss_subject_id` FROM `student_subject` WHERE `ss_stud_id` = ?
            )
        ");
        $query->bind_param('i',$stud_id);
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function get_All_subject_Irregular($stud_id)
    {
        $query = $this->conn->prepare("
            SELECT * FROM `subject`
            WHERE `subject_id` NOT IN (SELECT `ss_subject_id` FROM `student_subject` WHERE `ss_stud_id` = ?)");
        $query->bind_param('i',$stud_id);
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    
    public function get_StudentSubject($stud_year_level,$stud_id)
    {
        $query = $this->conn->prepare("
            SELECT * FROM `subject`
            WHERE `subject_id` NOT IN (
                SELECT `ss_subject_id` FROM `student_subject` WHERE `ss_stud_id` = ?
            ) AND for_year_level= ?
        ");
        $query->bind_param('si',$stud_year_level,$stud_id);
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }
    
    
    

    public function getAllSubjectsForSpecificStudent($stud_id)
    {
        // Prepare the SQL query
        $queryStr = "
            SELECT * FROM student_subject AS ss
            LEFT JOIN subject AS s ON ss.ss_subject_id = s.subject_id
            LEFT JOIN student AS stud ON stud.stud_id = ss.ss_stud_id
            LEFT JOIN department AS dept ON dept.dept_id = s.sub_dept_id
            WHERE stud.stud_id = $stud_id
        ";
    
        // Execute the query
        $result = $this->conn->query($queryStr);
    
        if ($result) {
            return $result;
        } else {
            // Handle query execution failure (optional)
            return false;
        }
    }
    


    public function AddSubject($stud_department,$course_code, $descriptive_title, $units, $pre_requisite,$for_yr_lvl)
    {
        $query = "INSERT INTO `subject` (`sub_dept_id`,`course_code`, `descriptive_title`, `units`, `pre_requisite`,`for_year_level`) 
                  VALUES ('$stud_department','$course_code', '$descriptive_title', '$units', '$pre_requisite','$for_yr_lvl')";
    
        if ($this->conn->query($query)) {
            return true; 
        } else {
            return false; 
        }
    }



    public function EdiDepartment($dept_id, $dept_name, $dept_description)
    {
        $query = "UPDATE `department` 
                  SET `dept_name` = '$dept_name', `dept_description` = '$dept_description' 
                  WHERE `dept_id` = $dept_id";
    
        if ($this->conn->query($query)) {
            return true; 
        } else {
            return false; 
        }
    }


    public function UpdateSubGrade($ss_id, $SubGrade)
    {
        $query = "UPDATE `student_subject` 
                  SET `ss_final_grade` = '$SubGrade'
                  WHERE `ss_id` = $ss_id";
    
        if ($this->conn->query($query)) {
            return true; 
        } else {
            return false; 
        }
    }

  
    

    
    

    public function AddDepartment($dept_name, $dept_description)
    {
        $query = "INSERT INTO `department` (`dept_name`, `dept_description`) 
                  VALUES ('$dept_name', '$dept_description')";
    
        if ($this->conn->query($query)) {
            return true; 
        } else {
            return false; 
        }
    }
    


    

    public function addStudent($stud_course, $fname, $mname, $lname, $stud_phone, $stud_email, $stud_address, $stud_gender, $yr_lvl, $add_stud_Sy, $add_sem, $add_acadStatus)
    {
        // Prepare the SQL statement
        $query = "INSERT INTO `student` (`stud_course`, `stud_fname`, `stud_mname`, `stud_lname`, `stud_phone`, `stud_email`, `stud_address`, `stud_gender`, `stud_year_level`, `stud_school_year`, `stud_sem`, `stud_academic_status`) 
                  VALUES ('$stud_course', '$fname', '$mname', '$lname', '$stud_phone', '$stud_email', '$stud_address', '$stud_gender', '$yr_lvl', '$add_stud_Sy', '$add_sem', '$add_acadStatus')";
    
        if ($this->conn->query($query)) {
            return true; 
        } else {
            return false; 
        }
    }

    public function UpdateStudent($stud_id, $stud_course, $fname, $mname, $lname,$stud_phone, $stud_email,$stud_address,$stud_gender,$yr_lvl,$stud_Sy,$sem,$acadStatus) {
       
        // Build the SQL query
        $sql = "UPDATE `student` 
                SET `stud_fname` = '$fname',
                    `stud_mname` = '$mname',
                    `stud_lname` = '$lname', 
                    `stud_phone` = '$stud_phone',
                    `stud_email` = '$stud_email',
                    `stud_address` = '$stud_address',
                    `stud_gender` = '$stud_gender',
                    `stud_year_level` = '$yr_lvl',
                    `stud_school_year` = '$stud_Sy',
                    `stud_sem` = '$sem',
                    `stud_academic_status` = '$acadStatus',
                    `stud_course` = '$stud_course'
                WHERE `stud_id` = '$stud_id'";
        
        // Execute the query
        if ($this->conn->query($sql)) {
            return true;
        } else {
            return false;
        }
    }
    
    
    




    public function EditSubject($stud_department,$subject_id,$course_code, $descriptive_title, $units, $pre_requisite,$for_year_level)
    {
        $query = "UPDATE `subject` 
                  SET `sub_dept_id` = '$stud_department',`course_code` = '$course_code',`descriptive_title` = '$descriptive_title', 
                      `units` = '$units', 
                      `pre_requisite` = '$pre_requisite',
                      `for_year_level` = '$for_year_level'
                  WHERE `subject_id` = '$subject_id'";
    
        if ($this->conn->query($query)) {
            return true;
        } else {
            return false; 
        }
    }


    
    public function deleteSub($subject_id)
    {
        $query = "DELETE FROM `subject` WHERE `subject_id` = '$subject_id'";
        
        if ($this->conn->query($query)) {
            return true; 
        } else {
            return false; 
        }
    }


    public function DeleteStudentsSubject($ss_id)
    {
        $query = "DELETE FROM `student_subject` WHERE `ss_id` = '$ss_id'";
        
        if ($this->conn->query($query)) {
            return true; 
        } else {
            return false; 
        }
    }


    public function addUser($fname, $mname, $lname, $email, $username, $hashedPassword, $profile_img) {
        // Prepare the SQL query with placeholders
        $sql = "INSERT INTO `user` (`fname`, `mname`, `lname`, `email`, `username`, `password`, `profile_img`, `type`) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            // Handle error if the statement couldn't be prepared
            return false;
        }
    
        // Bind the parameters
        $type = 'admin'; // Fixed value
        $stmt->bind_param('ssssssss', $fname, $mname, $lname, $email, $username, $hashedPassword, $profile_img, $type);
        
        // Execute the statement
        $success = $stmt->execute();
        
        // Close the statement
        $stmt->close();
        
        // Return the success status
        return $success;
    }



    
    public function deactivateStudent($stud_id) {
        $sql = "UPDATE `student` 
                SET `stud_status` = 0
                WHERE `stud_id` = ?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('i', $stud_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
    

    public function deleteDept($dept_id) {
        $sql = "UPDATE `department` 
                SET `dept_status` = 0
                WHERE `dept_id` = ?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('i', $dept_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
    

    public function deactivateUser($admin_id) {
        // Prepare the SQL query with placeholders
        $sql = "UPDATE `user` 
                SET `status` = 0
                WHERE `admin_id` = ?";
        
        // Prepare the statement
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            // Handle error if the statement couldn't be prepared
            return false;
        }
    
        // Bind the parameters
        $stmt->bind_param('i', $admin_id);
        
        // Execute the statement
        $success = $stmt->execute();
        
        // Close the statement
        $stmt->close();
        
        // Return the success status
        return $success;
    }
    
    

    public function UpdateProfile($profile_id, $profile_fname, $profile_mname, $profile_lname, $profile_email, $profile_username, $hashed_password) {
        $sql = "UPDATE `user` 
                SET `fname` = ?, `mname` = ?, `lname` = ?, `email` = ?, `username` = ?";
    
        if (!empty($hashed_password)) {
            $sql .= ", `password` = ?";
        }
        $sql .= " WHERE `admin_id` = ?";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt === false) {
            return false;
        }
        if (!empty($hashed_password)) {
            $stmt->bind_param('ssssssi', $profile_fname, $profile_mname, $profile_lname, $profile_email, $profile_username, $hashed_password, $profile_id);
        } else {
            $stmt->bind_param('sssssi', $profile_fname, $profile_mname, $profile_lname, $profile_email, $profile_username, $profile_id);
        }
    
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }
    


    public function UpdateUser($admin_id, $fname, $mname, $lname, $email, $username) {
        $sql = "UPDATE `user` 
                SET `fname` = ?, `mname` = ?, `lname` = ?, `email` = ?, `username` = ?
                WHERE `admin_id` = ?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('sssssi', $fname, $mname, $lname, $email, $username, $admin_id);
        $success = $stmt->execute();
        $stmt->close();
        return $success;
    }








    
    



    public function checkUserNameExists($username) {
        $sql = "SELECT COUNT(*) FROM `user` WHERE `username` = ?";
        
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('s', $username);
        
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        
        return $count > 0;
    }



    public function checkEmailExists($email) {
        $sql = "SELECT COUNT(*) FROM `user` WHERE `email` = ?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        
        return $count > 0;
    }



    public function checkStudIDExists($stud_code) {
        $sql = "SELECT COUNT(*) FROM `student` WHERE `stud_code` = ?";
        $stmt = $this->conn->prepare($sql);
        
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('s', $stud_code);
        $stmt->execute();
        
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        
        return $count > 0;
    }



    public function addStudentProfileImage($stud_code, $profile_img) {
        // Prepare the SQL query with placeholders
        $sql = "UPDATE `student` SET `stud_profile_img` = ? WHERE `stud_code` = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('ss', $profile_img, $stud_code);
        $success = $stmt->execute();
        
        $stmt->close();
        
        return $success;
    }

    


    public function addUserProfileImage($username, $profile_img) {
        // Prepare the SQL query with placeholders
        $sql = "UPDATE `user` SET `profile_img` = ? WHERE `username` = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('ss', $profile_img, $username);
        $success = $stmt->execute();
        
        $stmt->close();
        
        return $success;
    }

    public function updateUserProfileImage($admin_id,$username, $profile_img) {
        $sql = "UPDATE `user` SET `profile_img` = ? WHERE `admin_id` = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('si', $profile_img, $admin_id);
        $success = $stmt->execute();
        
        $stmt->close();
        
        return $success;
    }



    

    public function getUserProfileImage($admin_id) {
        // SQL query to fetch the profile image path
        $sql = "SELECT profile_img FROM user WHERE admin_id = $admin_id";
        $result = $this->conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            if ($row) {
                return $row['profile_img'];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }






    public function updateStudentProfileImage($stud_id,$stud_code, $profile_img) {
        $sql = "UPDATE `student` SET `stud_profile_img` = ? WHERE `stud_id` = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('si', $profile_img, $stud_id);
        $success = $stmt->execute();
        
        $stmt->close();
        
        return $success;
    }


    public function getStudentProfileImage($stud_id) {
        // SQL query to fetch the profile image path
        $sql = "SELECT stud_profile_img FROM student WHERE stud_id = $stud_id";
        $result = $this->conn->query($sql);
        if ($result) {
            $row = $result->fetch_assoc();
            if ($row) {
                return $row['stud_profile_img'];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
    
    
    
    
    
    
    
    
  
    
  
}



    


    

    

    
    
    

