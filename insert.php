<?php
session_start();
if(!empty($_POST)) {
    require_once "../../db/config.php";
    require_once 'functions.php';
    $msg="";


    if($msg!="") {
        //TODO show errors after redirect
        //header("location:books.php?error=".$msg);
    } else {
        $id = $_POST['felhasznaloNev'];
        $email = $_POST['email'];
        $jelszo = $_POST['pswd'];
        $jelszor = $_POST['pswdr'];

        //TODO: generate id
        $sql = 'INSERT INTO REGIST(felhasznaloNev,email,pswd,pswdr) '.
            'VALUES(:felhasznaloNev, :email, :pswd, :pswdr)';

        $compiled = oci_parse($conn, $sql);

        oci_bind_by_name($compiled, ':felhasznaloNev', $id);
        oci_bind_by_name($compiled, ':email', $email);
        oci_bind_by_name($compiled, ':pswd', $jelszo);
        oci_bind_by_name($compiled, ':pswdr', $jelszor);

        oci_execute($compiled);

        header("Location: login.php");
    }
}
if(empty($_POST['felhasznaloNev']) || empty($_POST['email']) ||  empty($_POST['pswd'])  || empty($_POST['pswdr'])){
    header("Location: regisztracio.php?error=emptyInput");
}

else if(invalidEmail($email) !== false){
    header("Location: regist.php?error=invalidEmail");

}
else if(passwordMatch($jelszo, $jelszor) !== false){
    header("Location: regist.php?error=notMatchingPw");

}
?>
