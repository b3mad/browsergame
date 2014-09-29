<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de">
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="author" content="Philippe Ruoss" />
            <meta name="Keywords" content="" />
            <meta name="Description" content="" />
            <link rel="stylesheet" type="text/css" href="style.css">
                <title>Login Strategia Imperialis</title>
        </head>
        <body>

            <form action="login.php" method="post" class="login">
                <dl>
                    <label for="login">Benuzername:</label>
                    <dd><input type="text" name="username" placeholder=""/></dd>
                    <label for="password">Passwort:</label>
                    <dd><input type="password" name="password" placeholder=""/></dd>
                </dl>

                <p>
                    <input type="submit" name="submit" value="Login" />
                    <input type="reset" value="Zurücksetzen" /><br>
                    <a href="registrieren.php">Noch nicht registriert?</a>
                </p>
                
            </form>
        </body>
    </html>
