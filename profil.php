<!-- Page profil -->

<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: connexion.php');
    exit;
}

$host = "localhost";
$db = "moduleconnexion";
$user = "hayley";
$pass = "monarque";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "<pre>";
    // print_r($_POST); // Pour vérifier les données POST
    // echo "</pre>";
    
    $login = $_POST['login'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    try {
        $sql = "UPDATE utilisateurs SET login = ?, prenom = ?, nom = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$login, $prenom, $nom, $password, $_SESSION['user']['id']]);

        $_SESSION['user']['login'] = $login;
        $_SESSION['user']['prenom'] = $prenom;
        $_SESSION['user']['nom'] = $nom;
    } catch(PDOException $e) {
        echo "Erreur lors de la mise à jour : " . $e->getMessage();
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="profil.css">
</head>

<body>
<header class="header">
        <div>
            <h1>ZUBI</h1>
            <!-- <img src="logo.png" alt="logo"> -->
        </div>
        <nav class="nav">
            <a href="index.php">Accueil</a>
            <a href="connexion.php">Se connecter</a>
            <a href="inscription.php">Créer un compte</a>
        </nav>
</header>

<div class="form-container" id="form-container">
    <h3 class="title">Modifier son compte</h3>
    <form method="POST" action="profil.php">
        Login: <input type="text" name="login" value="<?php echo $_SESSION['user']['login']; ?>" required><br>
        Prénom: <input type="text" name="prenom" value="<?php echo $_SESSION['user']['prenom']; ?>" required><br>
        Nom: <input type="text" name="nom" value="<?php echo $_SESSION['user']['nom']; ?>" required><br>
        Mot de passe: <input type="password" name="password" required><br>
        <input type="submit" value="Mettre à jour" id="submit-button">
    </form>
</div>

    <footer>
        <h4>With a lot of fun by Eléonora Tartaglia<h4>
    </footer>
</body>
</html>