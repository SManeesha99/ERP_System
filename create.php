<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "erpsystem";

    // Create connection
    $connection = new mysqli($servername, $username, $password, $dbname);


    $title = "";
    $first_name = "";
    $last_name = "";
    $contact_no = "";
    $district = "";

    $errorMesssage = "";
    $successMessage = "";

    if($_SERVER['REQUEST_METHOD']=='POST'){
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

            //add new customer to database

            $sql = "INSERT INTO customer (title, first_name, last_name, contact_no, district) 
                    VALUES ('$title', '$first_name', '$last_name', '$contact_no', '$district')";
            $result = $connection->query($sql);

            if(!$result){
                $errorMesssage = "Error in adding customer: ".$connection->error;
                break;
            }


            $title = "";
            $first_name = "";
            $last_name = "";
            $contact_no = "";
            $district = "";

            $successMessage = "Customer added successfully";
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
                <label class="col-sm-3 col-form-label" >District</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="district" value="<?php echo $district; ?>">
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