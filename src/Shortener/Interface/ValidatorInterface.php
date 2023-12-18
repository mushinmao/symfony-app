<?php

namespace App\Shortener\Interface;

interface ValidatorInterface
{
    public function validate(string $url): bool;
}