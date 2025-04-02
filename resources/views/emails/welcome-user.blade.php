<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
    <h2>Bonjour {{ $user->name }},</h2>
    <p>Bienvenue sur notre plateforme ! Voici vos identifiants :</p>

    <ul>
        <li><strong>Email :</strong> {{ $user->email }}</li>
        <li><strong>Mot de passe :</strong> {{ $password }}</li>
    </ul>

    <p>Nous vous conseillons de changer votre mot de passe après votre première connexion.</p>

    <p>Merci et à bientôt !</p>
</body>
</html>
