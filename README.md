# TP 2 Développement d'une application Web de consultation et modification de morceaux de musique

## Pouget Elie

## Serveur Web local
Pour lancer le serveur Web local vous aurez besoin de vous placez à la racine du
projet et de lancer la commande: $php -d display_errors -S localhost:8000 -t public/


## Style de codage
### Instalation de fixer:
Recherchez « fixer » dans les paquets Composer :
$ composer search fixer
Demandez la dépendance de développement sur « friendsofphp/php-cs-fixer » :
$ composer require friendsofphp/php-cs-fixer --dev
Vérifiez le bon fonctionnement de PHP CS Fixer :
$ php vendor/bin/php-cs-fixer
### Utilisation de fixer:
Vérification manuel
$php vendor/bin/php-cs-fixer fix --dry-run --diff
(--dry-run test à blanc ne modifie rien)
(--diff voir la différance entre l'original et le corrigé)


## Composer
### run-server
Pour lancer le serveur Web local vous pouvez utilisez le script du composer.json:
composer run-server
### test:cs
Permet de vérifier si notre code est bon est voir nos erreurs grâce à:
composer test:cs
### fix:cs
Permet de corriger les erreurs de notre code grâce à:
composer fix:cs
### test:codecept
Permet de vérifier le code grâce à l'ensemble des tests Codeception
### test:crud
Permet de vérifier le code grâce aux tests Crud
### test:browse
Permet d'effectuer les test de la fonctionnalité browse
### test
Equivalent d'utiliser test:cs, test:browse et test:codecept en même temps

## Configuration de la base de données
### .mypdo.ini
Pour accéder à la base de données
dsn = mysql:host=mysql;dbname=cutron01_music;charset=utf8
username = web
password = web
