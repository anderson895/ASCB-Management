<?php
require '../../vendor/autoload.php'; // Ensure you have PhpSpreadsheet installed
include('../../db/class.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

$admin_db = new global_class();
$get_All_subject = $admin_db->get_All_subject_frequency();

if ($get_All_subject) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set column headers
    $sheet->setCellValue('A1', 'Course Code');
    $sheet->setCellValue('B1', 'Course Description');
    $sheet->setCellValue('C1', 'Section Name');
    $sheet->setCellValue('D1', 'Count');

    // Apply styles to header row
    $headerStyle = [
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => [
            'fillType' => Fill::FILL_SOLID,
            'startColor' => ['rgb' => '4CAF50'], // Green background
        ],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        'borders' => [
            'allBorders' => ['borderStyle' => Border::BORDER_THIN],
        ],
    ];
    $sheet->getStyle('A1:D1')->applyFromArray($headerStyle);

    // Set column widths for better readability
    $sheet->getColumnDimension('A')->setWidth(15);
    $sheet->getColumnDimension('B')->setWidth(35);
    $sheet->getColumnDimension('C')->setWidth(20);
    $sheet->getColumnDimension('D')->setWidth(10);

    // Populate data and style each row
    $row = 2; // Start from the second row
    while ($subject = $get_All_subject->fetch_assoc()) {
        $sheet->setCellValue("A{$row}", $subject['course_code']);
        $sheet->setCellValue("B{$row}", $subject['descriptive_title']);
        $sheet->setCellValue("C{$row}", $subject['stud_section']);
        $sheet->setCellValue("D{$row}", $subject['student_count']);

        // Add borders to the data rows
        $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => Border::BORDER_THIN],
            ],
        ]);
        $row++;
    }

    // Auto-adjust row height
    $sheet->getDefaultRowDimension()->setRowHeight(-1);

    // Freeze the header row
    $sheet->freezePane('A2');

    // Set the headers to download the file as Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="subject_frequency.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "No data available for export.";
    exit;
}
?>
