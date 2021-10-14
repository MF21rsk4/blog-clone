<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Recaptcha\RecaptchaValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * Page d'inscription
     *
     * @Route("/creer-un-compte/", name="app_register")
     */
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, RecaptchaValidator $recaptcha): Response
    {

        // Si l'utilisateur est déjà connecté on le redirige sur l'accueil
        if($this->getUser()){
            return $this->redirectToRoute('main_home');
        }

<<<<<<< HEAD
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            // $_POST['g-recaptcha-response']
            $captchaResponse = $request->request->get('g-recaptcha-response', null);

            // $_SERVER['REMOTE_ADDR']
            $ip = $request->server->get('REMOTE_ADDR');

            // Vérification de la validité du captcha (sinon erreur)
            if($captchaResponse == null || !$recaptcha->verify( $captchaResponse, $ip )){
=======
        // Création d'un nouvel utilisateur
        $user = new User();

        // Création d'un nouveau formulaire de création de compte
        $form = $this->createForm(RegistrationFormType::class, $user);

        // Remplissage du formulaire avec les données POST (dans $request)
        $form->handleRequest($request);

        // Si le formulaire a été envoyé
        if ($form->isSubmitted()) {

            // Récupération de la valeur du captcha ( $_POST['g-recaptcha-response'] )
            $captchaResponse = $request->request->get('g-recaptcha-response', null);

            // Récupération de l'adresse IP de l'utilisateur ( $_SERVER['REMOTE_ADDR'] )
            $ip = $request->server->get('REMOTE_ADDR');

            // Si le captcha est null ou si il est invalide, ajout d'une erreur générale sur le formulaire (qui sera considéré comme échoué après)
            if($captchaResponse == null || !$recaptcha->verify( $captchaResponse, $ip )){

                // Ajout d'une nouvelle erreur dans le formulaire
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
                $form->addError( new FormError('Veuillez remplir le captcha de sécurité') );
            }

            // Si le formulaire n'a pas d'erreur
            if($form->isValid()){

<<<<<<< HEAD
                // encode the plain password
                $user
=======
                // Hydratation du nouveau compte
                $user
                    // Hashage du mot de passe
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
                    ->setPassword(
                        $userPasswordHasherInterface->hashPassword(
                            $user,
                            $form->get('plainPassword')->getData()
                        )
                    )

<<<<<<< HEAD
                    // Hydratation de la date d'incription de l'utilisateur
                    ->setRegistrationDate( new \DateTime() )
                ;

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                // do anything else you need here, like send an email

                // On crée un message flash de succès
                $this->addFlash('success', 'Votre compte a été créé avec succès !');

=======
                    // Date d'incription de l'utilisateur
                    ->setRegistrationDate( new \DateTime() )
                ;

                // Sauvegarde du nouveau compte grâce au manager général des entités
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                // Message flash de succès
                $this->addFlash('success', 'Votre compte a été créé avec succès !');

                // Redirection de l'utilisateur vers la page de connexion
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
                return $this->redirectToRoute('app_login');

            }

        }

<<<<<<< HEAD
=======
        // Appel de la vue en envoyant le formulaire à afficher
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
