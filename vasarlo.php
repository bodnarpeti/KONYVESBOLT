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
        <li><a href = books.php target="_self">Könyveink</a></li>
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
?>

<form action="vasarlo.php" method="post">

    <input class="" type="text" name="teljesNevVasarlo" value="" placeholder="Teljes név">
    <input class="" type="text" name="szuletesiDatum" value="" placeholder="Születési dátum">
    <input class="" type="text" name="lakcim" value="" placeholder="Lakcím">
    
    <button type="submit">Sor felvétele</button>
</form>

<?php

if(!empty($_POST)) {
    $msg="";

    if(empty($_POST['teljesNevVasarlo']) || empty($_POST['szuletesiDatum']) || empty($_POST['lakcim'])) {
        // TODO set error message
        $msg.="<li>Az összes mező kitöltése kötelező";
    }

    if($msg!="") {
        //TODO show errors after redirect
        //header("location:vasarlo.php?error=".$msg);
    } else {
        $full_name = $_POST['teljesNevVasarlo'];
        $birth_date = date('Y-m-d', strtotime(@$_POST['szuletesiDatum']));
        $address = $_POST['lakcim'];
        
        //TODO: generate loginid
        $sql = 'INSERT INTO VASARLO(loginid,teljesNevVasarlo,szuletesiDatum,lakcim) '.
               'VALUES(0001, :teljesNevVasarlo, :szuletesiDatum, :lakcim)';

        $compiled = oci_parse($conn, $sql);

        oci_bind_by_name($compiled, ':teljesNevVasarlo', $full_name);
        oci_bind_by_name($compiled, ':szuletesiDatum', $birth_date);
        oci_bind_by_name($compiled, ':lakcim', $address);

        $dateformat = oci_parse($conn, "alter session set nls_date_format='YYYY-MM-DD'");
        oci_execute($dateformat);
        oci_execute($compiled);

        //header("location:vasarlo.php?ok=1");
    }
}

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
    echo '<tr>';    foreach ($row as $item) {
        echo '<td style="text-align: center">' . $item . '</td>';
        
    }
    echo '</tr>';
}
echo '</table>';

oci_close($conn);

?>

</body>
</html>
