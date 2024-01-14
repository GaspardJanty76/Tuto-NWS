# Créer une connexion à une base de données sécurisée avec PHP

## 0 | Préambule

Dans ce tutoriel, nous allons voir comment créer une arborescence de fichiers simple pour établir une connexion à une base de données en PHP en utilisant les informations de connexion stockées dans un fichier JSON. Nous aurons une fonction indépendante dans un fichier dbConnect.php que vous pourrez réutiliser tel quel dans n'importe lequel de vos projets en changeant simplement les données de connexion et le nom de la table.

1. [Création des fichiers et mise en place](#1--création-des-fichiers-et-mise-en-place)
2. [Le fichier JSON](#2--le-fichier-json)
3. [Le fichier dbConnect.php](#3--le-fichier-dbconnectphp)
4. [Le fichier index.php](#4--le-fichier-indexphp)
5. [Conclusion](#5--conclusion)


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

### b. méthode __construct

Ensuite nous allons créer une méthode privée '__construct'. Cette méthode se trouve à l'interieur de la class 'DBManager' :

```php
public function __construct(string $DBName) {
        $this->db_name = $DBName;
        $dbConfig = $this->loadConfig();
        $this->connect($dbConfig);
    }
```

Celle ci va permettre de récuprer le nom de notre base de données qui sera située dans 'index.php' que nous verrons dans un second temps et d'appeler les méthodes 'loadConfig' et 'connect' que nous allons voir ci-dessous.

### c. méthode loadConfig

Ici, nous allons créer la méthode 'loadConfig'. Celle-ci va permettre de charger le fichier 'config.json' que nous avons créé précédemment et qui contient toutes les informations nécessaires pour se connecter à notre base de données :

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

### d. méthode connect

maintenant nous allons créer la méthode 'connect' elle va permettre de tenter de se connecter à la base de données grâce à tout ce que l'on a fait précédement :

```php
private function connect(array $config): void {
    try {
        $pdo = new PDO(
            "mysql:host={$config['host']};dbname={$this->db_name};port={$config['port']}",
            $config['username'],
            $config['password']
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo = $pdo;

        echo "Connexion à la base de données réussie.";
            
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
```

'connect' utilise les informations de connexion fournies par '$config' pour établir une connexion à la base de données à l'aide de l'objet PDO. En cas de succès, elle stocke l'objet PDO dans la propriété de classe '$pdo' et affiche un message de réussite. En cas d'échec, elle affiche un message d'erreur avec les détails de l'exception PDO.

### e. méthode getPDO

Finalement nous allons créer la méthode publique 'getPDO':

```php
public function getPDO() {
    return $this->pdo;
}
```

'getPDO' retourne l'objet PDO stocké dans la propriété de classe '$pdo'. Cela permet d'obtenir l'objet PDO depuis l'extérieur de la classe, offrant ainsi un moyen d'accéder à la connexion à la base de données à partir d'autres parties du code.

## 4 | Le fichier index.php

Nous allons terminer ce tuto par écrire notre fichier index.php :

```php
<?php
require_once 'methodes/dbConnect.php';
$pdoManager = new DBManager('nom_de_la_bdd');
$pdo = $pdoManager->getPDO();
?>
```

On inclut le fichier 'dbConnect.php' qui contient la définition de la classe 'DBManager'.
Ensuite, on crée une connexion à une base de données en utilisant cette classe 'DBManager' et en spécifiant le nom de la base de données ('nom_de_la_bdd').

On obtient l'objet PDO représentant la connexion en appelant la méthode 'getPDO' de la classe 'DBManager'.
Enfin, on stocke cet objet PDO dans la variable '$pdo' pour pouvoir l'utiliser dans le reste du code.

## 5 | Conclusion

Mainteant vous savez comment vous connecter à votre base de données de façon simple et sécurisée et à pouvoir utiliser cette connexion dans toutes les pages que vous souhaitez.

Ce code et réutilisable dans l'état et modulable pour vos besoins.

**Bon code à tous**