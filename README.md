# Créer une connexion à une base de données sécurisée avec PHP

## 0 | Préambule

Dans ce tutoriel, nous allons voir comment créer une arborescence de fichiers simple pour établir une connexion à une base de données en PHP en utilisant les informations de connexion stockées dans un fichier JSON. Nous aurons une fonction indépendante dans un fichier dbConnect.php que vous pourrez réutiliser tel quel dans n'importe lequel de vos projets en changeant simplement les données de connexion et le nom de la table.

## 1 | Création des fichiers et mise en place

Dans un premier temps, nous allons créer notre arborescence de fichiers :

- Nous allons créer un fichier 'index.php' à la base de notre dossier.
- Ensuite, nous allons créer un dossier 'methodes' contenant un fichier 'dbConnect.php'.
- Enfin, nous allons créer un dossier 'json' contenant un fichier 'config.json'.

## 2 | Le fichier JSON

Commencons par le fichier 'config.json', dans celui-ci nous allons entrer toutes les données nécessaires à la connexion à la base de données.

Pour ce faire nous allons avoir besoin de **l'adresse de l'hôte de la base de données**, du **port** sur lequelle elle se trouve, du **nom d'utilisateur** pour se connecter à la base de données ainsi que de son **mot de passe** et enfin le **nom de la base de données**

Voici donc le code du fichier JSON, veillez à changer donc les informations par vos propres informations :

`{

    "host": "localhost",

    "port" : "8888",

    "username": "root",

    "password": "1597",

    "database": "nwsnight"
    
}`

