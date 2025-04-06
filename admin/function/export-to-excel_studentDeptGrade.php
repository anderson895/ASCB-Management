<?php
require '../../vendor/autoload.php'; // PhpSpreadsheet library
include('../../db/class.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

$admin_db = new global_class();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_id = $_POST['dept_id'];

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=student_department_grades.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    $student_grade = $admin_db->view_student_grade_per_department($dept_id);

    $students = [];

    while ($row = $student_grade->fetch_assoc()) {
        $stud_id = $row['stud_id'];

        if (!isset($students[$stud_id])) {
            $students[$stud_id] = [
                'info' => $row,
                'subjects' => []
            ];
        }

        $students[$stud_id]['subjects'][] = [
            'course_code' => $row['course_code'],
            'descriptive_title' => $row['descriptive_title'],
            'ss_final_grade' => $row['ss_final_grade'],
            'units' => $row['units']
        ];
    }

    echo "<table border='1'>";
    echo "<tr>
            <th>No</th>
            <th>Student Number</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Home Address</th>
            <th>Year</th>
            <th>Course Code</th>
            <th>Course Description</th>
            <th>Grades</th>
            <th>Units</th>
          </tr>";

    $count = 1;
    foreach ($students as $stud_id => $student) {
        foreach ($student['subjects'] as $subject) {
            echo "<tr>";
            echo "<td>{$count}</td>";
            echo "<td>{$student['info']['stud_id']}</td>";
            echo "<td>{$student['info']['stud_lname']}</td>";
            echo "<td>{$student['info']['stud_fname']}</td>";
            echo "<td>{$student['info']['stud_mname']}</td>";
            echo "<td>{$student['info']['stud_bday']}</td>";
            echo "<td>{$student['info']['stud_gender']}</td>";
            echo "<td>{$student['info']['stud_address']}</td>";
            echo "<td>{$student['info']['stud_year_level']}</td>";
            echo "<td>{$subject['course_code']}</td>";
            echo "<td>{$subject['descriptive_title']}</td>";
            echo "<td>{$subject['ss_final_grade']}</td>";
            echo "<td>{$subject['units']}</td>";
            echo "</tr>";
        }
        $count++;
    }

    echo "</table>";
    exit();
}
?>
