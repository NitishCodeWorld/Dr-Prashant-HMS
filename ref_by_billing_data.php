<?php 
include 'function.php';
include 'conn.php'; 

if (isset($_POST['tableData'])) {
    $data = json_decode($_POST['tableData']);
    $filename = "Ref By Billing Details From ".date("d-M-Y", strtotime($_REQUEST['from_date']))." To ".date("d-M-Y", strtotime($_REQUEST['to_date']))." export_" . time() . ".xls";
    $filePath = "exports/ref_by/" . $filename;

    $output = "<table border='1'>";
    foreach ($data as $row) {
        $output .= "<tr>";
        foreach ($row as $cell) {
            $output .= "<td>" . htmlspecialchars($cell) . "</td>";
        }
        $output .= "</tr>";
    }
    $output .= "</table>";

    // Save the file
    file_put_contents($filePath, $output);

    // Return path to download
    echo $filePath;
}


?>
