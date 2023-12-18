<?php

namespace App\Shortener\Helper;

use App\Shortener\Interface\RandomizerInterface;

class Randomizer implements RandomizerInterface
{
    protected int $codeLength;

    protected string $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function __construct(int $codeLength = 8)
    {
        $this->codeLength = $codeLength;
    }


    /**
     * @return string
     */
    public function randomize(): string
    {
        $charactersLength = strlen($this->characters);

        $string = '';

        for ($i = 0; $i < $this->codeLength; $i++)
        {
            $string .= $this->characters[random_int(0, $charactersLength - 1)];
        }

        return $string;
    }
}