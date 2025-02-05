<?php

include('../../db/class.php');
$admin_db = new global_class();
// Check if POST request contains dept_id
if (isset($_POST['dept_id'])) {
    $dept_id = $_POST['dept_id'];

    // Fetch data
    $get_All_student = $admin_db->get_All_studentBasedOnDepartmentGroupBy($dept_id);

    // Set headers for Excel
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=department_students.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    // Output table headers
    echo "No.\tID Number\tLast Name\tFirst Name\tMiddle Name\tSex\tAddress\tYear Level\tCourse\n";

    $count = 1;
    while ($student = $get_All_student->fetch_array()) {
        echo $count . "\t" .
             $student['stud_id'] . "\t" .
             $student['stud_lname'] . "\t" .
             $student['stud_fname'] . "\t" .
             $student['stud_mname'] . "\t" .
             $student['stud_gender'] . "\t" .
             $student['stud_address'] . "\t" .
             $student['stud_year_level'] . "\t" .
             $student['stud_course'] . "\n";
        $count++;
    }
    exit;
} else {
    echo "No department selected.";
}
