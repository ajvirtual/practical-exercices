<?php

     /**
        * Define the number of blocks that should be read from the source file for each chunk.
        * For 'AES-128-CBC' each block consist of 16 bytes.
        * So if we read 10,000 blocks we load 160kb into memory. You may adjust this value
        * to read/write shorter or longer chunks.
        */
        define('FILE_ENCRYPTION_BLOCKS', 10000);
        /**
        * Encrypt the passed file and saves the result in a new file with ".enc" as suffix.
        *
        * @param string $source Path to file that should be encrypted
        * @param string $key The key used for the encryption
        * @param string $dest File name where the encryped file should be written to.
        * @return string|false Returns the file name that has been created or FALSE if an error occured
        */
        function encryptFile($source, $key, $dest) {
            $key = substr(sha1($key, true), 0, 16);
            $iv = openssl_random_pseudo_bytes(16);
            $error = false;
            if ($fpOut = fopen($dest, 'w')) {
            // Put the initialzation vector to the beginning of the file
            fwrite($fpOut, $iv);
            if ($fpIn = fopen($source, 'rb')) {
                while (!feof($fpIn)) {
                    $plaintext = fread($fpIn, 16 * FILE_ENCRYPTION_BLOCKS);
                    $ciphertext = base64_encode(openssl_encrypt($plaintext, 'AES-128-CBC', $key, OPENSSL_RAW_DATA,
                    $iv));
                    // Use the first 16 bytes of the ciphertext as the next initialization vector
                    $iv = substr($ciphertext, 0, 16);
                    fwrite($fpOut, $ciphertext);
                }
                fclose($fpIn);
            } else {
                 $error = true;
            }
        fclose($fpOut);
        } else {
        $error = true;
        }
            return $error ? false : $dest;
        }


    /**
        * Dencrypt the passed file and saves the result in a new file, removing the
        * last 4 characters from file name.
        *
        * @param string $source Path to file that should be decrypted
        * @param string $key The key used for the decryption (must be the same as for encryption)
        * @param string $dest File name where the decryped file should be written to.
        * @return string|false Returns the file name that has been created or FALSE if an error occured
        */
        function decryptFile($source, $key, $dest) {
            $key = substr(sha1($key, true), 0, 16);
            $error = false;
            if ($fpOut = fopen($dest, 'w')) {
                if ($fpIn = fopen($source, 'rb')) {
                // Get the initialzation vector from the beginning of the file
                    $iv = fread($fpIn, 16);
                    while (!feof($fpIn)) {
                    $ciphertext = fread($fpIn, 16 * (FILE_ENCRYPTION_BLOCKS + 1)); 
                    // we have to read one block more for decrypting than for encrypting
                    $plaintext = openssl_decrypt(base64_decode($ciphertext), 'AES-128-CBC', $key, OPENSSL_RAW_DATA,
                    $iv);
                    // Use the first 16 bytes of the ciphertext as the next initialization vector
                    $iv = substr($ciphertext, 0, 16);
                    fwrite($fpOut, $plaintext);
                }
                fclose($fpIn);
            } else {
                 $error = true;
            }
            fclose($fpOut);
            } else {
                 $error = true;
            }
            return $error ? false : $dest;
        }   


    if(isset($_GET['act']) && $_GET['act'] == 'c') {

        $method = "aes-256-cbc"; // cipher method
        $iv_length = openssl_cipher_iv_length($method); // obtain required IV length
        $strong = false; // set to false for next line
        $iv = openssl_random_pseudo_bytes($iv_length, $strong); // generate initialization vector
        /* NOTE: The IV needs to be retrieved later, so store it in a database.
        However, do not reuse the same IV to encrypt the data again. */
        if(!$strong) { // throw exception if the IV is not cryptographically strong
        throw new Exception("IV not cryptographically strong!");
        echo 'IV not cryptographically strong!';
        }
        $data = "This is a message to be secured."; // Our secret message
        $pass = "Stack0verfl0w"; // Our password
        /* NOTE: Password should be submitted through POST over an HTTPS session.
        Here, it's being stored in a variable for demonstration purposes. */
        $enc_data = base64_encode(openssl_encrypt($data, $method, $pass, true, $iv)); // Encrypt
        echo $enc_data;
        echo '<br>'.strlen($enc_data);

    } elseif (isset($_GET['act']) && $_GET['act'] == 'd') {


    } elseif(isset($_GET['act']) && $_GET['act'] == 'cf') {
       
        encryptFile('test_crypt.txt', 'anja', 'test_crypt.txt.enc');

    } elseif(isset($_GET['act']) && $_GET['act'] == 'df') {

        decryptFile('test_crypt.txt.enc', 'anja', 'test_crypt.txt.dec');

    }

?>