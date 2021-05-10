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
        #cds{
            position: relative;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

    </style>
</head>
<body>
<header>
    <h1><span>CD-k</span></h1>

</header>
<nav id="navigation">
    <ul>
        <li class="indexbtn"><a href = index.php target="_self">Főoldal</a></li>
        <li class="vasarlobtn"><a href = vasarlo.php target="_self">Vásárlóink</a></li>
        <li class="booksbtn"><a href = books.php target="_self">Könyveink</a></li>
        <li class="salersbtn"><a href = salers.php target="_self">Eladóink</a></li>
		<li class="moviesbtn"><a href = movies.php target="_self">Filmjeink</a></li>
		<li class="cdsbtn"><a href = movies.php target="_self">CD-k</a></li>
    </ul>
</nav>
<img id="cds" src="images/cds.jpg" alt="Cds" title="cds" width="350" height="250"  />

<?php

echo '<h2>A tábla rekordjai: </h2>';
echo '<table border="0" id="tabla">';

$stid = oci_parse($conn, 'SELECT cdid, cdCime, cdAra, loginid FROM CD');
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
         <form action="controllers/cds/delete.php" method="post"> 
          <input type="hidden" name="id" value=' . $row['CDID'] . '>
          <button type="submit">Törlés</button> 
         </form> 
        </td>';
    echo '
    <td style="text-align: center">
     <form action="controllers/cds/update.php" method="post"> 
      <input type="hidden" name="id" value=' . $row['CDID'] . '>
      <input type="hidden" name="cdCime" value=' . $row['CDCIME'] . '>
      <input type="hidden" name="cdAra" value=' . $row['CDARA'] . '>
      <input type="hidden" name="loginid" value=' . $row['LOGINID'] . '>
      <button type="submit">Módosítás</button> 
     </form> 
    </td>';
    echo '</tr>';
}
echo '</table>';

oci_close($conn);

?>

<form action="controllers/cds/insert.php" method="post">

    <input class="" type="text" name="cdid" value="" placeholder="CD azonosítója">
    <input class="" type="text" name="cdCime" value="" placeholder="CD címe">
    <input class="" type="text" name="cdAra" value="" placeholder="CD ára">
    <input class="" type="text" name="loginid" value="" placeholder="Vásárló azonosítója">
    
    <button type="submit">Sor felvétele</button>
</form>

</body>
</html>
