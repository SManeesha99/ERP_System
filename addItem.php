<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "erpsystem";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);


    $item_code = "";
    $item_name = "";
    $item_category = "";
    $item_subcategory = "";
    $quantity = "";
    $unit_price = "";

    $errorMesssage = "";
    $successMessage = "";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $item_code = $_POST['item_code'];
        $item_name = $_POST['item_name'];
        $item_category = $_POST['item_category'];
        $item_subcategory = $_POST['item_subcategory'];
        $quantity = $_POST['quantity'];
        $unit_price = $_POST['unit_price'];


        do{
            if (empty($item_code) || empty($item_name) || empty($item_category) || empty($item_subcategory) || empty($quantity) || empty($unit_price)) {
                $errorMessage = "Please fill all the fields";
                break;
            }
            
            // add new item to database
            $sql = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price) 
                    VALUES ('$item_code', '$item_name', '$item_category', '$item_subcategory', '$quantity', '$unit_price')";
            $result = $connection->query($sql);
            
            if (!$result) {
                $errorMesssage = "Error in adding item: " . $connection->error;
                break;
            }
            
            $item_code = "";
            $item_name = "";
            $item_category = "";
            $item_subcategory = "";
            $quantity = "";
            $unit_price = "";
            
            $successMessage = "Item added successfully";
            header("Location: /ERP_System/item.php");
            exit();


        }while(false);
    }

?>


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
        <h2>Create Item</h2>
        <?php
            if(!empty($errorMesssage)){
                echo"
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMesssage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>                  
                    </div>
                ";
            }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label  class="col-sm-3 col-form-label" >Item code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_code" value="<?php echo $item_code; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label  class="col-sm-3 col-form-label" >Item name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_name" value="<?php echo $item_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label  class="col-sm-3 col-form-label" >Item Category</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_category" value="<?php echo $item_category; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" >Item sub-category</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_subcategory" value="<?php echo $item_subcategory; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" >Quantity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" >Unit Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="unit_price" value="<?php echo $unit_price; ?>">
                </div>
            </div>

            <?php
            if(!empty($successMessage)){
                echo"
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>                  
                    </div>
                ";
            }
        ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid" >
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
                <div class="offset-sm-3 col-sm-3 d-grid" >
                    <a class="btn btn-outline-primary" href="/ERP_System/item.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>