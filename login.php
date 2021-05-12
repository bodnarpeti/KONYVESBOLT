<?php
session_start();
require_once "db/config.php";
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
//error fuction returns an oracle message.
    exit;
    $query = "SELECT felhasznaloNev  FROM REGIST WHERE id=:felhasznaloNev and jelszo=:pswd";
//query is sent to the db to fetch row id.
    $stid = oci_parse($conn, $query);

    /*oci_parse fuction prepares the db to execute the statement.
    requires two parameters resource($con)and sql string.*/

    if (isset($_POST['felhasznaloNev']) || isset($_POST['pswd'])) {
        $id = $_POST['felhasznaloNev'];
        $jelszo = $_POST['pswd'];
    }
    oci_bind_by_name($stid, ':felhasznaloNev', $id);
    oci_bind_by_name($stid, ':pswd', $jelszo);

    /*oci_bind_by_name function tells php which variable to use.
    They are references of the original variables.*/

    oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC);

//oci_fetch_array returns a row from the db.

    if ($row) {
        $_SESSION['user'] = $_POST['user'];
        echo "log in successful";
    } else {
        echo("The person " . $id . " is not found .
Please check the spelling and try again or check password");
        exit;
    }
    $ID = $row['felhasznaloNev'];
    oci_free_statement($stid);
    oci_close($con);
    header('Location: index.php');
}
    ?>