<?php
if(!empty($_POST)) {
    require_once "../../db/config.php";
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

        header("location:../../vasarlo.php?insert=1");
    }
}
?>