// Store the cipher method 
        $ciphering = "AES-128-CTR"; 
  
        // Use OpenSSl Encryption method 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
  
        // Non-NULL Initialization Vector for encryption 
        $encryption_iv = '1234567891011121'; 
  
        // Store the encryption key 
        $encryption_key = "Kisanzone";  
<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'ciphering' => 'AES-128-CTR', // Store the cipher method 
    'iv_length' => openssl_cipher_iv_length($ciphering), // Use OpenSSl Encryption method
    'options' => 0,
    'encryption_iv' => '1234567891011121', // Non-NULL Initialization Vector for encryption 
    'encryption_key' => 'Kisanzone'
);

?>