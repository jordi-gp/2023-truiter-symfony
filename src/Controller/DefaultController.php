<?php

namespace App\Controller;

use App\Entity\Tweet;
use App\Entity\User;
use App\Repository\TweetRepository;
use App\Repository\UserRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DefaultController extends AbstractController
{
    # Per a poder fer les migracions i utilitzar les bases de dades
    # cal executar en el terminal el comandament:
    # 'sudo docker exec -it 2023-truiter-symfony_web-server_1 /bin/bash'
    # si es treballa en l'equip local de casa el nom del servici es 2023-truiter-symfony-web-server-1

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
        #return new Response("Tuits de l'usuari amb id {$id}");

        $text = "Tuits de l'usuari amb id $id";

        return $this->render('default/index.html.twig', [
            'message' => $text,
        ]);
    }

    #[Route('/{username}', 'tweets_username')]
    public function tweetsByUsername(string $username): Response
    {
        #return new Response("Tuits de l'usuari {$username}");

        $text = "Tuits de l'usuari $username";

        return $this->render('default/index.html.twig', [
            'message' => $text,
        ]);
    }

    #[Route('/home', name: 'home', priority: 10)]
    public function home(UserRepository $userRepository, TweetRepository $tweetRepository, ValidatorInterface $validator): Response
    {
        /*$user = new User;

        $errors = $validator->validate($user);
        dump($errors);

        if(count($errors)>0)
            return new Response($errors);
        $userRepository->save($user);*/

        $tweets = $tweetRepository->findBy([], ["createdAt"=>"DESC"]);
        #$tweets = $tweetRepository->findAll();

        return $this->render('default/index.html.twig', [
            'tweets' => $tweets
        ]);
    }

}
