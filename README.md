# Créer une connexion à une base de données sécurisée avec PHP

## 0 | Préambule

Dans ce tutoriel, nous allons voir comment créer une arborescence de fichiers simple pour établir une connexion à une base de données en PHP en utilisant les informations de connexion stockées dans un fichier JSON. Nous aurons une fonction indépendante dans un fichier dbConnect.php que vous pourrez réutiliser tel quel dans n'importe lequel de vos projets en changeant simplement les données de connexion et le nom de la table.

## 1 | Création des fichiers et mise en place

Dans un premier temps, nous allons créer notre arborescence de fichiers :

- Nous allons créer un fichier 'index.php' à la base de notre dossier.
- Ensuite, nous allons créer un dossier 'methodes' contenant un fichier 'dbConnect.php'.
- Enfin, nous allons créer un dossier 'json' contenant un fichier 'config.json'.

## 2 | Le fichier JSON

Commençons par le fichier 'config.json'. Dans celui-ci, nous allons entrer toutes les données nécessaires à la connexion à la base de données.

Pour ce faire, nous aurons besoin de l'**adresse de l'hôte** de la base de données, du **port** sur lequel elle se trouve, du **nom d'utilisateur** pour se connecter à la base de données, ainsi que de son **mot de passe** et enfin du **nom de la base de données**.

Voici donc le code du fichier JSON. Veillez à changer les informations par vos propres données :

```json
{
"host": "adresse_de_votre_bdd",
"port": "port_de_votre_bdd",
"username": "utilisateur_de_votre_bdd",
"password": "mot_de_passe_de_votre_bdd",
"database": "nom_de_votre_bdd"
}
```

Voilà, maintenant votre fichier JSON est prêt à l'emploi. N'hésitez pas à le placer dans un fichier gitignore si vous publiez vos travaux sur GitHub afin que personne n'ait accès à vos données sensibles.


