<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Form\NewArticleFormType;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Préfixes de la route et du nom des pages du blog
 *
 * @Route("/blog", name="blog_")
 */
class BlogController extends AbstractController
{
    /**
     * Page admin permettant de créer une nouvelle publication
     *
     * @Route("/nouvelle-publication/", name="new_publication")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function newPublication(Request $request): Response
    {

<<<<<<< HEAD
        $newArticle = new Article();

        $form = $this->createForm(NewArticleFormType::class, $newArticle);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $newArticle
                ->setAuthor($this->getUser())
                ->setPublicationDate( new DateTime() )
            ;

            $em = $this->getDoctrine()->getManager();

            $em->persist($newArticle);

            $em->flush();

            $this->addFlash('success', 'Article publié avec succès !');


=======
        // Création d'un nouvel article vide
        $newArticle = new Article();

        // Création d'un formulaire de création d'article, lié à l'article vide
        $form = $this->createForm(NewArticleFormType::class, $newArticle);

        // Liaison des données de requête (POST) avec le formulaire
        $form->handleRequest($request);


        // Si le formulaire est envoyé et n'a pas d'erreur
        if($form->isSubmitted() && $form->isValid()){

            // Hydratation de l'article pour la date et l'auteur
            $newArticle
                ->setAuthor($this->getUser())           // L'auteur est l'utilisateur connecté
                ->setPublicationDate( new DateTime() )  // Date actuelle
            ;

            // Sauvegarde de l'article dans la abse de données via le manager général des entités
            $em = $this->getDoctrine()->getManager();
            $em->persist($newArticle);
            $em->flush();

            // Message flash de type "success"
            $this->addFlash('success', 'Article publié avec succès !');

            // Redirection de l'utilisateur vers la page détaillée de l'article tout nouvellement créé
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
            return $this->redirectToRoute('blog_publication_view', [
                'slug' => $newArticle->getSlug(),
            ]);

        }

<<<<<<< HEAD
=======
        // Appel de la vue en lui envoyant le formulaire à afficher
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        return $this->render('blog/newPublication.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Page qui liste tous les articles
     *
     * @Route("/publications/liste/", name="publication_list")
     */
    public function publicationList(Request $request, PaginatorInterface $paginator): Response
    {

        // Récupération du numéro de la page demandée dans l'URL
        $requestedPage = $request->query->getInt('page', 1);

        // Vérification que le numéro est positif
        if($requestedPage < 1){
            throw new NotFoundHttpException();
        }

<<<<<<< HEAD
        $em = $this->getDoctrine()->getManager();

=======
        // Récupération du manager général des entités
        $em = $this->getDoctrine()->getManager();

        // Création d'une requête permettant de récupérer les articles (uniquement ceux de la page demandée, grâce au paginator,et non tous les articles)
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        $query = $em->createQuery('SELECT a FROM App\Entity\Article a ORDER BY a.publicationDate DESC');

        // Récupération des articles
        $articles = $paginator->paginate(
<<<<<<< HEAD
            $query,
            $requestedPage,
            10
        );


        return $this->render('blog/publicationList.html.twig', [
            'articles' => $articles,
        ]);
=======
            $query,             // Requête créée précedemment
            $requestedPage,     // Numéro de la page demandée
            10              // Nombre d'articles affichés par page
        );

        // Appel de la vue en envoyant les articles à afficher
        return $this->render('blog/publicationList.html.twig', [
            'articles' => $articles,
        ]);

>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
    }

    /**
     * Page permettant de voir un article en détail
     *
     * @Route("/publication/{slug}/", name="publication_view")
     */
    public function publicationView(Article $article, Request $request): Response
    {

<<<<<<< HEAD
        // Si l'utilisateur n'est pas connecté, on appelle la vue directement
=======
        // Si l'utilisateur n'est pas connecté, appel direct de la vue en lui envoyant l'article à afficher
        // On fait ça pour éviter que le traitement du formulaire en dessous ne soit invoqué par un autre moyen même si le formulaire html est masqué
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        if(!$this->getUser()){

            return $this->render('blog/publicationView.html.twig', [
                'article' => $article,
            ]);

        }

<<<<<<< HEAD
        $comment = new Comment();

        $form = $this->createForm(CommentFormType::class, $comment);

        $form->handleRequest($request);

        // verifs formulaires
        if($form->isSubmitted() && $form->isValid()){

            $comment
                ->setPublicationDate( new DateTime() )
                ->setArticle( $article )
                ->setAuthor( $this->getUser() )
            ;

            // Sauvegarde en BDD
=======
        // Création d'un commentaire vide
        $comment = new Comment();

        // Création d'un formulaire de création de commentaire, lié au commentaire vide
        $form = $this->createForm(CommentFormType::class, $comment);

        // Liaison des données de requête (POST) avec le formulaire
        $form->handleRequest($request);

        // Si le formulaire est envoyé et n'a pas d'erreur
        if($form->isSubmitted() && $form->isValid()){

            // Hydratation du commentaire
            $comment
                ->setAuthor($this->getUser())           // L'auteur est l'utilisateur connecté
                ->setPublicationDate(new DateTime())    // Date actuelle
                ->setArticle($article)                  // Lié à l'article actuellement affiché sur la page
            ;

            // Sauvegarde du commentaire en base de données via le manager général des entités
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

<<<<<<< HEAD
            $this->addFlash('success', 'Votre commentaire a été publié avec succès !');

            // Remise à zéro du formulaire et du commentaire si jamais il y en a un autre
            unset($comment);
            unset($form);
=======
            // Message flash de succès
            $this->addFlash('success', 'Votre commentaire a été publié avec succès !');

            // Suppression des deux variables contenant le formulaire validé et le commentaire nouvellement créé (pour éviter que le nouveau formulaire soit rempli avec)
            unset($comment);
            unset($form);

            // Création d'un nouveau commentaire vide et de son formulaire lié
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
            $comment = new Comment();
            $form = $this->createForm(CommentFormType::class, $comment);

        }

<<<<<<< HEAD
=======
        // Appel de la vue en lui envoyant l'article et le formulaire à afficher
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        return $this->render('blog/publicationView.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);

    }

    /**
<<<<<<< HEAD
=======
     * Page affichant les résultats de recherches faites par le formulaire de recherche dans la navbar
     *
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
     * @Route("/recherche/", name="search")
     */
    public function search(Request $request, PaginatorInterface $paginator): Response
    {

<<<<<<< HEAD
        // Récupération du numéro de la page demandée dans l'URL
        $requestedPage = $request->query->getInt('page', 1);

        // Vérification que le numéro est positif
=======
        // Récupération du numéro de la page demandée dans l'url (si il existe pas, 1 sera pris à la place)
        $requestedPage = $request->query->getInt('page', 1);

        // Si la page demandée est inférieur à 1, erreur 404
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        if($requestedPage < 1){
            throw new NotFoundHttpException();
        }

<<<<<<< HEAD
        $search = $request->query->get('q', '');

        $em = $this->getDoctrine()->getManager();

=======
        // On récupère la recherche de l'utilisateur depuis l'url ($_GET['q'])
        $search = $request->query->get('q', '');

        // Récupération du manager général des entités
        $em = $this->getDoctrine()->getManager();

        // Création d'une requête permettant de récupérer les articles pour la page actuelle, dont le titre ou le contenu contient la recherche de l'utilisateur
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        $query = $em
            ->createQuery('SELECT a FROM App\Entity\Article a WHERE a.title LIKE :search OR a.content LIKE :search ORDER BY a.publicationDate DESC')
            ->setParameters([
                'search' => '%' . $search . '%',
            ])
        ;

        // Récupération des articles
        $articles = $paginator->paginate(
            $query,
            $requestedPage,
            10
        );

<<<<<<< HEAD

=======
        // Appel de la vue en lui envoyant les articles à afficher
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        return $this->render('blog/listSearch.html.twig', [
            'articles' => $articles,
        ]);

    }

    /**
     * Page admin servant à supprimer un article via son id passé dans l'URL
     *
     * @Route("/publication/suppression/{id}/", name="publication_delete")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function publicationDelete(Article $article, Request $request): Response
    {

<<<<<<< HEAD
        if(!$this->isCsrfTokenValid('blog_publication_delete_' . $article->getId(), $request->query->get('csrf_token'))){

            $this->addFlash('error', 'Token sécurité invalide, veuillez ré-essayer.');
        } else {

            // Manager général
            $em = $this->getDoctrine()->getManager();

            // Suppression de l'article
            $em->remove($article);
            $em->flush();

            // Message flash de succès + redirection sur la liste des articles
            $this->addFlash('success', 'La publication a été supprimée avec succès !');
        }


=======
        // Si le token CSRF passé dans l'url n'est pas le token valide, message d'erreur
        if(!$this->isCsrfTokenValid('blog_publication_delete_' . $article->getId(), $request->query->get('csrf_token'))){

            // Message flash d'erreur
            $this->addFlash('error', 'Token sécurité invalide, veuillez ré-essayer.');
        } else {

            // Suppression de l'article via le manager général des entités
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();

            // Message flash de succès
            $this->addFlash('success', 'La publication a été supprimée avec succès !');
        }

        // Redirection de l'utilisateur sur la liste des articles
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        return $this->redirectToRoute('blog_publication_list');

    }


    /**
<<<<<<< HEAD
     * Page permettant aux admins de modifier un article
=======
     * Page admin permettant de modifier un article existant via son id passé dans l'url
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
     *
     * @Route("/publication/modifier/{id}/", name="publication_edit")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function publicationEdit(Article $article, Request $request): Response
    {

<<<<<<< HEAD
        $form = $this->createForm(NewArticleFormType::class, $article);

        $form->handleRequest($request);

        // Si formulaire ok
        if($form->isSubmitted() && $form->isValid()){

            // Mise à jour dans la BDD
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('success', 'Publication modifiée avec succès !');

=======
        // Création du formulaire de modification d'article (c'est le même que le formulaire permettant de créer un nouvel article, sauf qu'il sera déjà rempli avec les données de l'article existant "$article")
        $form = $this->createForm(NewArticleFormType::class, $article);

        // Liaison des données de requête (POST) avec le formulaire
        $form->handleRequest($request);

        // Si le formulaire est envoyé et n'a pas d'erreur
        if($form->isSubmitted() && $form->isValid()){

            // Sauvegarde des changements faits dans l'article via le manager général des entités
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            // Message flash de succès
            $this->addFlash('success', 'Publication modifiée avec succès !');

            // Redirection vers la page de l'article modifié
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
            return $this->redirectToRoute('blog_publication_view', [
                'slug' => $article->getSlug(),
            ]);

        }

<<<<<<< HEAD
=======
        // Appel de la vue en lui envoyant le formulaire à afficher
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        return $this->render('blog/publicationEdit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Page permettant aux admins de supprimer un commentaire
     *
     * @Route("/commentaire/suppression/{id}/", name="comment_delete")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function commentDelete(Comment $comment, Request $request): Response
    {

        // Si le token CSRF passé dans l'URL n'est pas valide
        if(!$this->isCsrfTokenValid('blog_comment_delete' . $comment->getId(), $request->query->get('csrf_token'))){
            $this->addFlash('error', 'Token sécurité invalide, veuillez ré-essayer.');
        } else {

<<<<<<< HEAD
            // Suppression du commentaire en BDD
=======
            // Suppression du commentaire via le manager général des entités
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
            $em = $this->getDoctrine()->getManager();
            $em->remove( $comment );
            $em->flush();

<<<<<<< HEAD
=======
            // Message flash de succès
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
            $this->addFlash('success', 'Le commentaire a été supprimé avec succès !');

        }

<<<<<<< HEAD
        // Redirection sur la page de l'article auquel était rattaché le commentaire
=======
        // Redirection de l'utilisateur sur la page détaillée de l'article auquel est/était rattaché le commentaire
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        return $this->redirectToRoute('blog_publication_view', [
            'slug' => $comment->getArticle()->getSlug(),
        ]);

    }

}
