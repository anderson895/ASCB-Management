<?php

require '../../vendor/autoload.php'; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

include('../../db/class.php');
$admin_db = new global_class();

$subject_id = $_GET['subject_id'];

$get_All_filtered_student = $admin_db->get_All_studentBasedSubject($subject_id);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Set the title header
$sheet->setCellValue('A1', 'STUDENT GRADE');
$sheet->mergeCells('A1:F1'); // Merge cells for title
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
    'A2' => 'No.', 
    'B2' => 'ID Number', 
    'C2' => 'Enrollee Name',
    'D2' => 'Final Grade', 
    'E2' => 'Gen Ave', 
    'F2' => 'Remarks'
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
$sheet->getStyle('A2:F2')->applyFromArray($headerStyleArray);

// Adjust column widths
foreach (range('A', 'F') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

// Insert student data
$rowCount = 3; // Start from the third row after title and headers
$count = 1;
foreach ($get_All_filtered_student as $student) {

    $fullname = ucfirst($student['stud_lname']) . ', ' . ucfirst($student['stud_fname']) . ', ' . ucfirst($student['stud_mname']);
    $general_ave = $student['general_average'];
    
    if ($general_ave <= 0) {
        $remarks = "NO GRADE";
    } elseif ($general_ave > 0 && $general_ave <= 3) {
        $remarks = "PASSED";
    } elseif ($general_ave > 3) {
        $remarks = "FAILED";
    }

    $sheet->setCellValue('A' . $rowCount, $count);
    $sheet->setCellValue('B' . $rowCount, $student['stud_id']);
    $sheet->setCellValue('C' . $rowCount, $fullname);
    $sheet->setCellValue('D' . $rowCount, $student['ss_final_grade']); // Correct Final Grade assignment
    $sheet->setCellValue('E' . $rowCount, $student['general_average']);
    $sheet->setCellValue('F' . $rowCount, $remarks);

    $rowCount++;
    $count++;
}

// Set filename and prepare headers for Excel file download
$filename = 'students_list_' . date('Ymd_His') . '.xlsx';

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Write the spreadsheet to output and send it to the browser for download
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

exit();

?>
