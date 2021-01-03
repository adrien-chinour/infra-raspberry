<?php

namespace App\Component\Filesystem;

class Unit
{
    public const BYTE = 'B';
    public const KILOBYTE = 'KB';
    public const MEGABYTE = 'MB';
    public const GIGABYTE = 'GB';
    public const TERABYTE = 'TB';
    public const PETABYTE = 'PB';
    public const EXABYTE = 'EB';
    public const ZETTABYTE = 'ZB';
    public const YOTTABYTE = 'YB';

    public static array $all = [
        self::BYTE,
        self::KILOBYTE,
        self::MEGABYTE,
        self::GIGABYTE,
        self::TERABYTE,
        self::PETABYTE,
        self::EXABYTE,
        self::ZETTABYTE,
        self::YOTTABYTE,
    ];

    public static function convert(float $size, string $from, string $to): float
    {
        return ($size * pow(1024, self::index($from))) / pow(1024, self::index($to));
    }

    private static function index(string $unit): int
    {
        if (!in_array($unit, self::$all)) {
            throw new \InvalidArgumentException(sprintf("Unit '%s' is not a valid unit. Accepted value : [%s]", $unit, implode(' , ', self::$all)));
        }

        return array_keys(self::$all, $unit)[0];
    }

}
