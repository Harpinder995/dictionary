<?php
// Start session
session_start();

// Check if user is logged in
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true){
    $servername = "localhost";
$username = "root";
$password = "";
$dbname = "pupdictionary"; // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);



    // User is logged in
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
 
    <style>


.main {
        background-color: #ADD8E6;
        text-align: center;
        padding: 40px;
    }

    .main h2 {
        color: #FFD700;
        font-size: 40px;
    }

    .main img {
        width: 200px;
        height: 100px;
        float: right;
        margin-top: -80px;
    }
.log{
    display: flex;
        justify-content: end;
}
    .logbtn{
       
        margin:20px;
        background:#ADD8E6; 
        border-radius:6px ;
        padding:5px;
      
    }
    .center{
        display: flex;
        justify-content:center;
    }
.mtext{
    color:#FFD700;
    font-size:35px;
    padding:10px;
    margin-top:50px;

}
.exform{
    display: flex;
        justify-content:space-evenly;


}
.export{

    background:#ADD8E6; 
        border-radius:6px ;
        padding:10px 10px;

       
        margin-top:20px;

}
.export1{
    padding:10px 22px;
}

.footer {
        position:fixed;
        bottom:0;
        left:0;
        width: 100%;
        text-align: center;
        font-size: 15px;
        padding: 18px;
        background-color: #FFD700;
        
    }
    </style>
       </head>
    <body>
    <div class="main">
    <h2>Welcome to Admin Panel of ਪੰਜਾਬੀ ਸ਼ਬਦਕੋਸ਼ </h2>
        <img src="pup_logo.png" alt="PUP Patiala Logo">

    </div>
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-2"></div>
      <div class="col-lg-8 col-md-8 col-sm-8">
   <div class="log">
      <form  method="post">

<button class="logbtn  " type="submit" name="logout">Log Out</button>
</form>
</div>
<div class="center">
<h2 class="mtext">Export Data Using Below Buttons </h2>
    

    </div>
<div class="exform">
    <form  method="post">
        <button type="submit" name="export_csv" class="export export1 btn btn-success ">Not Found Words</button> <br>
        <button type="submit" name="export_csv" class="export btn btn-warning ">Words with Meanings</button>

    </form>
    </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2"></div>
    </div>
    <div class="footer">
                    
                        &copy; 2024 Punjabi University Patiala
                    </div>
    </body>
    </html>














    <?php

if(isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page or wherever appropriate after logout
    header("Location: login.php");
    exit();
}
// Check if the submit button is clicked
if(isset($_POST['export_csv'])) {
    // Connect to your MySQL database
    $mysqli = new mysqli($servername, $username, $password, $dbname);


    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Query to fetch data from the table
    $sql = "SELECT * FROM notfound";

    // Execute query
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {

        // Create CSV file
        $file = fopen('export.csv', 'w');
        fputs($file, "\xEF\xBB\xBF"); // UTF-8 BOM
        // Add CSV headers
        fputcsv($file, array('id', 'word', 'count'));

        // Add data rows
        while ($row = $result->fetch_assoc()) {
            fputcsv($file, $row);
        }

        // Close file
        fclose($file);
        ob_clean();
        
        // Send headers for file download
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=export.csv');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Read and output the file
        readfile('export.csv');
        // Download the CSV file
    
        exit();
    } else {
        echo "No data found";
    }

    // Close MySQL connection
    $mysqli->close();
}
?>


<?php
    
} else {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}
?>
