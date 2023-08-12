<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "erpsystem";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

$query = "SELECT invoice.invoice_no, invoice.date, CONCAT(customer.title, ' ', customer.first_name, ' ', customer.last_name) AS customer_name, district.district, invoice.item_count, invoice.amount
          FROM invoice
          JOIN customer ON invoice.customer = customer.id
          JOIN district ON customer.district = district.id";

$result = $connection->query($query);

// Prepare data for CSV
$filename = "invoice_report_" . date("Y-m-d") . ".csv";
$fp = fopen($filename, "w");

if ($result->num_rows > 0) {
    // Write CSV headers
    $headers = array("Invoice Number", "Date", "Customer Name", "Customer District", "Item Count", "Invoice Amount");
    fputcsv($fp, $headers);

    // Write data to CSV
    while ($row = $result->fetch_assoc()) {
        $data = array(
            $row['invoice_no'],
            $row['date'],
            $row['customer_name'],
            $row['district'],
            $row['item_count'],
            $row['amount']
        );
        fputcsv($fp, $data);
    }
}

fclose($fp);

// Download the CSV file
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="' . $filename . '";');
readfile($filename);

// Delete the CSV file
unlink($filename);

exit();
?>
