<?php

class Hash
{
    /**
     * @param $algo hash algorithm
     *              алгоритм хэширования
     * @param $data data
     *              данные
     * @param $salt secret key
     *              дополнительный ключ
     * @return string result
     *                результат
     */
    static function create($algo,$data,$salt)
    {
        $context = hash_init($algo, HASH_HMAC, $salt); // HASH_HMAC for $salt (обязательное значение)
        hash_update($context, $data);
        return hash_final($context);
    }
}