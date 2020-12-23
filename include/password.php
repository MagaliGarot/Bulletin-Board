<?php

    function hashPwd($password){
        //Test with Bcrypt
        // $options = [
        //     'cost' => 11
        //     ];
        // return password_hash($password, PASSWORD_BCRYPT, $options);
        return hash('sha512', $password);
    }

?>