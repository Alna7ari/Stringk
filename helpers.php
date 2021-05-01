<?php

use Alnahari\Stringk\Stringk;

if (! function_exists('string')) {

    /**
     * @param string $string
     * @return Stringk
     */
    function string($string)
    {
        return new Stringk($string);
    }
}

if (! function_exists('stringk')) {

    /**
     * @param string $string
     * @return Stringk
     */
    function stringk($string)
    {
        return new Stringk($string);
    }
}
