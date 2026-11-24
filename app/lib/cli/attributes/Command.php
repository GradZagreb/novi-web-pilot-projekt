<?php

namespace gradZagrebWeb2024\lib\cli\attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Command
{
    public ?string $name;
    public ?string $shortdesc;

    public function __construct(?string $name = null, ?string $shortdesc = null)
    {
        $this->name = $name;
        $this->shortdesc = $shortdesc;
    }
}
