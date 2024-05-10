<?php
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

// API endpoint to fetch data
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['word'])) {
        $word = $_GET['word'];
        
        // Fetch data from the database based on the word
        $sql = "SELECT * FROM dictionary WHERE word = ?";
        $stmt = $conn->prepare($sql);

        // Check if the prepared statement was created successfully
        if ($stmt) {
            $stmt->bind_param("s", $word);
            $stmt->execute();
            $result = $stmt->get_result();
            
          
            // Check if data was fetched successfully
          
            if ($result) 
            {        

                $data = array();
                 $found=false;
                while ($row = $result->fetch_assoc()) {
                    $found=true;

                    $data[] = $row;
                    $c= ++$row['count'];
                
                    $sql3 = "UPDATE `dictionary` SET `count` = $c WHERE id = " . $row['id'];

                    $stmt3 = $conn->prepare($sql3);
            
                    // Check if the prepared statement was created successfully
                    if ($stmt3) {
               
                        $stmt3->execute();
                }
                    
                }
                if(!$found)
                {
                    $sql2 = "Select * FROM notfound WHERE word = ?";
                    $stmt2 = $conn->prepare($sql2);
                    if ($stmt2) {
                        $stmt2->bind_param("s", $word);
                        $stmt2->execute();
                        $result2 = $stmt2->get_result();
                        if ($result2) 
                        {    
                            $found2=false;
                            while ($row2 = $result2->fetch_assoc()) {
                                   $found2=true;
                              
                                   $c=$row2['count']+1;
                                   $sql = "UPDATE `notfound` SET `count` = $c WHERE id = " . $row2['id'];

                                   $stmt = $conn->prepare($sql);
                           
                                   // Check if the prepared statement was created successfully
                                   if ($stmt) {
                                      
                                       $stmt->execute();
                               }
                                   
                         }   
                        }
                        if(!$found2)
                        {     
                            $sql = "INSERT INTO `notfound` ( `word`, `count`) VALUES ( ?, '1');";
                            $stmt = $conn->prepare($sql);
                    
                            // Check if the prepared statement was created successfully
                            if ($stmt) {
                                $stmt->bind_param("s", $word);
                                $stmt->execute();
                        }
                    }
                }

           
           
           
           
           
           
           
           
           
           
           
           
                }
        
               

            
                // Set response headers
                header('Content-Type: application/json');
                $key1=hex2bin("42e01205163a287e4d411a43a987dd15b2c830028268d68124be22f73087ab1e");
                $iv1=hex2bin("cd9c9bc0074e870065776502bfbd64c8");
                // Convert data to JSON format
                $jsonData = json_encode($data);
                
                // // Encrypt the JSON data using AES-256-CBC encryption
                // $encryptedData = openssl_encrypt($jsonData, 'aes-256-cbc', $key1, OPENSSL_RAW_DATA, $iv1);
    
                // // Encode the encrypted data in base64 format for safe transmission
                // $encodedData = base64_encode($encryptedData);
                
                // // Output the encrypted data (you would typically send this as your response)
                echo $jsonData;
                

            } else {
                http_response_code(500);
                echo json_encode(array("error" => "Error fetching data from the database."));
            }
        } else {
            http_response_code(500);
            echo json_encode(array("error" => "Error preparing SQL statement."));
        }
        
        // Close the prepared statement
        $stmt->close();
    } else {
        http_response_code(400);
        echo json_encode(array("error" => "Missing 'word' parameter."));
    }
} else {
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("error" => "Method not allowed."));
}
$conn->close();
?>
