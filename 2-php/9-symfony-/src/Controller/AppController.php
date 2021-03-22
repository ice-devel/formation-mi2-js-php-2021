<?php

namespace App\Controller;

use App\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/app')]
class AppController extends AbstractController
{
    #[Route('/{id}', name: 'app')]
    public function index(Request $request, $id): Response
    {
        // on préférera récupérer des paramètres dans l'url via le router
        // plutôt que de faire ça :
        // $id = $request->query->get('id');

        /*
         * On récupère les paramètres de route en les injectant dans
         * la méthode du controller
         */

        $range = range(5, 13);

        $message = new Message();
        $message->setCreatedAt(new \DateTime());
        $message->setDescription("Coucou pourquoi le maker bundle i marche pu avec doctrine bundle 2.3");

        return $this->render('app/index.html.twig', [
            'random' => rand(0,20),
            'id' => $id,
            'range' => $range,
            'message' => $message
        ]);
    }

    #[Route('/list', name: 'messages', priority: 2)]
    public function message(): Response
    {
        return $this->json(['page' => 'all messages']);
    }

    #[Route('/articles/{year}/{month}/{day<^\d{1,2}$>?null}', name: 'articles',
        requirements: [
            'year' => '^\d{4}$',
            'month' => '^\d{1,2}$'
        ]
    )]
    public function articles($month, $year, $day=null): Response
    {
        return $this->json([
            'day' => $day,
            'month' => $month,
            'year' => $year,
        ]);
    }
}
