<html>
<body>
	<h1>Passwort zurücksetzen</h1>
    <p>Sie haben den Vorgang zum Zurücksetzen Ihres Passworts eingeleitet.<br>
        Bitte klicken Sie auf folgenden Link um Ihr Passwort zurückzusetzen: <?= anchor("/backend/auth/reset_password/{$forgotten_password_code}", 'Passwort zurücksetzen');?></p>
    <p>Sollten Sie diese Funktion nicht aufgerufen haben, informieren Sie ihren Administrator.</p>
</body>
</html>