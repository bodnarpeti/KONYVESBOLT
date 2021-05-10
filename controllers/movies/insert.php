<?php
if(!empty($_POST)) {
    require_once "../../db/config.php";
    $msg="";

    if(empty($_POST['filmid']) || empty($_POST['filmCime']) ||  empty($_POST['filmAra'])  || empty($_POST['loginid'])){
        // TODO set error message
        $msg.="<li>Az összes mező kitöltése kötelező";
    }

    if($msg!="") {
        //TODO show errors after redirect
        //header("location:books.php?error=".$msg);
    } else {
        $id = $_POST['filmid'];
        $title = $_POST['filmCime'];
        $price = $_POST['filmAra'];
        $otherid = $_POST['loginid'];        

        //TODO: generate id
        $sql = 'INSERT INTO FILM(filmid,filmCime,filmAra,loginid) '.
               'VALUES(:filmid, :filmCime, :filmAra, :loginid)';

        $compiled = oci_parse($conn, $sql);

        oci_bind_by_name($compiled, ':filmid', $id);
        oci_bind_by_name($compiled, ':filmCime', $title);
        oci_bind_by_name($compiled, ':filmAra', $price);
        oci_bind_by_name($compiled, ':loginid', $otherid);
       
        oci_execute($compiled);

        header("location:../../movies.php?insert=1");
    }
}
?>