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
