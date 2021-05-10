<?php
session_start();

require('db/config.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Konyvesbolt</title>
    <meta name="author" content="Demeter Ádám, Tajti Sándor, Bodnár Péter"/>
    <link rel="icon" href="images/logo.png"/>
    <link rel=stylesheet type="text/css" href="styles/vasarlo_styles.css" />
    <style>
        #customer{
            position: relative;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<header>
    <h1><span>Vásárlóink</span></h1>
    <h3>Köszönjük a bizalmat!</h3>
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
<img id="customer" src="images/customer.png" alt="Customer" title="customer" width="350" height="250"  />

<?php

echo '<h2>A tábla rekordjai: </h2>';
echo '<table border="0" id="tabla">';

$stid = oci_parse($conn, 'SELECT loginid, teljesNevVasarlo, szuletesiDatum, lakcim FROM VASARLO');
oci_execute($stid);

$nfields = oci_num_fields($stid);
echo '<tr>';
for ($i = 1; $i<=$nfields; $i++){
    $field = oci_field_name($stid, $i);
    echo '<td style="text-align: center">' . $field . '</td>';
}
echo '</tr>';

//$stid = oci_parse($conn, 'SELECT loginid, teljesNevVasarlo, szuletesiDatum, lakcim FROM VASARLO');
oci_execute($stid);

while ( ($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
    echo '<tr>';    
    foreach ($row as $item) {
        echo '<td style="text-align: center">' . $item . '</td>';
        
    }
    echo '
        <td style="text-align: center">
         <form action="controllers/vasarlo/delete.php" method="post"> 
          <input type="hidden" name="id" value=' . $row['LOGINID'] . '>
          <button type="submit">Törlés</button> 
         </form> 
        </td>';
    echo '
    <td style="text-align: center">
     <form action="controllers/vasarlo/update.php" method="post"> 
      <input type="hidden" name="id" value=' . $row['LOGINID'] . '>
      <input type="hidden" name="teljesNevVasarlo" value=' . $row['TELJESNEVVASARLO'] . '>
      <input type="hidden" name="szuletesiDatum" value=' . $row['SZULETESIDATUM'] . '>
      <input type="hidden" name="lakcim" value=' . $row["LAKCIM"] . '>
      <button type="submit">Módosítás</button> 
     </form> 
    </td>';
    echo '</tr>';
}
echo '</table>';

oci_close($conn);

?>

<form action="controllers/vasarlo/insert.php" method="post">

    <input class="" type="text" name="teljesNevVasarlo" value="" placeholder="Teljes név">
    <input class="" type="text" name="szuletesiDatum" value="" placeholder="Születési dátum">
    <input class="" type="text" name="lakcim" value="" placeholder="Lakcím">
    
    <button type="submit">Sor felvétele</button>
</form>

</body>
</html>
