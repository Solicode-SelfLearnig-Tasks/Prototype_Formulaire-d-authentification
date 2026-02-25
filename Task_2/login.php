<?php
// login.php
session_start();

// If already authenticated, go to profile
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    header('Location: profil.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve credentials from POST
    $login    = isset($_POST['login']) ? trim($_POST['login']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // static credentials
    $validLogin    = 'user';
    $validPassword = '1234';

    if ($login === $validLogin && $password === $validPassword) {
        // authentication successful
        $_SESSION['authenticated'] = true;
        $_SESSION['user'] = $login;
        header('Location: profil.php');
        exit;
    } else {
        $error = 'Identifiant ou mot de passe invalide.';
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <?php if ($error): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method="post" action="login.php">
        <label for="login">Identifiant :</label>
        <input type="text" id="login" name="login" required><br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>