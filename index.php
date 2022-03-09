<?php
include ("header.php");

$fileName = "music/songList.csv";
$songs = [];
if (($openedFile = fopen($fileName, "r")) !== FALSE) { // checks if the file is present to read
    $newline = "\n"; // used to signify new line in the csv
    $columnSeparator = ','; // what csv columns are seperated by
    $data = file_get_contents($fileName); // contents of the file specifiec in "$fileName"
    $rows = explode($newline, $data); // creates an array of the rows
    foreach ($rows as $row) { // loops through rows per row
        $currentRow = []; // stores "$currentRow" as an array
        $columns = str_replace('"', "", explode($columnSeparator, $row)); // deletes speech marks in row, then stores it as an array
        $songs[] = $columns; // adds "columns" as a new element in the array, creating an array of arrays
    }
    fclose($openedFile); // closes the file
}


// functions:

// Loops through the songs and deletes any empty rows
function cleanSongs($songs){
    $i = 0; // "i" is used as an iteration count for the loop.Iit keeps up with the current row
    foreach ($songs as $rows) { // Creates a foreach loop to loop through "songs" per row
        if(sizeof($rows) === 1) {
            unset($songs[$i]); // Unsets any array indexes that are empty at value "i"
        }
        $i++; // Increases the iteration count
    }
    return $songs;
}

    // Sort functions:
// sorts track names in ascending order
function trackNameAZ($a, $b){
    return $a[1] <=> $b[1];
}
// sorts track names in descending order
function trackNameZA($a, $b){
    return $b[1] <=> $a[1];
}
// sorts categories in ascending order
function categoryAZ($a, $b){
    return $a[3] <=> $b[3];
}
// sorts categories in descending order
function categoryZA($a, $b){
    return $b[3] <=> $a[3];
}



if (file_exists($fileName) !== TRUE) {
    $openedFile = fopen($fileName, 'w');
    fclose($openedFile);
}




$songs = cleanSongs($songs); // overwrites $songs with the cleaned version
$sortFunctions = [
    'Track Name (A-Z)' => 'trackNameAZ',
    'Track Name (Z-A)' => 'trackNameZA',
    'Category (A-Z)' => 'categoryAZ',
    'Category (Z-A)' => 'categoryZA',
];
if (isset($_POST['sort'])){
    usort($songs, "trackNameAZ");
    foreach ($sortFunctions as $name => $func){
        if($_POST['sort'] === $name) {
            usort($songs, $func);
        }
    }
}  else {
    usort($songs, "trackNameAZ");
}


function displayInTable($songs){ // used to output "songs" into a table, cell by cell
    $current = 0;
    foreach ($songs as $rows){
        echo "<tr>";
        $columns = count($rows);
        for ($i = 0; $columns >= $i; $i++) {
            if($i === 0) {
                echo "<td class='img'>$rows[$i]</td>";
            } else if ($i == $columns){
                echo "<td class='edit'>
                        <span class='btn'>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 500 500' shape-rendering='geometricPrecision' text-rendering='geometricPrecision'><ellipse rx='250' ry='250' transform='translate(250 250)' fill='#bba5f0' stroke-width='0'/></svg>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 500 500' shape-rendering='geometricPrecision' text-rendering='geometricPrecision'><ellipse rx='250' ry='250' transform='translate(250 250)' fill='#bba5f0' stroke-width='0'/></svg>
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 500 500' shape-rendering='geometricPrecision' text-rendering='geometricPrecision'><ellipse rx='250' ry='250' transform='translate(250 250)' fill='#bba5f0' stroke-width='0'/></svg>
                        </span>
                        <form action='temp.php' method='get'>
                            <input type='submit' value='Edit Track' name='".$current."'>
                            <input type='submit' value='Delete Track' name='".$current."'>
                            <span class='dropdown'>add playlist function here</span>    
                        </form>
                    </td>";
            } else {
                echo "<td>$rows[$i]</td>";
            }

        }
        echo "</tr>";
        $current++;
    }
}


?>
<main class="index">
    <section class="subHeader">
        <div class="filter dropdown">
            <h2>Filter</h2>
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 500 500" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"><path d="M0,250L250,500L500,250" transform="matrix(.938862 0 0 0.938862 15.2845-102.07325)" fill="none" stroke="#bba5f0" stroke-width="50"/></svg>
            <ul class="filter-list">
                <form action="index.php" method="post">
                    <li class="list-item"><input type="submit" value="Track Name (A-Z)" name="sort"></li>
                    <li class="list-item"><input type="submit" value="Track Name (Z-A)" name="sort"></li>
                    <li class="list-item"><input type="submit" value="Category (A-Z)" name="sort"></li>
                    <li class="list-item"><input type="submit" value="Category (Z-A)" name="sort"></li>
                </form>
            </ul>
        </div>
        <div class="addNewBtn">
            <img src="img/pbtn.png" alt="Plus Button" class="addNew">
            <h3>Add New...</h3>
        </div>
    </section>
    <table>
        <thead>
        <tr>
            <th id="t-image">Image</th>
            <th id="t-track">Track Name</th>
            <th id="t-comment">Comment</th>
            <th id="t-cat">Category</th>
            <th id="t-edit">Edit</th>
        </tr>
        </thead>
        <tbody>
        <?php
            displayInTable($songs)
        ?>
        </tbody>

    </table>


</main>





<?php
include ("footer.php");
?>