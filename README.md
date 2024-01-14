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

Pour ce faire, nous aurons besoin de l'**adresse de l'hôte** de la base de données, du **port** sur lequel elle se trouve, du **nom d'utilisateur** pour se connecter à la base de données ainsi que de son **mot de passe**.

Voici donc le code du fichier JSON. Veillez à changer les informations par vos propres données :

```json
{
"host": "adresse_de_votre_bdd",
"port": "port_de_votre_bdd",
"username": "utilisateur_de_votre_bdd",
"password": "mot_de_passe_de_votre_bdd"
}
```

Voilà, maintenant votre fichier JSON est prêt à l'emploi. N'hésitez pas à le placer dans un fichier gitignore si vous publiez vos travaux sur GitHub afin que personne n'ait accès à vos données sensibles.

## 3 | Le fichier dbConnect.php

Passons mainteant au fichier dbConnect, le fichier le plus conséquent de ce tuto.

### a. class et variables

Pour commencer, nous allons ouvrir une balise php et créer notre class 'DBManager' et initialiser nos varaibles privées 'db_name' et 'pdo'

```php
<?php
class DBManager {
    private $db_name;
    private $pdo;
}
?>
```

Comme vous avez pu donc le comprendre ici nous allons préférer PDO à mysqli car il s'adapte à tout type de base de données et est bien plus complet et complexe que mysqli.

### b. fonction __construct

Ensuite nous allons créer une fonction privée '__construct'. Cette fonction se trouve à l'interieur de la class 'DBManager' :

```php
public function __construct(string $DBName) {
        $this->db_name = $DBName;
        $dbConfig = $this->loadConfig();
        $this->connect($dbConfig);
    }
```

Celle ci va permettre de récuprer le nom de notre base de données qui sera située dans 'index.php' que nous verrons dans un second temps et d'appeler les fonctions 'loadConfig' et 'connect' que nous allons voir ci-dessous.

### c. fonction loadConfig

Ici, nous allons créer la fonction 'loadConfig'. Celle-ci va permettre de charger le fichier 'config.json' que nous avons créé précédemment et qui contient toutes les informations nécessaires pour se connecter à notre base de données.

```php
private function loadConfig() {
    $configFile = __DIR__ . '/../json/config.json';
    if (file_exists($configFile)) {
        $config = json_decode(file_get_contents($configFile), true);
        if ($config) {
            return $config;
        }
    }
    die("Erreur : Fichier de configuration de la base de données manquant ou incorrect.");
}
```

'$configFile' contient donc le chemin d'accès vers le fichier 'config.json', et ensuite, une instruction 'if' vérifie si le fichier est trouvé. Si c'est le cas, nous utilisons la fonction 'json_decode' pour lire le fichier JSON avec PHP. Si le fichier n'est pas trouvé, un message d'erreur indique que le fichier n'a pas été trouvé.

### d.


