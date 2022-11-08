<?php

require('classes.php'); //THIS PROGRAM TESTS' THE JSONHELPER CLASS

$jsonFile = 'test.json';

echo "<h1>THIS WEB PAGE TESTS JSONHELPERS' METHODS</h1> <hr>";


// TESTS THE READ METHOD
echo '<h4>FILE CONTENTS (READ):</h4>';
JSONHELPER::read($jsonFile);
echo '<hr>';



//TESTS THE WRITE METHOD
echo '<h4>YOUR NEW FILE CONTENTS (WRITE):</h4>';
$sampleArray = ["name"=> "Larry Bird", "Age"=> 65];
JSONHELPER::write($jsonFile, $sampleArray);
echo '<hr>';






//TESTS THE UPDATING METHOD
echo ' <h4>YOUR NEW DATA AFTER UPDATING INDEX 0 (UPDATE):</h4>';
$sampleArray2 = ["name" => 'LeBron James', "Age" => 37];
JSONHELPER::update($jsonFile, 0, $sampleArray2);
echo '<hr>';


//TESTS THE DELETE METHOD
echo '<h4>YOUR NEW DATA AFTER DELETING INDEX 0 (DELETE):</h4>';
JSONHELPER::delete($jsonFile, 0);
echo '<hr>';