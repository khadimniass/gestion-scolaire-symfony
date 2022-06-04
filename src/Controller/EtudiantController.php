<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Repository\EtudiantRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(EtudiantRepository $repo, PaginatorInterface $paginator, Request $request): Response
    {
        $etudiants = $repo->findAll();
        $etudiantPaginers = $paginator->paginate
        (
          $etudiants,
          $request->query->getInt('page',1),
            5
        );
        $i=0;
        return $this->render('etudiant/index.html.twig',
            compact('etudiantPaginers','i'));
    }
    #[Route('/etudiant/show/{id<[0-9]+>}', name: 'app_etudiant_show')]
    public function show(Etudiant $etudiant): Response
    {
        return $this->render('etudiant/show.html.twig',compact('etudiant'));
    }
}
