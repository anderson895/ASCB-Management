<?php
function generateSchoolYears($startYear, $endYear) {
    $years = [];
    for ($year = $startYear; $year <= $endYear; $year++) {
        $years[] = $year . '-' . ($year + 1);
    }
    return $years;
}

$schoolYears = generateSchoolYears(2021, 2025);
?>
