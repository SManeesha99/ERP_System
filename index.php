<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>List of Users</h2>
        <a class="btn btn-primary" href="/erpsystem/create.php" role="button">New User</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Title</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Contact number</th>
                <th scope="col">District</th>
                <th scope="col">Action</th>
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
                    $sql = "SELECT * FROM customer";
                    $result = $connection->query($sql);

                    if(!$result){
                        die("Invalid query: ".$connection->error);
                    }

                    //read data of each row
                    while($row = $result->fetch_assoc()){
                        echo "
                        <tr>
                            <th>$row[title]</th>
                            <td>$row[first_name]</td>
                            <td>$row[last_name]</td>
                            <td>$row[contact_no]</td>
                            <td>$row[district]</td>
                            <td>
                                <a class='btn btn-primary' href='/erpsystem/edit.php?id=$row[id]' role='button'>Edit</a>
                                <a class='btn btn-danger' href='/erpsystem/delete.php?id=$row[id]' role='button'>Delete</a>
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