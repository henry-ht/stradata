<?php
namespace App\Helpers;

use Ramsey\Uuid\Type\Integer;

class Similarity {

    public function __construct(){}

    private static function similarity(String $str1, String $str2):String {
        similar_text(ucwords($str1), ucwords($str2), $perc);
        return $perc;
    }

    public static function get(String $str1, String $str2):int {
        return self::similarity($str1, $str2);
    }

    public static function percentage(String $str1, String $str2):String {
        return self::similarity($str1, $str2). '%';
    }
}
