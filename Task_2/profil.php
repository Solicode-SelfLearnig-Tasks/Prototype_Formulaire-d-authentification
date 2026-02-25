<?php
// profil.php
session_start();

// Vérifier l'authentification
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // pas authentifié, redirection vers login
    header('Location: login.php');
    exit;
}

$user = isset($_SESSION['user']) ? $_SESSION['user'] : 'Utilisateur';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
</head>
<body>
    <h1>Bienvenue <?php echo htmlspecialchars($user); ?> dans votre profil</h1>
    <p>Cette page est accessible uniquement après connexion.</p>
    <p><a href="deconnexion.php">Se déconnecter</a></p>
</body>
</html>