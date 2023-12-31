<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ERP Syatem</title>
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
    <div class="container my-5">
        <h2>List of Users</h2>
        <a class="btn btn-primary" href="/ERP_System/addItem.php" role="button">New Item</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Item code</th>
                <th scope="col">Item name</th>
                <th scope="col">Last name</th>
                <th scope="col">Item category</th>
                <th scope="col">Item sub category</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit price</th>
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
                    $sql = "SELECT * FROM item";
                    $result = $connection->query($sql);

                    if(!$result){
                        die("Invalid query: ".$connection->error);
                    }

                    //read data of each row
                    while($row = $result->fetch_assoc()){
                        echo "
                        <tr>
                            <th>$row[item_code]</th>
                            <td>$row[item_name]</td>
                            <td>$row[item_category]</td>
                            <td>$row[item_subcategory]</td>
                            <td>$row[quantity]</td>
                            <td>$row[unit_price]</td>
                            <td>
                                <a class='btn btn-primary' href='/ERP_System/updateItem.php?id=$row[id]' role='button'>Edit</a>
                                <a class='btn btn-danger' href='/ERP_System/deleteItem.php?id=$row[id]' role='button'>Delete</a>
                            </td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>    
</body>
</html>
<!-- 076590237 -->