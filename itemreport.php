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
                    <div class="container my-5">
                <h2>Item Report</h2>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                        <th>Item Name</th>
                        <th>Item Category</th>
                        <th>Item Subcategory</th>
                        <th>Item Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "erpsystem";

                            // Create connection
                            $connection = new mysqli($servername, $username, $password, $dbname);

                            // Check connection
                            if($connection->connect_error) {
                                die("Connection failed: " . $connection->connect_error);
                            }

                            //read all row from database table
                            $sql = "SELECT item_name, category, sub_category, quantity FROM item
                            INNER JOIN item_category ON item.item_category = item_category.id
                            INNER JOIN item_subcategory ON item.item_subcategory = item_subcategory.id";
                            $result = $connection->query($sql);

                            if(!$result){
                                die("Invalid query: ".$connection->error);
                            }

                            //read data of each row
                            while($row = $result->fetch_assoc()){
                                echo "<tr>";
                                echo "<td>".$row['item_name']."</td>";
                                echo "<td>".$row['category']."</td>";
                                echo "<td>".$row['sub_category']."</td>";
                                echo "<td>".$row['quantity']."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div> 

                  
            </div>
       </div>
    </div>
    </div>    
</body>
</html>
