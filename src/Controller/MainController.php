<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\EditPhotoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * Contrôleur de la page d'accueil
     *
     * @Route("/", name="main_home")
     */
    public function home(): Response
    {

<<<<<<< HEAD
        // Récupération des derniers articles publiés
        $articleRepo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $articleRepo->findBy([], ['publicationDate' => 'DESC'], $this->getParameter('app.article.last_article_number'));

=======
        // Récupération des 3 derniers articles publiés (le nombre d'article dépend du paramètre configuré dans le fichier services.yaml)
        $articleRepo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $articleRepo->findBy([], ['publicationDate' => 'DESC'], $this->getParameter('app.article.last_article_number'));

        // Appel d'une vue en lui envoyant les derniers articles publiés à afficher
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        return $this->render('main/home.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Page de profil
     *
     * @Route("/mon-profil/", name="main_profil")
     * @Security("is_granted('ROLE_USER')")
     */
    public function profil(): Response
    {
<<<<<<< HEAD

=======
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        return $this->render('main/profil.html.twig');
    }

    /**
<<<<<<< HEAD
=======
     * Page de modification de la photo de profil
     *
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
     * @Route("/edit-photo/", name="main_edit_photo")
     * @Security("is_granted('ROLE_USER')")
     */
    public function editPhoto(Request $request): Response
    {

<<<<<<< HEAD
        $form = $this->createForm(EditPhotoType::class);

        $form->handleRequest($request);

        // Si formulaire ok
        if($form->isSubmitted() && $form->isValid()){

            $photo = $form->get('photo')->getData();

            // supprimer l'ancienne photo de profil de l'utilisateur s'il en avait déjà une
=======
        // Création du formulaire de changement de photo
        $form = $this->createForm(EditPhotoType::class);

        // Liaison des données de requête (POST) avec le formulaire
        $form->handleRequest($request);

        // Si le formulaire a été envoyé et s'il ne contient pas d'erreur
        if($form->isSubmitted() && $form->isValid()){

            // Récupération du champ photo dans le formulaire
            $photo = $form->get('photo')->getData();

            // Si l'utilisateur a déjà une photo de profil et si cette photo existe, on la supprime
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
            if(
                $this->getUser()->getPhoto() != null &&
                file_exists( $this->getParameter('app.user.photo.directory') . $this->getUser()->getPhoto())
            ){
<<<<<<< HEAD
                unlink( $this->getParameter('app.user.photo.directory') . $this->getUser()->getPhoto() );
            }

            // On génère un nouveau nom pour la photo, et on continue à en gérer un jusqu'à en avoir un qui ne soit pas déjà pris
            do{

=======

                // Suppression de l'ancienne photo
                unlink( $this->getParameter('app.user.photo.directory') . $this->getUser()->getPhoto() );
            }


            // Création d'un nouveau nom de fichier pour la nouvelle photo (boucle jusqu'à trouver un nom qui ne soit pas déjà utilisé)

            // NOTE : le nom de la photo est généré en calculant le hashage de d'une grande phrase aléatoire.
            // Il y a très très peu de chance que deux photos aient le même nom aléatoire, mais dans la pratique il peut exister plusieurs
            // noms différents ayant le même hashage (colision cryptographique)
            // Même si le taux de "malchance" que cela arrive est extrêment bas, ça ne coute rien de coder proprement pour
            // que ce problème ne puisse pas arriver du tout.
            do{

                // guessExtension() permet de récupérer la vrai extension du fichier, déterminée par rapport à son vrai type MIME
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
                $newFileName = md5( random_bytes(100) ) . '.' . $photo->guessExtension();

            } while(file_exists( $this->getParameter('app.user.photo.directory') . $newFileName ));

            // On change le nom de la photo de l'utilisateur connecté
            $this->getUser()->setPhoto($newFileName);

            // Mise à jour du nom de la photo dans la bdd
            $em = $this->getDoctrine()->getManager();
            $em->flush();

<<<<<<< HEAD
            // Uploader la photo dans le dossier
=======
            // Déplacement physique de l'image dans le dossier paramétré dans le paramètre "app.user.photo.directory" dans le fichier config/services.yaml
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
            $photo->move(
                $this->getParameter('app.user.photo.directory'),
                $newFileName
            );

            // Message flash de succès + redirection sur la page de profil
            $this->addFlash('success', 'Photo de profil modifiée avec succès !');
            return $this->redirectToRoute('main_profil');

        }

<<<<<<< HEAD
=======
        // Appel de la vue en lui envoyant le formulaire à afficher
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        return $this->render('main/editPhoto.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
