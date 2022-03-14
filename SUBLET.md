# SUBLET Tom - LP2

## Quel est le contenu de votre fichier .htaccess ?

```conf
<FilesMatch "\.ht.*$">
 Order deny,allow
 Deny from all
</FilesMatch>

<FilesMatch "\.(sql|ini)$">
 Order deny,allow
 Deny from all
 Allow from 127.0.0.1
</FilesMatch>

<Files config.php>
 AuthType Basic
 AuthName "Restricted Files"
 AuthUserFile ".htpasswd"
 Require user gentil
</Files>
```

## Vol de session

On voit une alerte avec `PHPSESSID=3a4c766df5d6e8b0911b8ab0eefaace4` (sur Chrome, connecté en tant que User)

On voit une alerte avec `PHPSESSID=61281dc6f7809ac82130a8b9da61a88c` (sur Firefox, connecté en tant que Admin)

Après changement du cookie dans Chrome et rechargement, on est connecté sur Admin (avec Chrome).

Au lieu d'une alerte, on fait en sorte que cela nous envoie (discrètement) les cookies, ce qui nous permettrais de nous authentifier avec n'importe quelle session active.

> session_regenerate_id — Remplace l'identifiant de session courant par un nouveau

Après 2 rechargement, le cookie de session à changé

## PDO

Rien ne se passe lors d'un injection SQL.

Requête avec PDO : `SELECT * FROM caffaine WHERE itemname LIKE '%\' UNION SELECT * FROM jghgh#%' OR itemdesc LIKE '%\' UNION SELECT * FROM jghgh#%' OR categ LIKE '%\' UNION SELECT * FROM jghgh#%'`

## XSS

Avec le rajout de `htmlentities`, la balise script apparait

## Mot de passe

> L'option Salt est obsolète. Il est préférable d'utiliser simplement le sel qui est généré par défaut. À partir de PHP 8.0.0, un sel explicitement fournit est ignoré.
> <https://www.php.net/manual/fr/function.password-hash.php>

Je n'ai donc pas passé de salt à la fonction `password_hash`.

Pour supporter les anciens mots de passe, j'ai laissé la verification par md5.
