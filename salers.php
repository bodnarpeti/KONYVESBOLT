<?php
session_start();
?>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Konyvesbolt</title>
    <meta name="author" content="Demeter Ádám, Tajti Sándor, Bodnár Péter"/>
    <link rel="icon" href="images/logo.png"/>
    <link rel=stylesheet type="text/css" href="styles/salers_styles.css" />
    <style>
        #elado{
            position: relative;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
<header>
    <h1><span>Eladóink</span></h1>

</header>
<nav id="navigation">
    <ul>
        <li class="indexbtn"><a href = index.php target="_self">Főoldal</a></li>
        <li class="vasarlobtn"><a href = vasarlo.php target="_self">Vásárlóink</a></li>
        <li class="booksbtn"><a href = books.php target="_self">Könyveink</a></li>
        <li class="salersbtn"><a href = salers.php target="_self">Eladóink</a></li>
    </ul>
</nav>
<img id="elado" src="images/elado.png" alt="Elado" title="elado" width="550" height="300"  />
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

$conn = oci_connect('system', 'oracle', $tns,'UTF8');
?>

<form action="salers.php" method="post">

    <input class="" type="text" name="eladoid" value="" placeholder="Eladó azonosítója">
    <input class="" type="text" name="teljesNevElado" value="" placeholder="Eladó teljes neve">
    
    <button type="submit">Sor felvétele</button>
</form>

<?php

if(!empty($_POST)) {
    $msg="";

    if(empty($_POST['eladoid']) || empty($_POST['teljesNevElado'])) {
        // TODO set error message
        $msg.="<li>Az összes mező kitöltése kötelező";
    }

    if($msg!="") {
        //TODO show errors after redirect
        //header("location:salers.php?error=".$msg);
    } else {
        $id = $_POST['eladoid'];
        $fullname = $_POST['teljesNevElado'];
        
        //TODO: generate eladoid
        $sql = 'INSERT INTO ELADO(eladoid,teljesNevElado) '.
               'VALUES(:eladoid, :teljesNevElado)';

        $compiled = oci_parse($conn, $sql);

        oci_bind_by_name($compiled, ':eladoid', $id);
        oci_bind_by_name($compiled, ':teljesNevElado', $fullname);
       
        oci_execute($compiled);

        //header("location:salers.php?ok=1");
    }
}

echo '<h2>A tábla rekordjai: </h2>';
echo '<table border="0" id="tabla">';

$stid = oci_parse($conn, 'SELECT eladoid, teljesNevElado FROM ELADO');
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
    echo '</tr>';
}
echo '</table>';

oci_close($conn);

?>

</body>
</html>
