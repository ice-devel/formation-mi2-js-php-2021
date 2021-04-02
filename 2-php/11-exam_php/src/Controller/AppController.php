<?php

namespace App\Controller;

use App\Entity\Trainee;
use App\Repository\TraineeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(TraineeRepository $traineeRepo): Response
    {
        return $this->render('app/index.html.twig', [
            'trainees' => $traineeRepo->findAll()
        ]);
    }
}
