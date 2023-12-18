<?php

namespace App\Shortener\Value;

class UrlCodeObject
{
    public function __construct(
        protected string $url,
        protected string $code
    )
    {}

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCode(): string
    {
        return $this->code;
    }
}