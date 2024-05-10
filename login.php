<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

</head>

<style>


.main {
    padding: 50px;
}

button {
    background-color: #4CAF50;
    width: 100%;
  
    padding: 15px;
    margin: 10px 0px;
    border: none;
    cursor: pointer;
}

form {
    border: 3px solid #f1f1f1;
}

input[type=text],
input[type=password] {
    width: 100%;
    margin: 8px 0;
    padding: 12px 20px;
    display: inline-block;
    border: 2px solid green;
    box-sizing: border-box;
}

button:hover {
    opacity: 0.7;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    margin: 10px 5px;
}


.container {
    padding: 25px;
    background-color: lightblue;
}

#logh1{
    margin-top:40px;
}
</style>


</style>

<?php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from the form
    $name = $_POST["username"];
    $pass = $_POST["password"];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pupdictionary"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM admin WHERE username = ? AND password = ?";

$stmt = $conn->prepare($sql);
print($name);
print($password);
$stmt->bind_param("ss", $name, $password);
$stmt->execute();
$result = $stmt->get_result();
$sql = "SELECT * FROM admin WHERE username = '$name' AND password = '$pass'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $_SESSION['logged_in'] = true;

    // Redirect to next page
    header("Location: main.php");
    exit; // Make sure to exit after redirection
} else {
    echo "Invalid username or password. Please try again.";
}
} else {
    // Redirect back to the login form if accessed directly without submitting the form
    

}
?>



<body>
    <div class="row">
        <div class= "col-12  col-md-3 col-lg-4"></div>
        <div class="col-12 col-md-6 col-lg-4">
            <center>
                <h1 id="logh1"> Login Form </h1>
            </center>
            <div class="main d-flex justify-content-center">


                <form action="login.php" method="post">
                    <div class="container">
                        <label>Username : </label>
                        <input type="text" placeholder="Enter Username" id="username" name="username" required>
                        <label>Password : </label>
                        <input type="password" placeholder="Enter Password" id="password" name="password" required>
                        <button type="submit" value="Login">Login</button>
               
                       
                    </div>
                </form>

            </div>
        </div>
        <div class="col-12 col-md-3 col-lg-4"></div>
    </div>
</body>

</html>