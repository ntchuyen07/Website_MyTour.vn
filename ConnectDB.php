<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
     integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <title>CSDL</title>
</head>

<style>
    * {
        font-family: 'Roboto Condensed', sans-serif;
    }
</style>

<body>
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <th>ID</th>
                        <th>Tên danh mục</th>
                    </thead>
                    <tbody>
                    <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "mytour";

                        // Create conenction
                        $conn = mysqli_connect($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        $sql = "SELECT * FROM category";
                        $result = mysqli_query($conn, $sql);

                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>".$row["id"]."</td><td>".$row["tendanhmuc"]."</td></tr>";
                            }
                        } else {
                            echo "0 result";
                        }

                        mysqli_close($conn);
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>