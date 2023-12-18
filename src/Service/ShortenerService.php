<?php

namespace App\Service;

use App\Entity\Shortener;
use App\Shortener\Exception\DataNotFoundException;
use App\Shortener\Interface\RepositoryInterface;
use App\Shortener\Value\UrlCodeObject;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class ShortenerService implements RepositoryInterface
{
    protected ObjectRepository $repository;
    public function __construct(protected EntityManagerInterface $manager)
    {
        $this->repository = $manager->getRepository(Shortener::class);
    }

    /**
     * @param string $url
     * @return string
     * @throws DataNotFoundException
     */
    public function getCodeByUrl(string $url): string
    {
        return $this->getData(['url' => $url])->getCode();
    }

    /**
     * @param string $code
     * @return string
     * @throws DataNotFoundException
     */
    public function getUrlByCode(string $code): string
    {
        return $this->getData(['code' => $code])->getUrl();
    }

    /**
     * @param UrlCodeObject $data
     * @return void
     */
    public function save(UrlCodeObject $data): void
    {
        $this->manager->persist(new Shortener($data->getUrl(), $data->getCode()));
        $this->manager->flush();
    }

    /**
     * @throws DataNotFoundException
     * @return ObjectRepository
     */
    protected function getData(array $criteria): object
    {
        $entity = $this->repository->findOneBy($criteria);
        if(is_null($entity)) {
            throw new DataNotFoundException();
        }

        return $entity;
    }
}