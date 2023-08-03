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
                                    <a href="generate_report.php" target="_blank" class="btn btn-success mt-4">Generate Report</a>
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
                                    <th>Invoice number</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Customer district</th>
                                    <th>Item count</th>
                                    <th>Invoice amount</th>
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

                                    $query = "SELECT invoice.*, customer.first_name, customer.district
                                              FROM invoice
                                              INNER JOIN customer ON invoice.id = customer.id
                                              WHERE invoice.date BETWEEN '$from_date' AND '$to_date'";
                                } else {
                                    $query = "SELECT invoice.*, customer.first_name, customer.district
                                              FROM invoice
                                              INNER JOIN customer ON invoice.id = customer.id";
                                }

                                $result = $connection->query($query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>".$row['invoice_no']."</td>";
                                        echo "<td>".$row['date']."</td>";
                                        echo "<td>".$row['first_name']."</td>";
                                        echo "<td>".$row['district']."</td>";
                                        echo "<td>".$row['item_count']."</td>";
                                        echo "<td>".$row['amount']."</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6' class='text-center'>No data found</td></tr>";
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
