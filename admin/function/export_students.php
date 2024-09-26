<?php
require '../../vendor/autoload.php'; // Ensure PhpSpreadsheet is autoloaded

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

include('../../db/class.php');
$admin_db = new global_class();

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Add Title Header
$sheet->mergeCells('A1:I1'); // Merge cells for the title
$sheet->setCellValue('A1', 'List of Students');

// Style the Title
$titleStyleArray = [
    'font' => [
        'bold' => true,
        'size' => 16,
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER,
    ],
];
$sheet->getStyle('A1')->applyFromArray($titleStyleArray);
$sheet->getRowDimension('1')->setRowHeight(30); // Set title row height

// Headers for the table (moved to row 2)
$headers = [
    'A2' => 'STUDENT ID', 
    'B2' => 'First Name', 
    'C2' => 'Middle Name',
    'D2' => 'Last Name', 
    'E2' => 'Date Of Birth', 
    'F2' => 'Phone Number', 
    'G2' => 'Address', 
    'H2' => 'Gender', 
    'I2' => 'Course', 
    'J2' => 'Year Level', 
    'K2' => 'Trimester',
    'L2' => 'School Year', 
    'M2' => 'Academic Status'
];

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
$sheet->getStyle('A2:M2')->applyFromArray($headerStyleArray);

// Adjust column widths
foreach (range('A', 'M') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Fetch student data
$get_All_student = $admin_db->get_All_student();

if ($get_All_student) {
    $rowCount = 3; // Start from the third row after headers and title
    while ($student = $get_All_student->fetch_array()) {
        
        // Insert the rest of the student data
        $sheet->setCellValue('A' . $rowCount, $student['stud_id']);
        $sheet->setCellValue('B' . $rowCount, ucfirst($student['stud_fname']));
        $sheet->setCellValue('C' . $rowCount, ucfirst($student['stud_mname']));
        $sheet->setCellValue('D' . $rowCount, ucfirst($student['stud_lname']));
        $sheet->setCellValue('E' . $rowCount, $student['stud_bday']);
        $sheet->setCellValue('F' . $rowCount, $student['stud_phone']);
        $sheet->setCellValue('G' . $rowCount, $student['stud_address']);
        $sheet->setCellValue('H' . $rowCount, $student['stud_gender']);
        $sheet->setCellValue('I' . $rowCount, $student['stud_course']);
        $sheet->setCellValue('J' . $rowCount, $student['stud_year_level']);
        $sheet->setCellValue('K' . $rowCount, $student['stud_sem']);
        $sheet->setCellValue('L' . $rowCount, $student['stud_school_year']);
        $sheet->setCellValue('M' . $rowCount, $student['stud_academic_status']);

        // Adjust the row height to fit the image
        $sheet->getRowDimension($rowCount)->setRowHeight(50);

        $rowCount++;
    }
} else {
    // Optional: Handle the case where no students are found or there was an error
    die("Failed to retrieve student data.");
}

// Set the filename
$filename = 'students_list_' . date('Ymd') . '.xlsx';

// Send the generated file to browser for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();
?>
