<?php

namespace App\Controller;
use App\Form\RegistrationEtudiantType;
use MercurySeries\FlashyBundle\FlashyNotifier;
use App\Entity\{User, RP, AC, Etudiant};
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthentificatorAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register-rp', name: 'app_register_rp')]
    public function registerRp(FlashyNotifier $flashy, Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthentificatorAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        //$user = new User();
        $user = new RP();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $entityManager->persist($user);
            $entityManager->flush();
            $flashy->success('inscription reussi avec succes');
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }
//        dd($user->getRoles());
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'usercalled'=>"RP"
        ]);
    }
}