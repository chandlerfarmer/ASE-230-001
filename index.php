<a href="create.php">Create a quote</a>

<hr />
<h1>AUTHORS/QUOTES:</h1>
<hr>


<?php
require 'csv_util.php'; // NEED THIS TO RUN FUNCTIONS

$authors = readRecords('data/authors.csv'); //READS THE RECORDS TO THE $authors ARRAY
$quotes = readRecords('data/quotes.csv');   //READS THE RECORDS TO THE $quotes ARRAY

?>
<ul class="list-group">
<?php

//PRINTS OUT ALL THE AUTHORS AND QUOTES
for ($i = 0; $i < count($authors); $i++){
    
    echo '<h2>'.$authors[$i].'</h2>';

    for ($x = 0; $x < count($quotes); $x++){
        $breakLine = explode(';', $quotes[$x]);
        if ($breakLine[0] == $i){
            //echo '<li class="list-group-item">'.$breakLine[1].'</a> (<a href="detail.php?index='.$x.'">Detail)</a>(<a href="delete.php?index='.$x.'">Delete)</a></li>';
            echo '<li class="list-group-item">'.$breakLine[1].'</a> (<a href="detail.php?index='.$x.'&author='.$i.'">Detail)</a>(<a href="delete.php?index='.$x.'">Delete)</a></li>';
        }
    }
}
?>
</ul>
