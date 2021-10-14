<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * Page de connexion
     *
     * @Route("/connexion/", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
<<<<<<< HEAD
        // Si l'utilisateur est déjà connecté, on le redirige sur l'accueil
=======
        // Si l'utilisateur est déjà connecté, on le redirige de force sur la page d'accueil du site
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        if ($this->getUser()) {
            return $this->redirectToRoute('main_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * Page de déconnexion
     *
     * @Route("/deconnexion/", name="app_logout")
     */
    public function logout(): void
    {

<<<<<<< HEAD
        // Le code ici ne sera jamais lu (intercepté par le bundle security)
=======
        // Le code ici ne sera jamais lu car la page de déconnexion est déjà gérée en interne par le bundle security.
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b

        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
