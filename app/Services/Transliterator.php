<?php

namespace App\Services;

class Transliterator
{
    const MAP = [
        'Š' => 'S',
        'š' => 's',
        'Ć' => 'C',
        'ć' => 'c',
        'Č' => 'C',
        'č' => 'c',
        'Đ' => 'Dj',
        'đ' => 'dj',
        'Ž' => 'Z',
        'ž' => 'z',
    ];

    public function transliterate(string $string)
    {
        return strtr($string, self::MAP);
    }
}
