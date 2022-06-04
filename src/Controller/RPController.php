<?php

namespace App\Controller;

use App\Entity\RP;
use App\Repository\RPRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RPController extends AbstractController
{
    #[Route('/rp', name: 'app_rp')]
    public function index(RPRepository $repo): Response
    {
        $rp = $repo->findAll();
        return $this->render('rp/index.html.twig', compact('rp'));
    }
}
