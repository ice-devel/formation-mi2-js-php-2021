<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Entity\Topic;
use App\Form\TopicType;
use App\Service\SlugService;
use Monolog\Logger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/topic')]
class TopicController extends AbstractController
{
    #[Route('/', name: 'topic_index')]
    public function index(): Response
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Topic::class);
        //$topics = $repo->findBy(['name' => ['toto', 'jean'], [], 10]);
        $topics = $repo->findAll();

        return $this->render('topic/index.html.twig', [
            'topics' => $topics
        ]);
    }

    #[Route('/new', name: 'topic_new')]
    public function create(Request $request, SluggerInterface $slugger): Response
    {
        $topic = new Topic();

        /*
         * si on voulait mettre un form de tag imbriqué par défaut
        $tag = new Tag();
        $tag->setText("PHP");
        $topic->addTag($tag);
        //$tag->addTopic($topic); // ça c'est déjà fait dans la classe Topic
         */

        $form = $this->createForm(TopicType::class, $topic);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                // créer le slug du topic
                $slug = $slugger->slug($topic->getName());
                $topic->setSlug($slug);

                $em = $this->getDoctrine()->getManager();
                $em->persist($topic);
                $em->flush();
                $this->addFlash('success', "Topic bien créé en passant par le form");
                return $this->redirectToRoute('topic_index');
            }
            else {
                $this->addFlash('danger', "Formulaire pas valide");
            }
        }

        return $this->render('topic/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/update/{id}', name: 'topic_update')]
    public function update(Topic $topic): Response
    {
        $topic->setName($topic->getName(). " - modifié");
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash('success', "Topic bien mise à jour");

        return $this->redirectToRoute("topic_index");
    }

    #[Route('/delete/{id}', name: 'topic_delete')]
    public function delete(Topic $topic): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($topic);
        $em->flush();

        $this->addFlash('success', "Topic bien supprimé");

        return $this->redirectToRoute("topic_index");
    }
}
