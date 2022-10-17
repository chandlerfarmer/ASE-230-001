<?php 
require 'csv_util.php';

$authors = readRecords('../data/authors.csv');
?>
<a href="index.php">Index Page</a>
<hr />



<form method="POST">





    <label> Enter a quote you'd like:</label>
    <br>
    <input type="text" name="quote" /><br />
    <button type="submit" name="submitted">Add Quote</button>
</form>

<?php


if(count($_POST)>0) {

    $error='';
    //make sure the name isnt in the file 
    if(file_exists('data/quotes.csv')){
        
        $fh=fopen('../data/quotes.csv','r');
        while($line=fgets($fh)) {
            if($_POST['quote']==trim($line)) {
                //found the name already
                $error='the quote already exists';
            }
        }

        fclose($fh);
    }


//add the name to the csv file

    if(strlen($error)>0) echo $error;
    else{
        $fh = fopen("../data/quotes.csv", "a");
        fputs($fh, "\n".$_POST['quote']);
        fclose($fh);
        echo('Thanks for adding "' .$_POST['quote']. '" to our amazing website!');
    }
}

?>

<br>
<br>