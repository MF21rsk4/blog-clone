<?php

namespace App\DataFixtures;

use App\Entity\Article;
<<<<<<< HEAD
=======
use App\Entity\Comment;
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private $encoder;

<<<<<<< HEAD
=======

    /**
     * Utilisation du constructeur pour récupérer le service de hashage des mots de passe via autowiring
     */
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

<<<<<<< HEAD
    public function load(ObjectManager $manager)
    {

        // Instanciation du Faker (en français !)
=======

    /**
     * Méthode chargée automatiquement au chargement des fixtures
     */
    public function load(ObjectManager $manager)
    {

        // Instanciation du Faker (en français)
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        $faker = Faker\Factory::create('fr_FR');

        // Création d'un compte admin
        $admin = new User();

<<<<<<< HEAD
        // Hydratation du compte
=======
        // Hydratation du compte admin
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        $admin
            ->setEmail('admin@a.a')
            ->setRegistrationDate( $faker->dateTimeBetween('-1 year', 'now') )
            ->setPseudonym('Batman')
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword(
                $this->encoder->hashPassword($admin, 'aaaaaaaaA7/')
            )
        ;

<<<<<<< HEAD
        // Persistance de l'admin
        $manager->persist($admin);


        // Création de 10 comptes utilisateur
        for($i = 0; $i < 10; $i++){

            $user = new User();

=======
        // Persistance du compte admin
        $manager->persist($admin);


        // Création de 10 comptes utilisateur (avec une boucle)
        for($i = 0; $i < 10; $i++){

            // Création d'un nouveau compte
            $user = new User();

            // Hydratation du compte avec des données aléatoire
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
            $user
                ->setEmail( $faker->email )
                ->setRegistrationDate( $faker->dateTimeBetween('-1 year', 'now') )
                ->setPseudonym( $faker->userName )
                // Même mot de passe pour tous les comptes
                ->setPassword( $this->encoder->hashPassword($user, 'aaaaaaaaA7/') )
            ;

<<<<<<< HEAD
            $manager->persist($user);

        }

        // Création de 200 articles
        for($i = 0; $i < 200; $i++){

            $article = new Article();

=======
            // Persistance du compte
            $manager->persist($user);


            // Stockage du compte de côté pour créer des commentaires plus bas
            $users[] = $user;

        }

        // Création de 200 articles (avec une boucle)
        for($i = 0; $i < 200; $i++){

            // Création d'un nouvel article
            $article = new Article();

            // Hydratation de l'article avec des données aléatoires
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
            $article
                ->setTitle( $faker->sentence(10) )
                ->setContent( $faker->paragraph(15) )
                ->setPublicationDate( $faker->dateTimeBetween('-1 year', 'now') )
                ->setAuthor( $admin )   // Batman sera l'auteur de tous les articles
            ;

<<<<<<< HEAD
            $manager->persist( $article );

        }


        // Sauvegarde des nouvelles entités dans la base de données
=======
            // Persistance de l'article
            $manager->persist( $article );


            // Création entre 0 et 10 commentaires aléatoires par article (avec une boucle)
            $rand = rand(0, 10);

            for($j = 0; $j < $rand; $j++){

                // Création nouveau commentaire
                $newComment = new Comment();

                // Hydratation du commentaire avec des données aléatoires
                $newComment
                    ->setArticle($article)
                    // Date aléatoire entre maintenant et il y a un an
                    ->setPublicationDate($faker->dateTimeBetween( '-1 year' , 'now'))
                    // Auteur aléatoire parmis les comptes créés plus haut
                    ->setAuthor($faker->randomElement($users))
                    ->setContent($faker->paragraph(5))
                ;


                // Persistance du commentaire
                $manager->persist($newComment);

            }


        }


        // Sauvegarde des nouvelles entités dans la base de données via le manager général des entitées
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b
        $manager->flush();

    }
}
