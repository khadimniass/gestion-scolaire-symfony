<?php

namespace App\Controller;

use App\Repository\{ACRepository,InscriptionRepository,AnneeScolaireRepository};
use App\Entity\Inscription;
use App\Form\InscriptionType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Response,Request};
use Symfony\Component\Routing\Annotation\Route;

class InscriptionController extends AbstractController
{
   private ManagerRegistry $registry;
   public function __construct(ManagerRegistry $registry)
   {
       $this->registry=$registry;
   }

    #[Route('/inscription', name: 'app_inscription')]
    public function index(): Response
    {
        return $this->render('inscription/index.html.twig', [
            'controller_name' => 'InscriptionController',
        ]);
    }
    #[Route('/inscription/add', name: 'app_inscription_add')]
    public function add_inscription(Request $request){
        $repoAn = new ACRepository($this->registry);
        $repoAc = new AnneeScolaireRepository($this->registry);
       $inscription = new Inscription();
       $form = $this->createForm(InscriptionType::class,$inscription);
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()){
       }
        return $this->render('inscription/create.html.twig',compact('form'));
    }
}
