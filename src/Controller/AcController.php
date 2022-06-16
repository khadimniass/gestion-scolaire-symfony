<?php

namespace App\Controller;

use App\Entity\AC;
use App\Form\AcType;
use App\Security\LoginFormAuthentificatorAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class AcController extends AbstractController
{
    #[Route('/ac', name: 'app_ac')]
    public function index(): Response
    {
        return $this->render('ac/index.html.twig', [
            'controller_name' => 'AcController',
        ]);
    }
    #[Route('/register-ac', name: 'app_register_ac')]
    public function create(FlashyNotifier $flashy, Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthentificatorAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {

        $userAc = new AC();
        $form = $this->createForm(AcType::class, $userAc);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $userAc->setPassword(
                $userPasswordHasher->hashPassword(
                    $userAc,
                    $form->get('password')->getData()
                )
            );
       //     dd($userAc);
            $entityManager->persist($userAc);
            $entityManager->flush();
            $flashy->success('un nouveau AP a ete ajoute avec succes');
            return $userAuthenticator->authenticateUser(
                $userAc,
                $authenticator,
                $request
            );
        }
        return $this->render('registration/register.html.twig',[
            'registrationForm' => $form->createView(),
            'usercalled'=>"AC"
        ]);
    }
}
