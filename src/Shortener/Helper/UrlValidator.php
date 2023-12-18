<?php

namespace App\Shortener\Helper;

use App\Shortener\Interface\ValidatorInterface;
use App\Shortener\Exception\UrlStatusException;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;


class UrlValidator implements ValidatorInterface
{
    /**
     * @param ClientInterface $client
     */
    public function __construct(protected ClientInterface $client){}

    /**
     * @param string $url
     * @return bool
     */
    public function validate(string $url): bool
    {
        try {
            $response = $this->client->request('GET', $url);
            return $this->checkStatusCode($response);

        } catch (GuzzleException|UrlStatusException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * @throws UrlStatusException
     */
    public function checkStatusCode(ResponseInterface $response): bool
    {
        if ($response->getStatusCode() !== 200) {
            throw new UrlStatusException('Url must be return status "200 OK". Url status: '. $response->getStatusCode());
        }

        return true;
    }
}