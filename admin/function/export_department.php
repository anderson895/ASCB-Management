<?php


require '../../vendor/autoload.php'; // Ensure PhpSpreadsheet is autoloaded

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

include('../../db/class.php');
$admin_db = new global_class();


// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// Fetch student data
$dept_course = $_POST['export_dept_course'];
$department_id = $_POST['export_dept_stud_department'];
$yr_lvl = $_POST['export_dept_yr_lvl'];
$subject_id = $_POST['add_stud_subject'];

$get_All_filtered_student = $admin_db->get_All_filtered_student($dept_course, $department_id, $yr_lvl, $subject_id);

if (!$get_All_filtered_student || !is_array($get_All_filtered_student)) {
    // Return a clear error message if the query failed or no data found
    // die("No students found or data retrieval failed.");

    echo "NO STUDENT RECORD FOUND";
    // echo "
    // <script>
    //     alert('NO STUDENT FOUND');
    //     window.location.href = '../department.php';
    // </script>
    // ";


}else{
    foreach ($get_All_filtered_student as $student) {
          
           $departmentName= $student['dept_name'];
        }

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the title header
$sheet->setCellValue('A1', 'List of Students for ' . $departmentName . ' Department');
$sheet->mergeCells('A1:J1'); // Merge cells for title
$sheet->getStyle('A1')->applyFromArray([
    'font' => [
        'bold' => true,
        'size' => 16,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
]);

// Set the headers for the columns
$headers = [
    'A2' => 'Id Number', 
    'B2' => 'Last Name', 
    'C2' => 'First Name',
    'D2' => 'Middle Name', 
    'E2' => 'Sex (Male or Female)', 
    'F2' => 'Address', 
    'G2' => 'Year Level',
    'H2' => 'Subject Code', 
    'I2' => 'Subject Description',
    'J2' => 'Course'
];

// Set header values and apply styling
foreach ($headers as $cell => $header) {
    $sheet->setCellValue($cell, $header);
}

// Style header row
$headerStyleArray = [
    'font' => [
        'bold' => true,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'FFCCCCCC',
        ],
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
];
$sheet->getStyle('A2:J2')->applyFromArray($headerStyleArray);

// Adjust column widths
foreach (range('A', 'J') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Insert student data
$rowCount = 3; // Start from the third row after title and headers
foreach ($get_All_filtered_student as $student) {
    $sheet->setCellValue('A' . $rowCount, $student['stud_id']);
    $sheet->setCellValue('B' . $rowCount, ucfirst($student['stud_lname']));
    $sheet->setCellValue('C' . $rowCount, ucfirst($student['stud_fname']));
    $sheet->setCellValue('D' . $rowCount, ucfirst($student['stud_mname']));
    $sheet->setCellValue('E' . $rowCount, $student['stud_gender']);
    $sheet->setCellValue('F' . $rowCount, $student['stud_address']);
    $sheet->setCellValue('G' . $rowCount, $student['stud_year_level']);
    $sheet->setCellValue('H' . $rowCount, $student['course_code']);
    $sheet->setCellValue('I' . $rowCount, $student['descriptive_title']);
    $sheet->setCellValue('J' . $rowCount, $student['stud_course']);

    $rowCount++;
}

// Set filename and prepare headers for Excel file download
$filename = 'students_list_' . date('Ymd_His') . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Write the spreadsheet to output and send it to the browser for download
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

}
exit();
?>
