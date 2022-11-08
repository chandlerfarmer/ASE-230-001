<?php

require('classes.php'); //THIS PROGRAM TESTS' THE CSVHELPER CLASS

$csvFile = 'test.csv';


echo '<h1> THIS WEB PAGE TESTS CSVHELPERS\' METHODS</h1> <hr>';


echo '<h4>FILE CONTENTS (READ):</h4>';
CSVHelper::read($csvFile);
echo '<hr>';



echo '<h4>YOUR NEW FILE CONTENTS (WRITE):</h4>';
$sampleData = "John Doe";
CSVHelper::write($csvFile, $sampleData);
echo '<hr>';



$sampleData2 = "New Guy";
echo '<h4>YOUR NEW DATA AFTER UPDATING INDEX 4 (UDPATE):</h4>';
CSVHELPER::update($csvFile, 4, $sampleData2);
echo '<hr>';


echo '<h4>YOUR NEW DATA AFTER DELETING INDEX 1 (DELETE):</h4>';
CSVHELPER::delete($csvFile, 1);
