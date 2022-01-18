<?php
include 'top.php';

# evaluates if critter id is true (set) then it will cast it into an integer, if false it will be zero (ternary statement)
$critterId = (isset($_GET['cid'])) ? (int) htmlspecialchars($_GET['cid']) : 0;

# prints out the critter id to see if it works (it works)
# print '<p>Critter Id = ' . $critterId; 

$sql = 'SELECT pmkWildlifeId, fldType, fldCommonName, fldDescription, fldHabitat, ';
$sql .= 'fldReproduction, fldDiet, fldManagement, fldStatus, fldMainImage ';
$sql .= 'FROM tblWildlife ';
$sql .= 'WHERE pmkWildlifeId = ? ';
$sql .= 'ORDER BY fldCommonName';

$data = array($critterId);
$animals = $thisDatabaseReader->select($sql, $data);

?>

<main>
    <?php
    # checks if there is an id or if empty
    if(is_array($animals)){
        foreach($animals as $animal){

            print '<a class = "btnAdopt" href="adoptCritter.php?cid='. $animal['pmkWildlifeId'] .'">Adopt Me!</a>';

            print '<h2>'. $animal['fldCommonName'] .'</h2>';
            print '<img alt="' . $animal['fldCommonName'] . '" src="images/' . $animal['fldMainImage'] . '">';
            print  $animal['fldDescription'];

            print '<section class = "property">';
            print '<h3>Habitat</h3>';
            print  $animal['fldHabitat'];
            print '</section>';

            print '<section class = "property">';
            print '<h3>Reproduction</h3>';
            print  $animal['fldReproduction'];
            print '</section>';

            print '<section class = "property">';
            print '<h3>Diet</h3>';
            print  $animal['fldDiet'];
            print '</section>';

            print '<section class = "property">';
            print '<h3>Management</h3>';
            print  $animal['fldManagement'];
            print '</section>';

            print '<section class = "property">';
            print '<h3>Status</h3>';
            print  $animal['fldStatus'];
            print '</section>';
        }
    }
    else{
        # this is not printing, why?
        print'<p>Hi! Sorry to inform you that no cute critters live on this page, please keep on searching!</p>';
    }
    
print'</main>';

include 'footer.php'; 
?>