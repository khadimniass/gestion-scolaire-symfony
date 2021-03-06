<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'app_professeur')]
    public function index(ProfesseurRepository $professeur, PaginatorInterface $paginator, Request $request): Response
    {
        $professeurs=$paginator->paginate(
          $professeur->findAll(),
            $request->query->getInt('page',1),
            5
        );
        return $this->render('professeur/index.html.twig', compact('professeurs'));
    }

    #[Route('/professeur/add', name: 'app_professeur_add')]
    public function crete(Request $request, EntityManagerInterface $manager): Response
    {
        $professeur= new Professeur();
        $form=$this->createForm(ProfesseurType::class,$professeur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $professeur->setRp($this->getUser());
            $manager->persist($professeur);
            $manager->flush();
            return $this->redirectToRoute('app_professeur');
        }
        return $this->render('professeur/create.html.twig',['form'=>$form->createView()]);
    }
}
