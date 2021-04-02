<?php

namespace App\Controller;

use App\Entity\Trainee;
use App\Repository\TraineeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class TraineeApiController extends AbstractController
{
    #[Route('/trainee/api', name: 'trainee_api_index', methods: ['GET'])]
    public function index(TraineeRepository $traineeRepository): Response
    {
        // normalize
        // serialize
        //$traineesJson = json_encode($trainees);
        return $this->json($traineeRepository->findAll(), 200, [], ['groups' => 'group1']);

    }

    #[Route('/trainee/api', name: 'trainee_api_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): Response
    {
        try {
            $json = $request->getContent();
            $trainee = $serializer->deserialize($json, Trainee::class, 'json');

            $em->persist($trainee);
            $em->flush();

            return $this->json([
                'status' => 201,
                'message' => "Problème d'appel gars"
            ], 201);
        }
        catch (\Exception $e) {
            return $this->json([
                'status' => 400,
                'message' => "Problème d'appel gars"
            ], 400);
        }

    }
}
