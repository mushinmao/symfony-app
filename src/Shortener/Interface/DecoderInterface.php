<?php

namespace App\Shortener\Interface;

interface DecoderInterface
{
    public function decode(string $code): string;
}