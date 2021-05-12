<?php

?>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Login Konyvesbolt</title>
    <meta name="author" content="Demeter Ádám, Tajti Sándor, Bodnár Péter"/>
    <link rel="icon" href="images/logo.png"/>
    <link rel=stylesheet type="text/css" href="styles/reg_styles.css" />
</head>
<body>
<form action="controllers/regist/insert.php" method="post">
    <input class="" type="text" name="felhasznaloNev" value="" placeholder="felhasználó név"></br></br>
    <input class="" type="email" name="email" value="" placeholder="emil"></br></br>
    <input class="" type="password" name="pswd" value="" placeholder="jelszó"></br></br>
    <input class="" type="password" name="pswdr" value="" placeholder="jelszó ismét"></br></br>
    <button class="btn" type="submit">Regisztráció</button>

</form></br>
<button class="btn" type="submit">Bejelentkezés</button>
</body>
</html>
