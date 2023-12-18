<?php

namespace App\Shortener\Interface;

use App\Shortener\Value\UrlCodeObject;

interface RepositoryInterface
{
    public function getCodeByUrl(string $url): string;
    public function getUrlByCode(string $code): string;
    public function save(UrlCodeObject $data): void;
}