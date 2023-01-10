<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->redirectToRoute("home");
    }

    #[Route('/{id}', 'tweets_id', requirements: ["id"=>"\d+"])]
    public function tweetsById(int $id): Response
    {
        return new Response("Tuits de l'usuari amb id {$id}");
    }

    #[Route('/{username}', 'tweets_username')]
    public function tweetsByUsername(string $username): Response
    {
        return new Response("Tuits de l'usuari {$username}");
        /*return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);*/
    }

    #[Route('/home', name: 'home', priority: 10)]
    public function home(): Response
    {
        return new Response('Welcome to Truiter');
    }

}
