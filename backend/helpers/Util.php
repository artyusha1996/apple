<?php


namespace App\Helpers;


use phpDocumentor\Reflection\Types\Integer;

class Util
{
    /**
     * @param Integer $percentage
     * @return bool
     */
    public static function isValidPercentage(Integer $percentage)
    {
        return $percentage > 0 && $percentage <= 100;
    }
}
