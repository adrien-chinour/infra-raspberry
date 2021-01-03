<?php

namespace App\Component\Filesystem;

class Filesize
{
    private float $size;

    public function __construct(float $size)
    {
        $this->size = $size;
    }

    public function __toString(): string
    {
        return (string) $this->toHumanFormat();
    }

    public function toHumanFormat(): string
    {
        $index = min((int) log($this->size, 1024), count(Unit::$all) - 1);
        $unit = Unit::$all[$index];

        return sprintf('%1.2f %s', Unit::convert($this->size, Unit::BYTE, $unit), $unit);
    }

    public function in(string $unit): float
    {
        return Unit::convert($this->size, Unit::BYTE, $unit);
    }

    public function float(): float
    {
        return $this->size;
    }

    public function int(): int
    {
        return (int) $this->size;
    }
}
