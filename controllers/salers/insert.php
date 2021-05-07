<?php
if(!empty($_POST)) {
    require_once "../../db/config.php";
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

        header("location:../../salers.php?insert=1");
    }
}
?>