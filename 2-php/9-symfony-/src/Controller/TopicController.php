<?php

namespace App\Controller;

use App\Entity\Topic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/topic')]
class TopicController extends AbstractController
{
    #[Route('/', name: 'topic_index')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Topic::class);
        $topics = $repo->findAll();

        return $this->json($topics);
    }

    #[Route('/new', name: 'topic_new')]
    public function create(): Response
    {
        $topic = new Topic();
        $topic->setName("PHP IS NOT WORKING");

        $em = $this->getDoctrine()->getManager();
        $em->persist($topic);
        $em->flush();

        return $this->redirectToRoute("topic_index");
    }

    #[Route('/update/{id}', name: 'topic_update')]
    public function update(Topic $topic): Response
    {
        $topic->setName($topic->getName(). " - modifié");
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return $this->redirectToRoute("topic_index");
    }

    #[Route('/delete/{id}', name: 'topic_delete')]
    public function delete(Topic $topic): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($topic);
        $em->flush();

        return $this->redirectToRoute("topic_index");
    }
}
