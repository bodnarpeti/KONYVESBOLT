<?php

function invalidEmail($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result=true;
    }
    else{
        $result=false;
    }
    return $result;

}
function passwordMatch($jelszo, $jelszor){
    if($jelszo !== $jelszor){
        $result=true;
        echo ("A két jelszó nem egyezik!");
    }
    else{
        $result= false;
    }
    return $result;

}

?>
