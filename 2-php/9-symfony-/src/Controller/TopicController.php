<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Message;
use App\Entity\Topic;
use App\Event\TopicEvent;
use App\Form\CommentType;
use App\Form\MessageTopicType;
use App\Form\TopicType;
use App\Service\RandomQuote;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/topic')]
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
    public function create(Request $request, EventDispatcherInterface $dispatcher): Response
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
                /*
                 * On le fait plutôt dans un listener (EntityListener)
                 */
                // $slug = $slugger->slug($topic->getName());
                // $topic->setSlug($slug);
                $em = $this->getDoctrine()->getManager();
                $em->persist($topic);
                $em->flush();

                $dispatcher->dispatch(new TopicEvent($topic), TopicEvent::NAME);
                exit;

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

    #[Route('/{slug}', name: 'topic_show')]
    public function show(Topic $topic): Response
    {
        $form = $this->createForm(MessageTopicType::class, null, [
            'action' => $this->generateUrl(
                'topic_message_new',
                ['id' => $topic->getId()]
            )
        ]);

        return $this->render('topic/show.html.twig', [
            'topic' => $topic,
            'formMessage' => $form->createView()
        ]);
    }

    #[Route('/message/new/{id}', name: 'topic_message_new')]
    public function messageNew(Request $request, Topic $topic): Response
    {
        $message = new Message();
        $message->setTopic($topic);
        $form = $this->createForm(MessageTopicType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($message);
                $em->flush();
                $this->addFlash('success', "Message bien créé");
            }
            else {
                $this->addFlash('danger', "Formulaire pas valide");
            }
        }

       return $this->redirectToRoute('topic_show', ['slug' => $topic->getSlug()]);
    }

    #[Route('/comment/new/{id}', name: 'topic_comment_new')]
    public function commentNew(Request $request, Message $message): Response
    {
        $comment = new Comment();
        $comment->setMessage($message);
        $form = $this->createForm(CommentType::class, $comment, [
            'action' => $this->generateUrl('topic_comment_new', ['id' => $message->getId()])
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($comment);
                $em->flush();
                $this->addFlash('success', "Commentaire bien créé");
            }
            else {
                $this->addFlash('danger', "Formulaire pas valide");
            }
            return $this->redirectToRoute('topic_show', ['slug' => $message->getTopic()->getSlug()]);
        }

        return $this->render('topic/comment_form.html.twig', [
            'formComment' => $form->createView()
        ]);
    }


    #[Route('/update/{id}', name: 'topic_update')]
    /**
     *@IsGranted("ROLE_SUPER_ADMIN")
     */
    public function update(Topic $topic): Response
    {
        // équivalent de l'annotation
        if (!$this->isGranted("ROLE_SUPER_ADMIN")) {
            throw new AccessDeniedHttpException();
        }

        // est-ce le topic c'est celui de l'utilisateur connecté ?
        /*
        $user = $this->getUser();
        if ($user->getId() != $topic->getUser()->getId()) {
            throw new AccessDeniedHttpException();
        }
        */
        // on passe plutôt par les voters : ici tous les voters qui supporte Topic seront testés
        $this->denyAccessUnlessGranted("TOPIC_EDIT", $topic);

        $topic->setName($topic->getName(). " - modifié");
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        $this->addFlash('success', "Topic bien mise à jour");

        //return $this->redirectToRoute("topic_index");
        return new Response("Topic bien modifié");
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

    /*
     * Controller sans route, car pas appelable depuis une url :
     * Il est uniquement inclus depuis un template avec la fonction render()
     */
    public function randomQuote(RandomQuote $randomQuote): Response
    {
        $quote = $randomQuote->getDailyQuote();
        return new Response($quote);
    }
}
