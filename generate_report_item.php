<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "erpsystem";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

$query =    "SELECT invoice.invoice_no, invoice.date, CONCAT(customer.title, ' ', customer.first_name, ' ', customer.last_name) AS customer_name,
            item.item_name, item.item_code, item_category.category AS item_category, item.unit_price
            FROM invoice
            JOIN customer ON invoice.customer = customer.id
            JOIN item ON invoice.item_count = item.id
            JOIN item_category ON item.item_category = item_category.id";

$result = $connection->query($query);

// Prepare data for CSV
$filename = "item_report_" . date("Y-m-d") . ".csv";
$fp = fopen($filename, "w");

if ($result->num_rows > 0) {
    // Write CSV headers
    $headers = array("Invoice Number", "Date", "Customer Name", "Item Name", "Item Code", "Item Category", "Item Unit Price");
    fputcsv($fp, $headers);

    // Write data to CSV
    while ($row = $result->fetch_assoc()) {
        $data = array(
            $row['invoice_no'],
            $row['date'],
            $row['customer_name'],
            $row['item_name'],
            $row['item_code'],
            $row['item_category'],
            $row['unit_price']
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
