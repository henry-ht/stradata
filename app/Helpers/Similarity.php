<?php
namespace App\Helpers;

class Similarity {
    public String $str1;
    public String $str2;

    public function __construct($str1, $str2){}

    private static function similarity($str1, $str2):String {
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

    public static function get($str1, $str2):String {
        return (self::similarity($str1, $str2)* 100);
    }

    public static function percentage($str1, $str2):String {
        return (self::similarity($str1, $str2) * 100). '%';
    }
}
