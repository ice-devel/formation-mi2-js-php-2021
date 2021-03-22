<?php

namespace App\Controller;

use App\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/doctrine')]
class DoctrineController extends AbstractController
{
    #[Route('/', name: 'doctrine_index')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $messages = $em->getRepository(Message::class)->findAll();

        return $this->render('doctrine/index.html.twig', [
            'messages' => $messages
        ]);
    }

    #[Route('/new', name: 'doctrine_new')]
    public function new(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $message = new Message();
        $message->setDescription("Numéro aléatoire ".rand(1, 1000));

        // on dit à doctrine de gérer cette entité
        $em->persist($message);
        // on lance les requêtes en attente
        $em->flush();

        // l'id est setté dès que le flush est passé
        return $this->json(['id' => $message->getId()]);
    }

    #[Route('/update/{id}', name: 'doctrine_update')]
    public function update($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $message = $em->getRepository(Message::class)->find($id);

        // le message n'existe pas en bdd : on lance une 404
        if (!$message) {
            throw new NotFoundHttpException();
        }

        /** @var Message $message */
        $message->setDescription($message->getDescription()." - modifié");

        // envoi des modifs en bdd
        // pas besoin de faire un persist vu que c'est doctrine qui a récupéré l'entité en bdd
        // il la connait déjà
        $em->flush();

        return $this->redirectToRoute('doctrine_index');
    }


    #[Route('/delete/{id}', name: 'doctrine_delete')]
    public function delete(Message $message): Response
    {
        // l'instance est récupéré automatiquement grâce au paramconverter
        // le paramètre de route id est utilisé pour récupérer l'objet
        // qu'on a typé dans la signature
        $em = $this->getDoctrine()->getManager();
        $em->remove($message);
        $em->flush();

        return $this->redirectToRoute('doctrine_index');
    }
}
