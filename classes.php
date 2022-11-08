<?php

// Dr. Caporusso plz read --> I PLAN TO MOVE EACH CLASS INTO ITS OWN FILE. I SUBMITTED IT AS ONE BECAUSE I HAD HARD CODED MANY FILE PATHS/NAMES FOR TESTING.


class JSONHelper{

    //FUNCTION FOR READING DATA INSIDE A JSON FILE (THE DATA STAYS IN JSON FORMAT)
    static function read($jsonFile){
        if (!file_exists($jsonFile)){
            die('JSON File not found.');
        }


        $fileContent = file_get_contents($jsonFile);
        echo $fileContent;
    }


    //FUNCTION FOR WRITING
    static function write($jsonFile, $data){
        if (!file_exists($jsonFile)){
            die('JSON File not found.');
        }


        $fileContent = json_decode(file_get_contents($jsonFile), true);
        $fileContent[] = $data;
        file_put_contents($jsonFile, json_encode($fileContent));
        echo file_get_contents($jsonFile);
    }


    //FUNCTION FOR UPDATING
    static function update($jsonFile, $id, $data){
        if (!file_exists($jsonFile)){
            die("JSON File not found.");
        }


        $fileContent = json_decode(file_get_contents($jsonFile), true);
        if (isset($fileContent[$id])){
            $fileContent[$id] = $data;
            file_put_contents($jsonFile, json_encode($fileContent));
            echo file_get_contents($jsonFile);
        }
    }


    //FUNCTION FOR DELETING
    static function delete($jsonFile, $id){
        if (!file_exists($jsonFile)){
            die('JSON File not found.');
        }


        $fileContent = json_decode(file_get_contents($jsonFile), true);
        if (isset($fileContent[$id])){
            unset($fileContent[$id]);
            file_put_contents($jsonFile, json_encode(array_values($fileContent)));
            echo file_get_contents($jsonFile);
        }
    }
}


class CSVHelper{

    //FUNCTION FOR READING DATA IN A CSV FILE.
    static function read($csvFile){
        if (!file_exists($csvFile)){
            die("CSV File not found.");
        }

        $fileContent = file_get_contents($csvFile);
        echo $fileContent;
    }


    //FUNCTION FOR WRITING DATA TO A CSV FILE.
    static function write($csvFile, $data){
        if (!file_exists($csvFile)){
            die('CSV File not found.');
        }


        $fh = fopen($csvFile, "a");
        fputs($fh, "\n".$data);
        fclose($fh);
        echo file_get_contents($csvFile);
    }


    //FUNCTION FOR UPDATING INFORMATION IN A CSV FILE.
    static function update($csvFile, $id, $data){
        if (!file_exists($csvFile)){
            die("CSV File not found.");
        }
        

        $fh = fopen($csvFile, 'r');
        while ($line = fgets($fh)){
            $tempData[] = $line;
        }

        if (count($tempData) < $id){
            die("Enter a valid ID.");
        }


        for ($x = 0; $x < count($tempData); $x++){
            if ($x == $id){
                $tempData[$id] = $data;
            }
        }


        $fh = fopen($csvFile, 'w');
        fclose($fh);
        $fh = fopen($csvFile, 'w');
        for ($i = 0; $i < count($tempData); $i++){
            if ($i == $id){
                fputs($fh, $tempData[$i].PHP_EOL); 
                continue;
            }
            fputs($fh, $tempData[$i]);
        }


        fclose($fh);
        echo file_get_contents($csvFile);
    }


    //FUNCTION FOR DELETING INFORAMTION IN A CSV FILE.
    static function delete($csvFile, $id){
        if (!file_exists($csvFile)){
            die('CSV File not found.');
        }

        $fh = fopen($csvFile, 'r');
        while ($line = fgets($fh)){
            $tempData[] = $line;
        }

        if (count($tempData) < $id){
            die('Enter a valid ID');
        }

        unset($tempData[$id]);
        $tempData[$id] = '';

        $fh = fopen($csvFile, 'w');
        fclose($fh);
        $fh = fopen($csvFile, 'w');
        for ($i = 0; $i < count($tempData); $i++){
            fputs($fh, $tempData[$i]);
        }
        fclose($fh);

        echo file_get_contents($csvFile);

    }
}


class AuthHelper{

    //Sign-Up 
    static function signUp($email, $password){
        if (!(file_exists('users.csv'))){
            die('User Database not available.');
        }

        $fh = fopen('users.csv', 'a+');
        fputs($fh, $email.';' . password_hash($password, PASSWORD_DEFAULT).PHP_EOL);
        fclose($fh);
        echo 'You created your account. Sign-In please.';
    }



    //FUNCTION FOR SIGNGING IN.
    static function signIn($email, $password){
        if (!(file_exists('users.csv'))){
            die('USer Database not available.');
        }

        $fh = fopen('users.csv', 'r');
        while ($line = fgets($fh)){
            $line = trim($line);
            $line = explode(';', $line);
            if ($line[0] == $email){
                if (password_verify($password, $line[1])){
                    $_SESSION['logged'] = true;
                    $_SESSION['email'] = $line[0];
                    echo 'You\'ve succesfully signed in!';
                }
            }
        }
    }


    //FUNCTION FOR SIGNING OUT.
    static function signOut(){

        if (AuthHelper::check() == false){
            echo 'You\'re not signed in';
            die();
        }
        unset($_SESSION['logged']);
        session_destroy();
        echo 'You\'ve succesfully signed out.';
    }


    //FUNCTION FOR CHECKING IF LOGGED IN.
    static function check(){
        if (!(isset($_SESSION['logged']))){
            return false;
        }
        else{
            return true;
        }
    }



    //FUNCTION FOR GETTING AN AUTHENTICATED USERS DATA.
    static function getData($email){
        if (!(file_exists('users.csv'))){
            die('User database not available');
        }

        $fh = fopen('users.csv', 'r');
        while ($line = fgets($fh)){
            $line = trim($line);
            $line = explode(';', $line);
            if ($line[0] == $email){
                echo 'Your email is '. $line[0]. '<br>';
                echo 'Your hashed password is '. $line[1];
            }
        }
    }
}


class Entities{

    //FUNCTION THAT GETS ALL JSON OR CSV INFORMATION.
    static function read($file){
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        if ($fileExtension == 'csv' || $fileExtension == 'CSV'){
            CSVHelper::read($file);
        }
        
        if ($fileExtension == 'json' || $fileExtension == 'JSON'){
            JSONHelper::read($file);
        }
    }


    //FUNCTION THAT RETREIVES ONE ENTITY
    static function getIndex($file, $index){
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        if ($fileExtension == 'csv' || $fileExtension == 'CSV'){
            $fh = fopen($file, 'r');
            while ($line = fgets($fh)){
            $tempData[] = $line;
            fclose($fh);
        }
        for ($x = 0; $x < count($tempData); $x++){
            if ($x == $index){
                echo $tempData[$index];
            }
        }
        }
        
        if ($fileExtension == 'json' || $fileExtension == 'JSON'){

            $fileContent = json_decode(file_get_contents($file), true);
            if (isset($fileContent[$index])){
                echo $fileContent[$index];
    
        }
        else{
            echo 'Invalid Index';
        }
    }
}
    
    

    //FUCNTION THAT CREATES A RECORD IN A CSV OR JSON FILE.
    static function create($file, $data){
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        if ($fileExtension == 'csv' || $fileExtension == 'CSV'){
            CSVHelper::write($file, $data);
        }
        
        if ($fileExtension == 'json' || $fileExtension == 'JSON'){
            JSONHelper::write($file, $data);
        }
    }

    //FUNCTION FOR UPDATING CONTENTS A CSV OR JSON FILE.
    static function update($file, $id, $data){
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        if ($fileExtension == 'csv' || $fileExtension == 'CSV'){
            CSVHelper::update($file, $id, $data);
        }
        
        if ($fileExtension == 'json' || $fileExtension == 'JSON'){
            JSONHelper::update($file, $id, $data);
        }
    }


    //FUNCTION FOR DELETING CONTENTS FROM A CSV OR JSON FILE.
    static function delete($file, $id){
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
        if ($fileExtension == 'csv' || $fileExtension == 'CSV'){
            CSVHelper::delete($file, $id);
        }
        
        if ($fileExtension == 'json' || $fileExtension == 'JSON'){
            JSONHelper::delete($file, $id);
        }
    }
}