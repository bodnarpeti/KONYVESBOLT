<?php
    session_start();
    require('db/config.php');
?>

<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Konyvesbolt</title>
    <meta name="author" content="Demeter Ádám, Tajti Sándor, Bodnár Péter"/>
    <link rel="icon" href="images/logo.png"/>
    <link rel=stylesheet type="text/css" href="styles/books_styles.css" />
    <style>
        #reading{
            position: relative;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

    </style>
</head>
<body>
<header>
    <h1><span>Könyveink</span></h1>

</header>
<nav id="navigation">
    <ul>
        <li class="indexbtn"><a href = index.php target="_self">Főoldal</a></li>
        <li class="vasarlobtn"><a href = vasarlo.php target="_self">Vásárlóink</a></li>
        <li class="booksbtn"><a href = books.php target="_self">Könyveink</a></li>
        <li class="salersbtn"><a href = salers.php target="_self">Eladóink</a></li>
        <li class="moviesbtn"><a href = movies.php target="_self">Filmjeink</a></li>
	    <li class="cdsbtn"><a href = cds.php target="_self">CD-k</a></li>
    </ul>
</nav>
<img id="reading" src="images/reading.gif" alt="Reading" title="reading" width="350" height="250"  />

<?php

echo '<h2>A tábla rekordjai: </h2>';
echo '<table border="0" id="tabla">';

$stid = oci_parse($conn, 'SELECT konyvid, konyvCime, ar, loginid FROM KONYV');
oci_execute($stid);

$nfields = oci_num_fields($stid);
echo '<tr>';
for ($i = 1; $i<=$nfields; $i++){
    $field = oci_field_name($stid, $i);
    echo '<td style="text-align: center">' . $field . '</td>';
}
echo '</tr>';

oci_execute($stid);

while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
    echo '<tr>';
    foreach ($row as $item) {
        echo '<td style="text-align: center">' . $item . '</td>';
    }
    echo '
        <td style="text-align: center">
         <form action="controllers/books/delete.php" method="post"> 
          <input type="hidden" name="id" value=' . $row['KONYVID'] . '>
          <button type="submit">Törlés</button> 
         </form> 
        </td>';
    echo '
    <td style="text-align: center">
     <form action="controllers/books/update.php" method="post"> 
      <input type="hidden" name="id" value=' . $row['KONYVID'] . '>
      <input type="hidden" name="konyvCime" value=' . $row['KONYVCIME'] . '>
      <input type="hidden" name="ar" value=' . $row['AR'] . '>
      <input type="hidden" name="loginid" value=' . $row['LOGINID'] . '>
      <button type="submit">Módosítás</button> 
     </form> 
    </td>';
    echo '</tr>';
}
echo '</table>';

oci_close($conn);

?>

<form action="controllers/books/insert.php" method="post">

    <input class="" type="text" name="konyvid" value="" placeholder="Könyv azonosítója">
    <input class="" type="text" name="konyvCime" value="" placeholder="Könyv címe">
    <input class="" type="text" name="ar" value="" placeholder="Könyv ára">
    <input class="" type="text" name="loginid" value="" placeholder="Vásárló azonosítója">
    
    <button type="submit">Sor felvétele</button>
</form>

</body>
</html>
