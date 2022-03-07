<?php
include ("header.php");

$fileName = "music/songList.csv";

if (file_exists($fileName) !== TRUE) {
    $openedFile = fopen($fileName, 'w');
    fclose($openedFile);
}

$songs = [];
if (($openedFile = fopen($fileName, "r")) !== FALSE) {
    $newline = "\n";
    $columnSeparator = ',';
    $data = file_get_contents($fileName);
    $rows = explode($newline, $data);
    foreach ($rows as $row) {
        $currentRow = [];
        $currentColumn = 0;
        $columns = str_replace('"', "", explode($columnSeparator, $row));
        $songs[] = $columns;
    }
    fclose($openedFile);
}

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
$songs = cleanSongs($songs);


function displayInTable($songs){
    $current = 0;
    foreach ($songs as $rows){
        echo "<tr>";
        $columns = count($rows);
        for ($i = 0; $columns > $i; $i++) {
            if($i === 0) {
                echo "<td class='img'>$rows[$i]</td>";
            }
            echo "<td>$rows[$i]</td>";
        }
        echo "<td><input type='submit' value='".$current."'></td>";
        echo "</tr>";
        $current++;
    }
}


?>
<main class="index">
    <table>
        <thead>
        <tr>
            <th>Image</th>
            <th>Song</th>
            <th>Comment</th>
            <th>Category</th>
            <th>Edit</th>
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