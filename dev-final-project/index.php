<?php
include 'top.php';
$sql = 'SELECT pmkMountainId, fldName, fldState, fldTown, fldDescription, fldRange, fldVertical, fldElevation, fldSnowfall, fldPassPrice, fldLink, fldImage ';
$sql .= 'FROM tblMtn ';
$sql .= 'ORDER BY fldName';

$data ='';
$mtns = $thisDatabaseReader->select($sql, $data);

?>

<main>
    <h2>Vermont's Ski Mountains </h2>
    <?php
    print'<section id = "mtngrid">';
if(is_array($mtns)){
    foreach($mtns as $mtn){
        
        print '<a href = "displayMountain.php?mid='.  $mtn['pmkMountainId'] . '">
        <figure class="mtn"><img alt="' . $mtn['fldName'] . '" src="images/uploads/'
        .  $mtn['fldImage'].'">';
        print '<figcaption>' . $mtn['fldName'] . '</figcaption>';
        print '</figure></a>';
        
    }
}    
print'</section>';


print '</main>';


include 'footer.php';
?>