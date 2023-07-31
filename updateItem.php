<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "erpsystem";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

$id = "";
$item_code = "";
$item_name = "";
$item_category = "";
$item_subcategory = "";
$quantity = "";
$unit_price = "";

$errorMesssage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET['id'])) {
        header("Location: /ERP_System/item.php");
        exit();
    }
    $id = $_GET['id'];

    //read the row of the selected item from the database table (using prepared statement)
    $stmt = $connection->prepare("SELECT * FROM item WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if (!$row) {
        header("Location: /ERP_System/item.php");
        exit();
    }

    $item_code = $row['item_code'];
    $item_name = $row['item_name'];
    $item_category = $row['item_category'];
    $item_subcategory = $row['item_subcategory'];
    $quantity = $row['quantity'];
    $unit_price = $row['unit_price'];
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_subcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    if (empty($item_code) || empty($item_name) || empty($item_category) || empty($item_subcategory) || empty($quantity) || empty($unit_price)) {
        $errorMesssage = "Please fill all the fields";
    } else {
        // Update the selected item in the database table (using prepared statement)
        $stmt = $connection->prepare("UPDATE item SET item_code=?, item_name=?, item_category=?, item_subcategory=?, quantity=?, unit_price=? WHERE id=?");
        $stmt->bind_param("ssssidi", $item_code, $item_name, $item_category, $item_subcategory, $quantity, $unit_price, $id);
        if ($stmt->execute()) {
            $successMessage = "Item updated successfully";
        } else {
            $errorMesssage = "Error in updating item: " . $connection->error;
        }
        $stmt->close();
    }
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
        <input type="hidden" name="id" value="<?php echo $id; ?>">
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