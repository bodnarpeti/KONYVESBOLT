<?php
if(!empty($_POST)) {
    require_once "../../db/config.php";
    $msg="";

    if(empty($_POST['konyvid']) || empty($_POST['konyvCime']) ||  empty($_POST['ar'])  || empty($_POST['loginid'])){
        // TODO set error message
        $msg.="<li>Az összes mező kitöltése kötelező";
    }

    if($msg!="") {
        //TODO show errors after redirect
        //header("location:books.php?error=".$msg);
    } else {
        $id = $_POST['konyvid'];
        $title = $_POST['konyvCime'];
        $price = $_POST['ar'];
        $otherid = $_POST['loginid'];        

        //TODO: generate id
        $sql = 'INSERT INTO KONYV(konyvid,konyvCime,ar,loginid) '.
               'VALUES(:konyvid, :konyvCime, :ar, :loginid)';

        $compiled = oci_parse($conn, $sql);

        oci_bind_by_name($compiled, ':konyvid', $id);
        oci_bind_by_name($compiled, ':konyvCime', $title);
        oci_bind_by_name($compiled, ':ar', $price);
        oci_bind_by_name($compiled, ':loginid', $otherid);
       
        oci_execute($compiled);

        header("location:../../books.php?insert=1");
    }
}
?>