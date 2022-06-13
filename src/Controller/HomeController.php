<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        if ($this->getUser()) {
            $role = $this->getUser()->getRoles()[0];
        }

        if (!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }
        return $this->render('home/index.html.twig', compact('role'));
    }
}
