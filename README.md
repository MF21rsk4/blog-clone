# Projet Le Blog de Batman

## Installation

### Cloner le projet

```
git clone https://github.com/Anthony-Dmn/leblogdebatman.git
```

<<<<<<< HEAD
### Modifier les paramètres d'environnement dans le fichier .env (changer user_db, password_db, clés Google Recaptcha)
=======
### Modifier les paramètres d'environnement dans le fichier .env pour les faire correspondre à votre environnement (Accès base de données, clés Google Recaptcha, etc...)
```
# Accès base de données
DATABASE_URL="mysql://root:@127.0.0.1:3306/leblogdebatman?serverVersion=5.7"

# Clés Google Recaptcha
GOOGLE_RECAPTCHA_SITE_KEY=XXXXXXXXXXXXXXXXXXXXXXXXXXXX
GOOGLE_RECAPTCHA_PRIVATE_KEY=XXXXXXXXXXXXXXXXXXXXXXXXXXXX
```
>>>>>>> faf3f9f0d923a0fe1b93a376d8d4d2fe9d11767b

### Déplacer le terminal dans le dossier cloné
```
cd leblogdebatman
```

### Taper les commandes suivantes :

```
composer install
symfony console doctrine:database:create
symfony console make:migration
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load
symfony console assets:install public
```

Les fixtures créeront :
* Un compte admin (email: admin@a.a , password : aaaaaaaaA7/ )
* 10 comptes utilisateurs (email aléatoire, password : aaaaaaaaA7/ )
* 200 articles
* entre 0 et 10 commentaires par article