<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnneScolaireController extends AbstractController
{
    #[Route('/anne/scolaire', name: 'app_anne_scolaire')]
    public function index(): Response
    {
        return $this->render('anne_scolaire/index.html.twig', [
            'controller_name' => 'AnneScolaireController',
        ]);
    }
}
