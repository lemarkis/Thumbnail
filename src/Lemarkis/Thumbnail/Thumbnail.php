<?php

namespace Lemarkis\Thumbnail;

class Thumbnail
{
    var $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function path($url, $width = 100, $height = 100) {
        return route('thumbnail', compact('url', 'width', 'height'));
    }
}
