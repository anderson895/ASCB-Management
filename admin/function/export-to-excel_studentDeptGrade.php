<?php
require '../../vendor/autoload.php';
include('../../db/class.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

$admin_db = new global_class();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dept_id = $_POST['dept_id'];

    $get_department = $admin_db->view_department($dept_id);
    $view_department = $get_department->fetch_array();
    $dept_name = $view_department['dept_name'];
    $dept_description = $view_department['dept_description'];

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

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Student Grades');

    // Title at the top
    $sheet->setCellValue('A1', 'Promotional Report');
    $sheet->mergeCells('A1:M1');
    $sheet->getStyle('A1')->applyFromArray([
        'font' => ['bold' => true, 'size' => 14],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
    ]);

    // Department Name
    $sheet->setCellValue('A2', "Department: $dept_name");
    $sheet->mergeCells('A2:M2');
    $sheet->getStyle('A2')->applyFromArray([
        'font' => ['bold' => true, 'size' => 12],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
    ]);

    // Department Description
    $sheet->setCellValue('A3', "Description: $dept_description");
    $sheet->mergeCells('A3:M3');
    $sheet->getStyle('A3')->applyFromArray([
        'font' => ['italic' => true, 'size' => 11],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_LEFT],
    ]);

    // Leave Row 4 blank for spacing, Headers on Row 5
    $headers = [
        'No', 'Student Number', 'Last Name', 'First Name', 'Middle Name',
        'Date of Birth', 'Gender', 'Home Address', 'Year',
        'Course Code', 'Course Description', 'Grades', 'Units'
    ];

    $sheet->fromArray($headers, NULL, 'A5');

    // Styling for header row
    $sheet->getStyle('A5:M5')->applyFromArray([
        'font' => ['bold' => true],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
    ]);

    $rowIndex = 6; // Data starts at row 6
    $count = 1;

    foreach ($students as $stud_id => $student) {
        $subjectCount = count($student['subjects']);
        $first = true;
        foreach ($student['subjects'] as $i => $subject) {
            if ($first) {
                $mergeEnd = $rowIndex + $subjectCount - 1;

                $sheet->setCellValue("A{$rowIndex}", $count);
                $sheet->mergeCells("A{$rowIndex}:A{$mergeEnd}");

                $sheet->setCellValue("B{$rowIndex}", $student['info']['stud_id']);
                $sheet->mergeCells("B{$rowIndex}:B{$mergeEnd}");

                $sheet->setCellValue("C{$rowIndex}", $student['info']['stud_lname']);
                $sheet->mergeCells("C{$rowIndex}:C{$mergeEnd}");

                $sheet->setCellValue("D{$rowIndex}", $student['info']['stud_fname']);
                $sheet->mergeCells("D{$rowIndex}:D{$mergeEnd}");

                $sheet->setCellValue("E{$rowIndex}", $student['info']['stud_mname']);
                $sheet->mergeCells("E{$rowIndex}:E{$mergeEnd}");

                $sheet->setCellValue("F{$rowIndex}", $student['info']['stud_bday']);
                $sheet->mergeCells("F{$rowIndex}:F{$mergeEnd}");

                $sheet->setCellValue("G{$rowIndex}", $student['info']['stud_gender']);
                $sheet->mergeCells("G{$rowIndex}:G{$mergeEnd}");

                $sheet->setCellValue("H{$rowIndex}", $student['info']['stud_address']);
                $sheet->mergeCells("H{$rowIndex}:H{$mergeEnd}");

                $sheet->setCellValue("I{$rowIndex}", $student['info']['stud_year_level']);
                $sheet->mergeCells("I{$rowIndex}:I{$mergeEnd}");

                $first = false;
            }

            $sheet->setCellValue("J{$rowIndex}", $subject['course_code']);
            $sheet->setCellValue("K{$rowIndex}", $subject['descriptive_title']);
            $sheet->setCellValue("L{$rowIndex}", $subject['ss_final_grade']);
            $sheet->setCellValue("M{$rowIndex}", $subject['units']);

            // Apply border to row
            $sheet->getStyle("A{$rowIndex}:M{$rowIndex}")->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);

            $rowIndex++;
        }
        $count++;
    }

    // Auto-size all columns
    foreach (range('A', 'M') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Output the Excel file
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="student_department_grades.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit();
}
?>
