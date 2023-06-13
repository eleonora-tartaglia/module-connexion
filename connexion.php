<!-- Page connexion -->

<?php

session_start();

$host = "localhost"; 
$db = "moduleconnexion"; 
$user = "hayley"; 
$pass = "monarque"; 

try {
    // Créer une nouvelle connexion PDO à MySQL
    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    // Configurer PDO pour qu'il lance une exception chaque fois qu'une erreur se produit
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Si la connexion échoue, afficher l'erreur
    die("Erreur : " . $e->getMessage());
}

if (isset($_POST['submit'])){
    $login = $_POST['login'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $stmt->bindParam(1, $login);

    if($stmt->execute()){
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user){
            // Vérifiez si l'utilisateur est admin
            if($user['login'] == 'admin' && $password == $user['password']) {
                $_SESSION['user'] = $user;
                header('Location: admin.php'); // Redirection vers la page admin si l'utilisateur est admin
            // Vérifiez les autres utilisateurs
            } elseif(password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                unset($_SESSION['user']['password']);  // Supprimez le mot de passe de la session
                header('Location: index.php'); // Redirection vers la page index si l'utilisateur n'est pas admin
            } else {
                echo "Je pense que vous faites fausse route..";
            }
        } else {
            echo "Je pense que vous faites fausse route..";
        }
    } else {
        echo "Je pense que vous faites fausse route..";
    }
}
$conn = null;
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="connexion.css">
</head>
<body>
    <header class="header">
        <div>
            <h1>ZUBI</h1>
            <!-- <img src="logo.png" alt="logo"> -->
        </div>
        <nav class="nav">
            <a href="index.php">Accueil</a>
            <a href="inscription.php">Créer un compte</a>
            <a href="profil.php">Modifier son compte</a>
        </nav>
    </header>

    <div class="form-container" id="form-container">
        <h3 class="title">Connexion</h3>
        <form method="POST" action="connexion.php">
            Login : <input type="text" name="login" required><br>
            Mot de passe : <input type="password" name="password" required><br>
            <input type="submit" name="submit" value="Se connecter" id="submit-button">
        </form>
    </div>

    <footer>
        <h4>With a lot of fun by Eléonora Tartaglia<h4>
    </footer>
</body>
</html>
