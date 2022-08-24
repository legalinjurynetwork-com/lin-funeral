<?php

namespace App\Classes;

class Encryption
{
    public static function encrypt($message){
        $enc_method = 'AES-128-CTR';
        $enc_key = md5("kdsfjl3garble33sdfksj" );
        $enc_iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($enc_method));
        return $crypted_token = openssl_encrypt($message, $enc_method, $enc_key, 0, $enc_iv) . "::" . bin2hex($enc_iv);
    }

    public static function decrypt($message){
        $enc_method = 'AES-128-CTR';
        $enc_key = md5("kdsfjl3garble33sdfksj" );
        $enc_iv = "";
        if(preg_match("/^(.*)::(.*)$/", $message, $regs)) {
            list(, $message, $enc_iv) = $regs;
            return $decrypted_token = openssl_decrypt($message, $enc_method, $enc_key, 0, hex2bin($enc_iv));
        } else {
            return "unable to decrypt";
        }
    }
}
?>
