<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "erpsystem";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

     $id ="";
     $title = "";
     $first_name = "";
     $last_name = "";
     $contact_no = "";
     $district = "";
 
     $errorMesssage = "";
     $successMessage = "";

     if($_SERVER['REQUEST_METHOD']=='GET'){
        if(!isset($_GET['id'])){
            header("Location: /ERP_System/index.php");
            exit();
        }
        $id = $_GET['id'];    

        //read the row of the selcted client from database table
        $sql = "SELECT * FROM customer WHERE id=$id";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();

        if(!$row){
            header("Location: /ERP_System/index.php");
            exit();
        }

        $title = $row['title'];
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $contact_no = $row['contact_no'];
        $district = $row['district'];

     }
     else{

        $id = $_POST['id'];
        $title = $_POST['title'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_no = $_POST['contact_no'];
        $district = $_POST['district'];

        do{
            if(empty($title)||empty($first_name)||empty($last_name)||empty($contact_no)||empty($district)){
                $errorMesssage = "Please fill all the fields";
                break;
            }

            //update the selected client in database table

            $sql = "UPDATE customer ".
                    "SET title='$title', first_name='$first_name', last_name='$last_name', contact_no='$contact_no', district='$district' ".
                    "WHERE id=$id";
            $result = $connection->query($sql);

            if(!$result){
                $errorMesssage = "Error in updating customer: ".$connection->error;
                break;
            }

            $successMessage = "Customer updated successfully";
            header("Location: /ERP_System/index.php");
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
        <h2>Create Customer</h2>
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
                <label  class="col-sm-3 col-form-label" >Title</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="title" value="<?php echo $title; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label  class="col-sm-3 col-form-label" >First name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="first_name" value="<?php echo $first_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label  class="col-sm-3 col-form-label" >Last name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="last_name" value="<?php echo $last_name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label" >Contact number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="contact_no" value="<?php echo $contact_no; ?>">
                </div>
            </div>
            <div class="row mb-3">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">District</label>
                <div class="col-sm-6">
                    <select class="form-control" name="district">
                        <option value="<?php echo $district; ?>"><?php echo $district; ?></option>
                        <?php
                        // Assuming you have a database connection named $conn
                        $query = "SELECT * FROM district";
                        $result = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $districtName = $row['district'];
                            $districtID = $row['id'];

                            // Check if the currently selected district matches the fetched district
                            $selected = ($district == $districtID) ? 'selected' : '';

                            echo "<option value='$districtID' $selected>$districtID</option>";
                        }
                        ?>
                    </select>
                </div>
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
                    <a class="btn btn-outline-primary" href="/ERP_System/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>