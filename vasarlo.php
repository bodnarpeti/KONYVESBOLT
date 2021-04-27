<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Konyvesbolt</title>
    <meta name="author" content="Demeter Ádám, Tajti Sándor, Bodnár Péter"/>
    <link rel="icon" href="logo.png"/>
    <link rel=stylesheet type="text/css" href="stilus.css" />
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
        <li><a href = index.php target="_self">Főoldal</a></li>
        <li><a href = vasarlo.php target="_self">Vásárlóink</a></li>
        <li><a href = boooks.php target="_self">Könyveink</a></li>
        <li><a href = salers.php target="_self">Eladóink</a></li>
    </ul>
</nav>
<img id="customer" src="customer.png" alt="Customer" title="customer" width="350" height="250"  />
<?php
$tns = "
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = xe)
    )
  )";

$conn = oci_connect('admin', 'valami420', $tns,'UTF8');

echo 'csákó';
echo '<h2>A tábla rekordjai: </h2>';
echo '<table border="0" id="tabla">';

$stid = oci_parse($conn, 'SELECT loginid, teljes_nev_vasarlo, szuletesi_datum, lakcim FROM VASARLO');
oci_execute($stid);

$nfields = oci_num_fields($stid);
echo '<tr>';
for ($i = 1; $i<=$nfields; $i++){
    $field = oci_field_name($stid, $i);
    echo '<td style="text-align: center">' . $field . '</td>';
}
echo '</tr>';

//$stid = oci_parse($conn, 'SELECT loginid, teljes_nev_vasarlo, szuletesi_datum, lakcim FROM VASARLO');
oci_execute($stid);

// Ez valamiért nem mükszik
while ( ($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {
    echo '<tr>';
    echo 'asd';
    foreach ($row as $item) {
        echo '<td style="text-align: center">' . $item['TELJES_NEV_VASARLO'] . '</td>';
        
    }
    echo '</tr>';
}
echo '</table>';

oci_close($conn);

?>

</body>
</html>
