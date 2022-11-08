<?php

require('classes.php');

//TESTS THE READ METHOD FOR JSON.
echo '<h4>Contents of JSON File:</h4>';
Entities::read('test.json');
echo '<hr>';


//TESTS THE READ METHOD FOR CSV.
echo '<h4>Contents of CSV File:<h4>';
Entities::read('test.csv');
echo '<hr>';


//TESTS THE CREATE METHOD FOR JSON.
echo '<h4>Adding a record to a JSON File</h4>';
Entities::create('test.json', 'newdata!');
echo '<hr>';


//TESTS THE CREATE METHOD FOR CSV.
echo '<h4>Adding a record to a CSV File</h4>';
Entities::create('test.csv', 'newdata!');
echo'<hr>';


//TESTS THE UPDATE METHOD FOR A CSV FILE.
echo '<h4> Modifying index 0 of a CSV File</h4>';
Entities::update('test.csv', 0, 'index0data!');
echo '<hr>';

//TESTS THE UPDATE METHOD FOR JSON FILE.
echo '<h4> Modifying index 0 of a JSON File</h4>';
Entities::update('test.json', 0, 'index0data!');
echo '<hr>';


//DELETES THE CONTENT OF A CSV FILE.
echo '<h4> Deletes index 0 of a CSV File.</h4>';
Entities::delete('test.csv', 0);
echo '<hr>';

//DELETES THE CONTENT OF A JSON FILE.
echo '<h4> Deletes index 0 of a JSON File.</h4>';
Entities::delete('test.json', 0);
echo '<hr>';


//RETRIEVES A SPECIFIC INDEX FROM A CSV FILE.
echo '<h4> Returns index 1 from a CSV File.</h4>';
Entities::getIndex('test.csv', 1);
echo '<hr>';

//RETREIVES A SPECIFIC INDEX 1 FROM A JSON FILE.
echo '<h4> Returns index 1 from a JSON File.</h4>';
Entities::getIndex('test.json', 1);