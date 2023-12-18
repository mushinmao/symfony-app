<?php

namespace App\Shortener;

use App\Shortener\Exception\DataNotFoundException;
use App\Shortener\Interface\DecoderInterface;
use App\Shortener\Interface\EncoderInterface;
use App\Shortener\Interface\RandomizerInterface;
use App\Shortener\Interface\RepositoryInterface;
use App\Shortener\Interface\ValidatorInterface;
use App\Shortener\Value\UrlCodeObject;

class Shortener implements EncoderInterface, DecoderInterface
{
    public function __construct(
        protected ValidatorInterface $validator,
        protected RepositoryInterface $repository,
        protected RandomizerInterface $randomizer
    )
    {}

    /**
     * @param string $code
     * @return string
     */
    public function decode(string $code): string
    {
       return $this->getUrl($code);
    }

    /**
     * @param string $url
     * @param string|null $code
     * @return string
     */
    public function encode(string $url, ?string $code = null): string
    {
        $this->validator->validate($url);

        return $this->getOrSaveCode($url, $code ?? $this->randomizer->randomize());
    }

    protected function getOrSaveCode(string $url, string $code): string
    {
        try {
            return $this->repository->getCodeByUrl($url);
        } catch(DataNotFoundException $e) {
            return $this->save($url, $code);
        }
    }

    protected function getUrl(string $code): string
    {
        try {
            return $this->repository->getUrlByCode($code);
        } catch(DataNotFoundException $e) {
            echo $e->getMessage();
        }
    }

    protected function save(string $url, string $code): string
    {
        $this->repository->save(new UrlCodeObject($url, $code));

        return $code;
    }
}