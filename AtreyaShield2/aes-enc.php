<?php
// $filename = "testfile.txt";
// $key = md5('mihir'); // 16 bytes for AES-128, 24 bytes for AES-192, and 32 bytes for AES-256
// $cipher_method = "AES-128-CBC";
// $iv_length = openssl_cipher_iv_length($cipher_method);
// $iv = openssl_random_pseudo_bytes($iv_length);
// $options = OPENSSL_RAW_DATA;
// $data = file_get_contents($filename);
// $ciphertext = openssl_encrypt($data, $cipher_method, $key, $options, $iv);
// $encrypted_filename = "encrypted_" . $filename;
// file_put_contents($encrypted_filename, $iv . $ciphertext);
// echo "Key: " . base64_encode($key) . "\n";

?>

<?php

define('FILE_ENCRYPTION_BLOCKS', 10000);

/**
 * @param  $source  Path of the unencrypted file
 * @param  $dest  Path of the encrypted file to created
 * @param  $key  Encryption key
 */
function encryptFile($source, $dest, $key)
{
    $cipher = 'aes-256-cbc';
    $ivLenght = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivLenght);

    $fpSource = fopen($source, 'rb');
    $fpDest = fopen($dest, 'w');

    fwrite($fpDest, $iv);

    while (! feof($fpSource)) {
        $plaintext = fread($fpSource, $ivLenght * FILE_ENCRYPTION_BLOCKS);
        $ciphertext = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $iv = substr($ciphertext, 0, $ivLenght);

        fwrite($fpDest, $ciphertext);
    }

    fclose($fpSource);
    fclose($fpDest);
}


// encryptFile('prac1.txt', 'encrypted_prac1.txt', 'mihir123');
// echo $fpDest;
// echo "File encrypted!\n";
// echo 'Memory usage: ' . round(memory_get_usage() / 1048576, 2) . "M\n";