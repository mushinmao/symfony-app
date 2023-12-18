<?php

namespace App\Controller;

use App\Service\ShortenerService;
use App\Shortener\Interface\DecoderInterface;
use App\Shortener\Interface\EncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shortener', name: 'app_shortener')]
class ShortenerController extends AbstractController
{

    #[Route('/encode', name: 'app_shortener_encoder', methods: ['GET'])]
    public function encode(EncoderInterface $encoder, Request $request): Response
    {

        return new Response($encoder->encode($request->query->get('url'), $request->query->get('code')));
    }

    #[Route('/decode', name: 'app_shortener_decoder', methods: ['GET'])]
    public function decode(DecoderInterface $decoder, Request $request): Response
    {
        return new Response($decoder->decode($request->query->get('code')));
    }
}
