<?php
session_start();
?>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Konyvesbolt</title>
    <meta name="author" content="Demeter Ádám, Tajti Sándor, Bodnár Péter"/>
    <link rel="icon" href="logo.png"/>
    <link rel=stylesheet type="text/css" href="stilus.css" />
    <style>
        #udv{
            position: relative;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        p {
            color: white;
            font-family: Arial, sans-serif;
            font-size: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
<header>
    <h1><span>Üdvözlünk a weboldalunkon!</span></h1>
</header>
<nav id="navigation">
    <ul>
        <li><a href = index.php target="_self">Főoldal</a></li>
        <li><a href = vasarlo.php target="_self">Vásárlóink</a></li>
        <li><a href = books.php target="_self">Könyveink</a></li>
        <li><a href = salers.php target="_self">Eladóink</a></li>
    </ul>
</nav>
<p>Az alábbi Adatbázis alapú rendszerek gyakorlat projektmunka egy könyvesbolt webes felületének működését reprezentálja.</p>

<img id="udv" src="udv.gif" alt="Welcome" title="welcome" width="550" height="350"  />

</body>
</html>
