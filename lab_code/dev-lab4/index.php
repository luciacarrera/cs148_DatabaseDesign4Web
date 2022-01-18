<?php
include 'top.php'; 
$sql = 'SELECT pmkWildlifeId, fldType, fldCommonName, fldDescription, fldHabitat, ';
$sql .= 'fldReproduction, fldDiet, fldManagement, fldStatus, fldMainImage ';
$sql .= 'FROM tblWildlife ';
$sql .= 'ORDER BY fldCommonName';

// The following command will print out your sql statement
// this way you can copy it to phpMyAdmin and see where the error is
// print "<p>SQL: " . $sql;

$data ='';
# print($thisDatabaseReader->displayQuery($sql));
$animals = $thisDatabaseReader->select($sql, $data);

?>

<main> 
    <h2>Vermont's Wildlife</h2>
    <?php

    // will print out image + name (+alt) of animals in database
   // print_r($animals);
    if(is_array($animals)){
        foreach($animals as $animal){
            print '<a href = "displayCritter.php?cid='. $animal['pmkWildlifeId'] . '" >';
            print '<figure class="animal">';
            print '<img alt="' . $animal['fldCommonName'] . '" src="images/' . $animal['fldMainImage'] . '">';
            print '<figcaption>' . $animal['fldCommonName'] . '</figcaption>';
            print '</figure>';
            print '</a>';
        }
    }
print'</main>';

include 'footer.php'; 
?>