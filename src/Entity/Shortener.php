<?php

namespace App\Entity;

use App\Repository\ShortenerRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Table(name: 'short_links')]
#[ORM\Entity(repositoryClass: ShortenerRepository::class)]
class Shortener
{
    #[ORM\Id]
    #[ORM\Column(type: Types::INTEGER)]
    #[ORM\GeneratedValue]
    protected int $id;

    #[ORM\Column(type: Types::STRING, nullable: false)]
    protected string $url;

    #[ORM\Column(type: Types::STRING, nullable: false)]
    protected string $code;

    public function __construct(string $url, string $code)
    {
        $this->url = $url;
        $this->code = $code;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function changeUrl(string $url): Shortener
    {
        $this->url = $url;
        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function changeCode(string $code): Shortener
    {
        $this->code = $code;
        return $this;
    }
}