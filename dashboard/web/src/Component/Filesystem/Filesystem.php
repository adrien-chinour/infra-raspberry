<?php

namespace App\Component\Filesystem;

class Filesystem
{
    /**
     * @param string $dir
     * @param bool $float
     * @return Filesize|float
     */
    public function free(string $dir, bool $float = false)
    {
        $size = disk_free_space($dir) ?: 0;
        return $float ? $size : new Filesize($size);
    }

    /**
     * @param string $dir
     * @param bool $float
     * @return Filesize|false|float|int
     */
    public function total(string $dir, bool $float = false)
    {
        $size = disk_total_space($dir) ?: 0;
        return $float ? $size : new Filesize($size);
    }

    public function charge(string $dir): int
    {
        return 100 - floor(100 * $this->free($dir, true) / $this->total($dir, true));
    }
}
