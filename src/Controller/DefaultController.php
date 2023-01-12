<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    # Per a poder fer les migracions i utilitzar les bases de dades
    # cal executar en el terminal el comandament:
    # 'sudo docker exec -it 2023-truiter-symfony_web-server_1 /bin/bash'

    # Per a comprovar el nom dels contenidors de docker gastar comandament:
    # 'sudo docker ps'

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
