<?php

namespace App\Shortener\Interface;

interface RandomizerInterface
{
    public function randomize(): string;
}