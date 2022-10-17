<?php 
require 'csv_util.php';

$authors = readRecords('data/authors.csv');
?>
<a href="index.php">Index Page</a>
<hr />




<form action="" method="POST">
    <?php
    for ($i = 0; $i < count($authors); $i++){
        ?>
    
    <input type="radio" name="radio" id="<?php$authors[$i]?>" value="<?php$i?>"><?php echo $authors[$i]?>
    <?php

    ?>
    <br>
    <?php
    }
?>
    <label> Enter a quote you'd like:</label>
    <br>
    <input type="text" name="quote" /><br />
    <button type="submit" name="submit"> Add Quote</button>
</form>

<script>if (document.getElementById('radio').checked){
    print("Hello World");
}
</script>



<?php

if(count($_POST)>0) {

    $error='';
    //make sure the name isnt in the file 
    if(file_exists('data/quotes.csv')){
        
        $fh=fopen('data/quotes.csv','r');
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
        $fh = fopen("data/quotes.csv", "a");
        fputs($fh, "\n".$_POST['quote']);
        fclose($fh);
        echo('Thanks for adding "' .$_POST['quote']. '" to our amazing website!');
    }
}

?>

<br>
<br>