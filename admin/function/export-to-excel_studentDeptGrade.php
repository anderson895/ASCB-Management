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

    // Table headers
    $headers = [
        'No', 'Student Number', 'Last Name', 'First Name', 'Middle Name',
        'Date of Birth', 'Gender', 'Home Address', 'Year',
        'Course Code', 'Course Description', 'Grades', 'Units'
    ];

    $sheet->fromArray($headers, NULL, 'A1');

    // Styling: Header
    $sheet->getStyle('A1:M1')->applyFromArray([
        'font' => ['bold' => true],
        'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
        'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
    ]);

    $rowIndex = 2;
    $count = 1;

    foreach ($students as $stud_id => $student) {
        $subjectCount = count($student['subjects']);
        $first = true;
        foreach ($student['subjects'] as $i => $subject) {
            // Merge only once for each student row group
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

            // Subject-specific data
            $sheet->setCellValue("J{$rowIndex}", $subject['course_code']);
            $sheet->setCellValue("K{$rowIndex}", $subject['descriptive_title']);
            $sheet->setCellValue("L{$rowIndex}", $subject['ss_final_grade']);
            $sheet->setCellValue("M{$rowIndex}", $subject['units']);

            // Apply border to the whole row
            $sheet->getStyle("A{$rowIndex}:M{$rowIndex}")->applyFromArray([
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
                'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
            ]);

            $rowIndex++;
        }
        $count++;
    }

    // Auto size columns
    foreach (range('A', 'M') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Output Excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="student_department_grades.xlsx"');
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit();
}
?>
