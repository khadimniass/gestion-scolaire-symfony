<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use App\Security\LoginFormAuthentificatorAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

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
    #[Route('/etudiant/add', name: 'app_register_etudiant')]
    public function registerEtudiant(FlashyNotifier $flashy, Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthentificatorAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $userEtudiant = new Etudiant();
        $form = $this->createForm(EtudiantType::class, $userEtudiant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $userEtudiant->setPassword(
                $userPasswordHasher->hashPassword(
                    $userEtudiant,
                    $form->get('password')->getData()
                )
            );
             //    dd($userEtudiant);
            $entityManager->persist($userEtudiant);
            $entityManager->flush();
            $flashy->success('un nouveau AP a ete ajoute avec succes');
        }
        // dd($user);
        return $this->render('etudiant/create.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    #[Route('/etudiant/show/{id<[0-9]+>}', name: 'app_etudiant_show')]
    public function show(Etudiant $etudiant): Response
    {
        return $this->render('etudiant/show.html.twig',compact('etudiant'));
    }
}
