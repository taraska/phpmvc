<?php

class Hash
{
    static function getHash($pass)
    {
        $hash = hash_init('md5', HASH_HMAC, HASH_KEY);
        hash_update($hash, $pass);
        return hash_final($hash);
    }
}