<?php
session_start();
require_once "db/config.php";
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
    $query = "SELECT felhasznaloNev  FROM REGIST WHERE id=:felhasznaloNev and jelszo=:pswd";
    $stid = oci_parse($conn, $query);


    if (isset($_POST['felhasznaloNev']) || isset($_POST['pswd'])) {
        $id = $_POST['felhasznaloNev'];
        $jelszo = $_POST['pswd'];
    }
    oci_bind_by_name($stid, ':felhasznaloNev', $id);
    oci_bind_by_name($stid, ':pswd', $jelszo);


    oci_execute($stid);
    $row = oci_fetch_array($stid, OCI_ASSOC);

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
    oci_close($conn);
}
header('Location: index.php');
?>
