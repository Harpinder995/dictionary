<!-- <?php
// Generate a random key for AES encryption (256-bit key)
// $key = openssl_random_pseudo_bytes(32); // 32 bytes = 256 bits

// Convert the binary key to hexadecimal format for storage or display
// $hexKey = bin2hex($key);

// Output the generated key
 // print_r("Generated AES Key: $hexKey");
?>
<?php
// Generate a random IV for AES encryption (16 bytes for AES-128-CBC, 24 bytes for AES-192-CBC, 32 bytes for AES-256-CBC)
 // $iv = openssl_random_pseudo_bytes(16); // 16 bytes = 128 bits for AES-128-CBC

// Convert the binary IV to hexadecimal format for storage or display
 // $hexIV = bin2hex($iv);

// Output the generated IV
 // print_r( "Generated IV: $hexIV");
?> -->

<?php

$key1=hex2bin("42e01205163a287e4d411a43a987dd15b2c830028268d68124be22f73087ab1e");
$iv1=hex2bin("cd9c9bc0074e870065776502bfbd64c8");
// Sample data to be encrypted (replace this with your actual data)
$data = array(
    'name' => 'John Doe',
    'email' => 'johndoe@example.com'
);

// Convert data to JSON format
$jsonData = json_encode($data);

// Encrypt the JSON data using AES-256-CBC encryption
$encryptedData = openssl_encrypt($jsonData, 'aes-256-cbc', $key1, OPENSSL_RAW_DATA, $iv1);

// Encode the encrypted data in base64 format for safe transmission
$encodedData = base64_encode($encryptedData);

// Output the encrypted data (you would typically send this as your response)
echo $encodedData;


$decodedData = base64_decode($encodedData);

// Decrypt the data using AES-256-CBC decryption
$decryptedData = openssl_decrypt($decodedData, 'aes-256-cbc', $key1, OPENSSL_RAW_DATA, $iv1);

// Convert the decrypted data from JSON format to PHP array
$originalData = json_decode($decryptedData, true);

// Output the decrypted original data
print_r($originalData);
?>
