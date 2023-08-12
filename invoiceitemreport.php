<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ERP-SYSTEM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="item.php">Items</a>
                    </li>
                    <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Reports
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="itemFilter.php">Invoice report</a></li>
            <li><a class="dropdown-item" href="invoiceitemreport.php">Invoice item report</a></li>
            <li><a class="dropdown-item" href="itemreport.php">Item report</a></li>
          </ul>
        </li>
                </ul>
                
            </div>
        </div>
    </nav>
    <div class="py-5">
    <div class="container ">
       <div class="row justify-content-center"> 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>ERP System</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">From Date</label>
                                        <input type="date" name="from_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">To Date</label>
                                        <input type="date" name="to_date" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" name="filter" class="btn btn-primary mt-4">Filter</button>
                                    <a href="generate_report_item.php" target="_blank" class="btn btn-success mt-4">Generate Report</a>
                                </div>    
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h3>Item Invoice List</h3>
                        <hr>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                <th>Invoice Number</th>
                                <th>Invoiced Date</th>
                                <th>Customer Name</th>
                                <th>Item Name</th>
                                <th>Item Code</th>
                                <th>Item Category</th>
                                <th>Item Unit Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                                    $from_date = $_GET['from_date'];
                                    $to_date = $_GET['to_date'];

                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "erpsystem";

                                    // Create connection
                                    $connection = new mysqli($servername, $username, $password, $dbname);

                                    $query = "SELECT invoice.invoice_no, invoice.date, CONCAT(customer.title, ' ', customer.first_name, ' ', customer.last_name) AS customer_name,
                                    item.item_name, item.item_code, item_category.category AS item_category, item.unit_price
                                    FROM invoice
                                    JOIN customer ON invoice.customer = customer.id
                                    JOIN item ON invoice.item_count = item.id
                                    JOIN item_category ON item.item_category = item_category.id
                                    WHERE invoice.date BETWEEN '$from_date' AND '$to_date'";
                                } 

                                $result = $connection->query($query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>".$row['invoice_no']."</td>";
                                        echo "<td>".$row['date']."</td>";
                                        echo "<td>".$row['customer_name']."</td>";
                                        echo "<td>".$row['item_name']."</td>";
                                        echo "<td>".$row['item_code']."</td>";
                                        echo "<td>".$row['item_category']."</td>";
                                        echo "<td>".$row['unit_price']."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7' class='text-center'>No data found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
       </div>
    </div>
    </div>    
</body>
</html>
