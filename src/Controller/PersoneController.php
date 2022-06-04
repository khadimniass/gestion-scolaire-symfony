<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Repository\PersonneRepository;
use Knp\Component\Pager\PaginatorInterface;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersoneController extends AbstractController
{
    #[Route('/persone', name: 'app_personne')]
    public function index(PersonneRepository $repository, PaginatorInterface $paginator, Request $request): Response
    {
        $personnes = $repository->findAll();
        $personnePagiers = $paginator->paginate(
            $personnes,
            $request->query->getInt('page',1),
            5
        );
        $i=0;
        return $this->render('personee/index.html.twig',compact('personnePagiers','i'));
    }

    #[Route('/persone/show/{id<[0-9]+>}', name: 'app_personne_show')]
    public function show(Personne $personne): Response
    {
        return $this->render('personee/show.html.twig',compact('personne'));
    }
}
