<?php

namespace App\Shortener\Interface;

interface EncoderInterface
{
    public function encode(string $url): string;
}