<?php

class sessionHelper{


    // SIGNS IN A USER.
    static function signIn($userID){
        $_SESSION['logged'] = true;
        $_SESSION['userID'] = $userID; 
    }


    //SIGNS OUT A USER.
    static function signOut(){

        if (sessionHelper::check() == false){
            echo 'you\'re not signed in.';
        }

        else{
            unset($_SESSION['logged']);
            unset($_SESSION['userID']);
            session_destroy();

        }
    }


    //CHECKS IF A USER IS SIGNED IN.
    static function check(){

        if (!(isset($_SESSION['logged']))){
            return false;
        }

        else{
            return true;
        }
    }

}