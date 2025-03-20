<!DOCTYPE html>
<html>
<head>
    <title>Réinitialisation de mot de passe</title>
</head>
<body>
    <h2>Réinitialisation de mot de passe</h2>

    <p>Vous recevez cet email car nous avons reçu une demande de réinitialisation de mot de passe pour votre compte.</p>

    <p>Cliquez sur le lien ci-dessous pour réinitialiser votre mot de passe :</p>
    
    <a href="{{ url('/reset-password/' . $token . '?email=' . $email) }}" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
        Réinitialiser mon mot de passe
    </a>

    <p>Si vous n'avez pas demandé de réinitialisation de mot de passe, aucune action n'est requise.</p>

    <p>Ce lien expirera dans 60 minutes.</p>
</body>
</html>