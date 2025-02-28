<?php
require '../../vendor/autoload.php'; // PhpSpreadsheet library
include('../../db/class.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Font;

$admin_db = new global_class();

if (isset($_POST['dept_id'])) {
    $dept_id = $_POST['dept_id'];
    $students = $admin_db->get_All_studentBasedOnDepartment_exportExcel($dept_id);

    // Initialize Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Title & Header Styling
    $sheet->mergeCells('B2:F2');
    $sheet->mergeCells('B3:F3');
    $sheet->mergeCells('B5:F5');
    $sheet->mergeCells('B6:F6');

    $sheet->setCellValue('B2', 'ANDRES SORIANO COLLEGES OF BISLIG')
          ->setCellValue('B3', 'Mangagoy, Bislig City')
          ->setCellValue('B5', 'SUMMARY OF ENROLLMENT')
          ->setCellValue('B6', '2nd Trimester AY 2023-2024');

    $titleStyle = [
        'font' => ['bold' => true, 'size' => 14],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER]
    ];
    $sheet->getStyle('B2:B6')->applyFromArray($titleStyle);

    // Table Headers
    $sheet->setCellValue('C8', 'YEAR LEVEL')
          ->setCellValue('D8', 'MALE')
          ->setCellValue('E8', 'FEMALE')
          ->setCellValue('F8', 'TOTAL');

    $headerStyle = [
        'font' => ['bold' => true],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        'borders' => ['bottom' => ['borderStyle' => Border::BORDER_THIN]]
    ];
    $sheet->getStyle('C8:F8')->applyFromArray($headerStyle);

    // Start Data Insertion
    $row = 9;
    $current_course = '';
    $subtotal_male = 0;
    $subtotal_female = 0;

    while ($student = $students->fetch_assoc()) {
        if ($current_course !== $student['stud_course']) {
            // Print Subtotal Row for Previous Course
            if ($current_course !== '') {
                $sheet->setCellValue("C$row", 'Sub-Total')
                      ->setCellValue("D$row", $subtotal_male)
                      ->setCellValue("E$row", $subtotal_female)
                      ->setCellValue("F$row", $subtotal_male + $subtotal_female);
                $row++;
            }

            // Print Course Title
            $current_course = $student['stud_course'];
            $sheet->setCellValue("B$row", $current_course)
                  ->getStyle("B$row")->applyFromArray(['font' => ['bold' => true]]);
            $row++;

            // Reset Subtotals
            $subtotal_male = 0;
            $subtotal_female = 0;
        }

        // Insert Year Level Data
        $sheet->setCellValue("C$row", $student['stud_year_level'])
              ->setCellValue("D$row", $student['male_count'])
              ->setCellValue("E$row", $student['female_count'])
              ->setCellValue("F$row", $student['male_count'] + $student['female_count']);

        // Add to Subtotal
        $subtotal_male += $student['male_count'];
        $subtotal_female += $student['female_count'];

        $row++;
    }

    // Print Final Subtotal
    if ($current_course !== '') {
        $sheet->setCellValue("C$row", 'Sub-Total')
              ->setCellValue("D$row", $subtotal_male)
              ->setCellValue("E$row", $subtotal_female)
              ->setCellValue("F$row", $subtotal_male + $subtotal_female);
    }

    // Auto-size Columns
    foreach (range('B', 'F') as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Set Headers for Excel Download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="department_students.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit;
} else {
    echo "No department selected.";
}
