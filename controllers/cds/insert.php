<?php
if(!empty($_POST)) {
    require_once "../../db/config.php";
    $msg="";

    if(empty($_POST['cdid']) || empty($_POST['cdCime']) ||  empty($_POST['cdAra'])  || empty($_POST['loginid'])){
        // TODO set error message
        $msg.="<li>Az összes mező kitöltése kötelező";
    }

    if($msg!="") {
        //TODO show errors after redirect
        //header("location:cds.php?error=".$msg);
    } else {
        $id = $_POST['cdid'];
        $title = $_POST['cdCime'];
        $price = $_POST['cdAra'];
        $otherid = $_POST['loginid'];        

        //TODO: generate id
        $sql = 'INSERT INTO CD(cdid,cdCime,cdAra,loginid) '.
               'VALUES(:cdid, :cdCime, :cdAra, :loginid)';

        $compiled = oci_parse($conn, $sql);

        oci_bind_by_name($compiled, ':cdid', $id);
        oci_bind_by_name($compiled, ':cdCime', $title);
        oci_bind_by_name($compiled, ':cdAra', $price);
        oci_bind_by_name($compiled, ':loginid', $otherid);
       
        oci_execute($compiled);

        header("location:../../cds.php?insert=1");
    }
}
?>