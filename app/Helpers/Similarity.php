<?php
namespace App\Helpers;

use Ramsey\Uuid\Type\Integer;

class Similarity {

    public function __construct(){}

    private static function similarity(String $str1, String $str2):String {
        $len1 = strlen($str1);
        $len2 = strlen($str2);

        $max = max($len1, $len2);
        $similarity = $i = $j = 0;

        while (($i < $len1) && isset($str2[$j])) {
            if ($str1[$i] == $str2[$j]) {
                $similarity++;
                $i++;
                $j++;
            } elseif ($len1 < $len2) {
                $len1++;
                $j++;
            } elseif ($len1 > $len2) {
                $i++;
                $len1--;
            } else {
                $i++;
                $j++;
            }
        }

        return round($similarity / $max, 2);
    }

    public static function get($str1, $str2):int {
        return (self::similarity($str1, $str2)* 100);
    }

    public static function percentage($str1, $str2):String {
        return (self::similarity($str1, $str2) * 100). '%';
    }
}
