<?php defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'ciphering' => 'AES-128-CTR', // Store the cipher method 
    'iv_length' => openssl_cipher_iv_length('AES-128-CTR'), // Use OpenSSl Encryption method
    'options' => 0,
    'encryption_iv' => '1234567891011121', // Non-NULL Initialization Vector for encryption 
    'encryption_key' => 'Kisanzone' 
);

?>